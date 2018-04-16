<?php 
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';

session_start();
// header('Content-type:text/html; charset=utf-8');

if(empty($_GET['app'])) die('app没传');
if(empty($_GET['act'])) die('act没传');
$app = trim($_GET['app']);
$act = trim($_GET['act']);

$tools_dir = Tools::getToolsRootDir();
if(!$tools_dir) die('找不到工具tools文件夹');
chdir($tools_dir);


define('TOOLS_DIR', $tools_dir);  				# /data01/tools
define('TOOLS_URL', Tools::getToolsUrl());      # http://3ms-api.huawei.com:90/api/tools.php
define('APP_NAME', $app);						# zip_uploader
define('APP_DIR', TOOLS_DIR.'/'.APP_NAME);      # /data01/tools/zip_uploader
define('ACTION_NAME', $act);                    # upload

require(TOOLS_DIR.'/functions.php');
require(APP_DIR.'/index.php');





/* ============================================================= */

class Tools{

	/**
	 * 获得tools项目文件根目录
	 * @return string 
	 */
	public static function getToolsRootDir(){
		$dirs = ['.', '../tools', '../../tools'];
		$tools_dir = '';
		foreach($dirs as $k=>$v){
			$path = $v.'/tools.php';
			if(is_file($path)){
				$path = realpath($path);
				$path = str_replace('\\', '/', $path);
				if(strpos($path, '/tools/tools.php') !== false){
					$tools_dir = dirname($path);
					break;
				}
			}
		}
		return $tools_dir;
	}


	/**
	 * 获得当前调用tools.php完整网址，不带传参
	 * @return string 
	 */
	public static function getToolsUrl(){
		$port_str = ($_SERVER['SERVER_PORT'] == 80) ? '' : ':'.$_SERVER['SERVER_PORT'];
		$tools_url = 'http://'.$_SERVER['SERVER_NAME'].$port_str.$_SERVER['SCRIPT_NAME'];
		return $tools_url;
	}

}