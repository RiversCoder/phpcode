<?php
	//设置是否开启缓存的开关 前台专用
	define('OPEN_CACHE',true);
	OPEN_CACHE ? ob_start() : null;
?>