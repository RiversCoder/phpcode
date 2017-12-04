<?php
	header('Content-type:text/html;charset=utf8');
	define('PATH', dirname(__FILE__));
	define('PATH_TPL',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates/');
	define('PATH_TPLC',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates_c/');
	define('CACHE',dirname(__FILE__).DIRECTORY_SEPARATOR.'cache/');


	function __autoload($_classname){
		require_once './includes/'.$_classname.'.class.php';
	}

	$tpl = new Templates();

	//载入tpl文件
	$tpl->display("index.tpl");
?>
