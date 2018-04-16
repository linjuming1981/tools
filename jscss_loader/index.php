<?php 
/**
 * css js 文件解释器
 * =====================
 */


if(ACTION_NAME == 'loadfile'){
	$path = strtolower($_GET['path']);
	$arr = pathinfo($path);
	$ext = $arr['extension'];
	switch($ext){
		case 'css':
			header('Content-Type: text/css');
			break;
		case 'js':
			header('Content-Type: text/javascript');
			break;
	}
	$code = file_get_contents($path);
	echo $code;
	exit;
}