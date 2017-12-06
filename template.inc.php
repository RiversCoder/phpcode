<?php
	header('Content-type:text/html;charset=utf8');
	define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	define('PATH_TPL',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates/');
	define('PATH_TPLC',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates_c/');
	define('CACHE',dirname(__FILE__).DIRECTORY_SEPARATOR.'cache/');

	//设置是否开启缓存的开关
	define('OPEN_CACHE',true);

	OPEN_CACHE ? ob_start() : null;

	function __autoload($_classname){
		require_once PATH.'includes/'.$_classname.'.class.php';
	}

	$tpl = new Templates();
?>