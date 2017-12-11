<?php
	//设置是否开启缓存的开关 后台专用
	define('OPEN_CACHE',false);
	OPEN_CACHE ? ob_start() : null;
?>