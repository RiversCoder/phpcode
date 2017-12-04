<?php
	/**
	* 
	*/
	class Templates 
	{
		
		function __construct()
		{
			if(!is_dir(PATH) || !is_dir(PATH_TPL) || !is_dir(PATH_TPLC) || !is_dir(CACHE)){
				exit('退出');
			}
			else{
				echo '所有目录都已经创建完成，请继续下面的操作';
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
				//生成编译文件
				$data = file_get_contents($tpl_path);
				file_put_contents($tpl_c, $data);
			}
			
			include $tpl_c;
		}

	}
?>