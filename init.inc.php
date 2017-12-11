<?php
	header('Content-type:text/html;charset=utf8');
	define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	
	//加载配置文件
	require_once PATH.'config/profile.inc.php';
	
	//加载缓存机制 相对路径加载 可以识别是前台在加载 还是后台在加载，就可以执行不同的缓存机制
	require 'cache.inc.php';

	function __autoload($_classname){
		require_once PATH.'includes/'.$_classname.'.class.php';
	}

	$tpl = new Templates();
?>