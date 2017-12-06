<?php
	/**
	* 编译类
	*/
	class Parser
	{
		private $c_data;
		

		//构造方法
		function __construct($path)
		{
			if(!$this->c_data = file_get_contents($path)){
				exit('获取模板文件出错');
			}
		}

		

		//解析普通变量
		private function regMatch()
		{
			$regExp = '/\{\$([\w]+)\}/';
			//$value =  $parser->avars['name'];
			if(preg_match($regExp,$this->c_data)){
				$this->c_data = preg_replace($regExp,"<?php echo \$this->avars['$1']; ?>",$this->c_data);
			}
		}

		//解析if方法
		private function regMatchIf()
		{

			//匹配{if($name)}
			$regExpIf = '/\{if\s*\(\$(\w+)\)\}/';
			
			$regExpElseIf = '/\{else\s+if\(\$(\w+)\)\}/';	

			//匹配{else}
			$regExpElse = '/\{else\}/';

			//匹配{/if}
			$regExpEndIf = '/\{\/if\}/';


			if(preg_match($regExpIf,$this->c_data))
			{
				$this->c_data = preg_replace($regExpIf,"<?php if(\$this->avars['$1']): ?>",$this->c_data);

				if(preg_match($regExpEndIf,$this->c_data))
				{
					$this->c_data = preg_replace($regExpEndIf,"<?php endif; ?>",$this->c_data);

					if(preg_match($regExpElseIf,$this->c_data))
					{
						$this->c_data = preg_replace($regExpElseIf,"<?php elseif(\$this->avars['$1']): ?>",$this->c_data);
					}

					if(preg_match($regExpElse,$this->c_data))
					{
						$this->c_data = preg_replace($regExpElse,"<?php else: ?>",$this->c_data);
					}
				}
				else
				{
					exit('需要endif结束符');
				}
			}

			

		}

		//解析PHP注释
		private function regMatchNote()
		{	
			$regExpNote = '/\{#+\}(.*)\{#+\}/';

			if(preg_match($regExpNote,$this->c_data))
			{
				$this->c_data = preg_replace($regExpNote,"<?php  /* $1 */?>",$this->c_data);
			}
		}


		//解析foreach语句
		private function regMatchforEach()
		{
			$regExpForEach = '/\{foreach\s+\$(\w+)\(\$(\w+)\s*,\s*\$(\w+)\)\}/';
			$regExpEndForEach = '/\{\/foreach\}/';
			$regExpKeyValue = '/\{@(\w+)\}/';

			//匹配{foreach $array($key,$value)}
			if(preg_match($regExpForEach, $this->c_data))
			{
				//匹配{/foreach}
				if(preg_match($regExpEndForEach, $this->c_data))
				{
					/*{foreach $array($key,$value)}替换成<?php foreach($array as $key=>$value): ?>*/
					$this->c_data = preg_replace($regExpForEach,'<?php foreach(\$this->avars[\'$1\'] as \$$2=>\$$3): ?>',$this->c_data);

					/*{/foreach}替换成<?php endforeach; ?>*/
					$this->c_data = preg_replace($regExpEndForEach,'<?php endforeach; ?>',$this->c_data);

					/*{@key}...{@value}替换成<?php $key ?><?php $value ?>*/
					$this->c_data = preg_replace($regExpKeyValue,'<?php echo \$$1 ?>',$this->c_data);

				}
				else
				{
					exit('foreach需要结束符');
				}
			}	
		}
		

		//解析include方法
		private function regMatchInclude()
		{	
			
			$regExpInclude = '/\{include\s+file=[\"|\']{1}([\w\.\-]+)[\"|\']{1}\}/';

			//匹配{include file="text.php"}
			if(preg_match($regExpInclude,$this->c_data,$files))
			{	

				//判断文件是否存在
				if(file_exists(PATH.$files[1]))
				{
					/*替换成<?php include 'text.php'; ?>*/
					$this->c_data = preg_replace($regExpInclude, '<?php include \'$1\';?>', $this->c_data);
				}
				else
				{
					exit('模板中include引入的文件不存在！');
				}
			}
		}

		//解析系统配置文件
		private function regMatchSysXml()
		{	
			//匹配<!--webname-->
			//$regExpSysXml = '/^\<!\-{2,}{(\w+)}\-{2,}\>$/';
			$regExpSysXml = '/\<!\-{2,}{(\w+)}\-{2,}\>/';

			if(preg_match($regExpSysXml, $this->c_data))
			{
				$this->c_data = preg_replace($regExpSysXml,"<?php echo \$this->config_arr['$1']; ?>", $this->c_data);
			} 
		}

		//整体正则匹配注入
		private function injectTplToPhp()
		{
			//注入变量
			$this->regMatch();
			//注入if语句
			$this->regMatchIf();
			//注入/**/语句
			$this->regMatchNote();
			//注入foreach语句
			$this->regMatchforEach();
			//注入include语句
			$this->regMatchInclude();
			//注入系统配置文件变量语句
			$this->regMatchSysXml();
		}


		//编译
		public function compile($path_c)
		{
			//模板注入	
			$this->injectTplToPhp();

			//最终生成编译文件
			file_put_contents($path_c,$this->c_data);
		}

	}
?>