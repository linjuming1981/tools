<?php 

class Auth{

	private static $_users = [
		'admin' => 'hiok2017', // 账号 => 密码
	];

	public static function isLogin(){
		if(empty($_SESSION['uname'])){
			return false;
		}
		return true;
	}


	public static function login($uname, $passwd){
		$users = self::$_users;
		if(empty($users[$uname])) return false;
		if($users[$uname] != $passwd) return false;
		$_SESSION['uname'] = $uname;
		return true;
	}

	public static function logout(){
		unset($_SESSION['uname']);
		return true;
	}



}