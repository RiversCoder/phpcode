<?php
	
	require_once __dir__.DIRECTORY_SEPARATOR.'template.inc.php';		
	

	global $tpl;

	//创建一个普通变量
	$nameValue = '我是一只小小鸟! 大家好';
	
	//注入变量
	/*$tpl->assign('name',$nameValue);
	$tpl->assign('year','23');
	$tpl->assign('array',array('叮','嘀','哒','咯','嘈','哧','噗'));*/
	//$tpl->assign('path',PATH.'new.php');

	//载入tpl文件
	$tpl->display("index.tpl");

?>
