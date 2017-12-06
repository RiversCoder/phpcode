<?php
	date_default_timezone_set('Asia/Shanghai'); 
	header('Content-type:text/html;charset=utf8');
	define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	define('PATH_TPL',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates/');
	define('PATH_TPLC',dirname(__FILE__).DIRECTORY_SEPARATOR.'templates_c/');
	define('CACHE',dirname(__FILE__).DIRECTORY_SEPARATOR.'cache/');

	//echo date('Y-m-d H:i:s', filemtime(PATH.'index2.php')) .'<br/ >';
	//echo date('Y-m-d H:i:s', filemtime(PATH_TPL.'index.tpl'));


	$c_data = '{$nam_e}';
	function regMatch($c_data)
	{
		$regExp = '/\{\$((\w)+)\}/';
		$reg = "/2+/";
		echo '123<br/>';
		//echo preg_match($regExp,$c_data);
		$c_data = preg_replace($regExp, "$1", $c_data);

		echo $c_data;
	}
	//regMatch($c_data);
	//测试foreach语句

	$xml = simplexml_load_file(PATH.'config/profile.xml');
	$data = $xml->xpath('/root/taglib');
	$configArr = array();

	//将每个标签和值赋值给数组
	foreach ($data as $key=>$value)
	{
		$configArr["$value->name"] = $value->value;
	}


?>

