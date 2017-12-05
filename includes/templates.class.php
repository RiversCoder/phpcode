<?php
	/**
	* 
	*/
	class Templates 
	{
		
		//设置数组 接收要写入模板信息传递过来的key(模板中变量名),value(模板中变量值)
		private $avars = array();

		//构造方法
		function __construct()
		{
			//检测定义的绝对路径是否存在
			if(!is_dir(PATH) || !is_dir(PATH_TPL) || !is_dir(PATH_TPLC) || !is_dir(CACHE)){
				exit('退出');
			}
		}

		
		//创建一个把变量注入模板文件中的方法
		public function assign($key,$value)
		{	
			if(isset($key) && !empty($key)){
				$this->avars[$key] = $value;
			}
			else
			{
				exit('请设置变量名');
			}
		}


		//生成编译文件盒缓存文件
		public function display($_file)
		{	
			//设置模板的路径
			$tpl_path = PATH_TPL.$_file;

			//检车模板文件是否存在
			if(!file_exists($tpl_path))
			{
				exit('模板文件不存在');
			}

			//检测该文件是否存在 并且 该文件的修改时间不能小于模板文件的修改时间 
			//也就是模板index.tpl修改后，当前编译文件也需要时时更改
			$tpl_c =  PATH_TPLC.md5($_file).'.'.$_file.'.php';

			if(!file_exists($tpl_c) || filemtime($tpl_c) < filemtime($tpl_path)){	

				echo '123';
				//编译成php文件 				
				$parser = new Parser($tpl_path);
				$parser->regMatch();	
				$parser->compile($tpl_c);
			}

			include $tpl_c;
		}

	}
?>