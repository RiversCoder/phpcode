<?php
	date_default_timezone_set('Asia/Shanghai'); 
	header('Content-type:text/html;charset=utf8');
	define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	define('PATH_TPL',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates/');
	define('PATH_TPLC',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates_c/');
	define('CACHE',dirname(__FILE__).DIRECTORY_SEPARATOR.'cache/');

	echo date('Y-m-d H:i:s', filemtime(PATH.'index2.php')) .'<br/ >';
	echo date('Y-m-d H:i:s', filemtime(PATH_TPL.'index.tpl'));
?>