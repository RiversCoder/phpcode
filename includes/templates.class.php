<?php
	/**
	* 
	*/
	class Templates 
	{
		
		//设置数组 接收要写入模板信息传递过来的key(模板中变量名),value(模板中变量值)
		private $avars = array();
		private $config_arr = array();


		//构造方法
		function __construct()
		{
			//检测定义的绝对路径是否存在
			if(!is_dir(PATH) || !is_dir(PATH_TPL) || !is_dir(PATH_TPLC) || !is_dir(CACHE)){
				exit('路径不正确, 退出');
			}

			//加载系统配置文件
			$this->loadSysXml();
		}

		//加载系统配置profile.xml
		private function loadSysXml()
		{
			$xml = simplexml_load_file(PATH.'config/profile.xml');
			$data = $xml->xpath('/root/taglib');

			//将每个标签和值赋值给数组
			foreach ($data as $key=>$value)
			{
				$this->config_arr["$value->name"] = $value->value;
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

			
			//生成编译文件路径
			$tpl_c =  PATH_TPLC.md5($_file).'.'.$_file.'.php';
			//生成缓存文件路径
			$cache =  CACHE.md5($_file).'.'.$_file.'.html';

			//检测当前是否具有缓存文件
			if(file_exists($cache)&&file_exists($tpl_c))
			{
				//检车模板文件，和编译文件是否经过修改
				if(filemtime($tpl_c) >= filemtime($tpl_path) && filemtime($tpl_c) <= filemtime($cache))
				{	
					//直接载入缓存文件
					//echo '直接载入缓存文件';
					include $cache;
					return;
				}
			}

			//检测该文件是否存在 并且 该文件的修改时间不能小于模板文件的修改时间
			//也就是模板index.tpl修改后，当前编译文件也需要时时更改 
			if(!file_exists($tpl_c) || filemtime($tpl_c) < filemtime($tpl_path) || filemtime($tpl_c) < filemtime(PATH.'includes/parser.class.php')){	

				//编译成php文件 				
				$parser = new Parser($tpl_path);
				//$parser->regMatch();	
				$parser->compile($tpl_c);
			}

			//引入最后编译完成的php文件
			include $tpl_c;

			//判断是否开启缓存，如果已经开启，就执行编译静态缓存文件
			if(OPEN_CACHE){
				$cacheFile = ob_get_contents();
				file_put_contents($cache, $cacheFile);
			}
		}

		
		//分离的模块创建编译文件 不创建缓存文件
		public function create($_file)
		{
			//设置模板的路径
			$tpl_path = PATH_TPL.$_file;

			//检车模板文件是否存在
			if(!file_exists($tpl_path))
			{
				exit('模板文件不存在');
			}

			//生成编译文件路径
			$tpl_c =  PATH_TPLC.md5($_file).'.'.$_file.'.php';

			if(!file_exists($tpl_c) || filemtime($tpl_c) < filemtime($tpl_path) || filemtime($tpl_c) < filemtime(PATH.'includes/parser.class.php')){	

				//编译成php文件 				
				$parser = new Parser($tpl_path);
				//$parser->regMatch();	
				$parser->compile($tpl_c);
			}

			//引入最后编译完成的php文件
			include $tpl_c;

		}

	}
?>