<?php
	header('Content-type:text/html;charset=utf8');
	define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	define('PATH_TPL',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates/');
	define('PATH_TPLC',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates_c/');
	define('CACHE',dirname(__FILE__).DIRECTORY_SEPARATOR.'cache/');

	function __autoload($_classname){
		require_once PATH.'includes/'.$_classname.'.class.php';
	}

	$tpl = new Templates();

	//创建一个普通变量
	$nameValue = '我是一只小小鸟! 大家好';
	
	//注入变量
	$tpl->assign('name',$nameValue);

	//载入tpl文件
	$tpl->display("index.tpl");


?>
