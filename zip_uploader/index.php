<?php 
/**
 * zip代码包上传后台
 * ===========================
 */

require(TOOLS_DIR.'/classes/View.class.php');
require(TOOLS_DIR.'/classes/Auth.class.php');

$index_url = TOOLS_URL.'?app=zip_uploader&act=index';
$login_url = TOOLS_URL.'?app=zip_uploader&act=login';

// 登录页
if(ACTION_NAME == 'login'){
	if(Auth::isLogin()){
		redirect($index_url);
	}

	// 提交登录
	if(!empty($_POST['do_login'])){
		if(Auth::login($_POST['uname'],$_POST['passwd'])){
			redirect($index_url);
		}
	}

	View::load(__DIR__.'/views/login.html');
}


// 退出登录
if(ACTION_NAME == 'logout'){
	Auth::logout();
	redirect($login_url);
}


// 首页
if(ACTION_NAME == 'index'){
	if(!Auth::isLogin()){
		redirect($login_url);
	}
	View::load(__DIR__.'/views/index.html');
}


// 上传页
if(ACTION_NAME == 'upload'){
	if(!Auth::isLogin()){
		redirect($login_url);
	}
	View::load(__DIR__.'/views/upload.html');
}

