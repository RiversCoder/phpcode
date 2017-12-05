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
		public function regMatch(){
			$regExp = '/\{\$([\w]+)\}/';
			//$value =  $parser->avars['name'];
			if(preg_match($regExp,$this->c_data)){
				$this->c_data = preg_replace($regExp,"<?php echo \$this->avars['name']; ?>",$this->c_data);
			}
			else
			{
				exit('匹配失败');
			}
		}

		//编译方法
		public function compile($path_c){
			//生成编译文件
			file_put_contents($path_c,$this->c_data);
			//$this->regMatch();
		}
	}
?>