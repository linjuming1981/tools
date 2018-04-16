<?php 
/**
 * html模板展示类
 * ===================
 */

class View{

	public static function load($tpl_path, $vars=[]){
		$code = file_get_contents($tpl_path);
		foreach($vars as $k=>$v){
			$code = str_replace('{{'.$k.'}}', $v, $code);
		}

		// http://3ms-api.huawei.com:90/api/tools.php?app=jscss_loader&act=loadfile&path=/data01/tools/zip_uploader/public
		$public_dir = dirname(dirname($tpl_path)).'/public';
		$public_dir = str_replace('\\', '/', $public_dir);
		$public_dir = TOOLS_URL.'?app=jscss_loader&act=loadfile&path='.$public_dir;

		$code = str_replace('{{public_dir}}', $public_dir, $code);

		echo $code;
	}

}