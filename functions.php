<?php 
/**
 * 公共函数库
 * ======================
 */

function redirect($url){
	header('Location: '. $url);
	exit;
}

function dd($var, $var_dump=false){
	if($var_dump){
		var_dump($var);
		exit;
	}else{
		echo '<pre>';
		print_r($var);
		echo '</pre>';
		exit;
	}
}