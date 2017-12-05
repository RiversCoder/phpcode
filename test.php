<?php
	date_default_timezone_set('Asia/Shanghai'); 
	header('Content-type:text/html;charset=utf8');
	define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	define('PATH_TPL',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates/');
	define('PATH_TPLC',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates_c/');
	define('CACHE',dirname(__FILE__).DIRECTORY_SEPARATOR.'cache/');

	echo date('Y-m-d H:i:s', filemtime(PATH.'index2.php')) .'<br/ >';
	echo date('Y-m-d H:i:s', filemtime(PATH_TPL.'index.tpl'));


	$c_data = '{$nam_e}23123131';
	function regMatch($c_data){
		$regExp = '/\{\$([\w]+)\}/';
		$reg = "/2+/";
		echo '123<br/>';
		echo preg_match($regExp,$c_data);
	}

	regMatch($c_data);
?>