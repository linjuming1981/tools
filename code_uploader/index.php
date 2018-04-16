<?php 
/**
 * 命令行上传代码用
 * ===============================
 */

if(ACTION_NAME == 'upload'){
	require(APP_DIR.'/upload.php');
}

if(ACTION_NAME == 'receive'){
	require(APP_DIR.'/receive.php');
}
