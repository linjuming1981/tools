<?php 

class Uploader{

	private $domain = '';
	private $upFile = '';

	public function setUpFile($upFile){
		$this->upFile = str_replace('\\', '/', $upFile);
	}

	public function send(){

		$ch = curl_init();
		$path = $this->upFile;
		$path_r = $this->_getRelativePath($path);

		$data = [
			'path' => $path,
			'relative_path' => $path_r,
			'file' => '@'.$path,
		];

		if(class_exists('\CURLFile')){
			$data['file'] = new \CURLFile(realpath($path));
		}else{
			if(defined('CURLOPT_SAFE_UPLOAD')){
				curl_setopt($ch, CURLOPT_SAFE_UPLOAD, FALSE);
			}
		}

		$receive_url = $this->getReceiveUrl();
		curl_setopt($ch, CURLOPT_URL, $receive_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$json = curl_exec($ch);
		$return = json_decode($json, true);

		$rs = [
			'domain' => $this->domain,
			'relative_path' => $path_r,
			'local_path' => $path,
			'rmove_path' => $return['save_path'],
			'is_usccess' => $return['is_success']
		];
		print_r($rs);

	}


	public function setTargetDomain($domain){
		$this->domain = $domain;
	}


	public function getReceiveUrl(){
		$url = 'http://'.$this->domain.'/tools/code_uploader/receive.php';
		return $url;
	}

	public function receive(){
		// D:/www/tools/code_uploader/upload.php
		
		$www_dir = $this->_getWWWDir();
		$save_path = $www_dir.'/'.$_POST['relative_path'];

		$is_success = move_uploaded_file($_FILES['file']['tmp_name'], $save_path);

		$rs = [
			'save_path' => $save_path,
			'is_success' => $is_success,
		];
		die(json_encode($rs));

	}


	private function _getWWWDir(){
		$www_dir =  dirname(dirname(dirname(dirname(__FILE__)))); 
		$www_dir = str_replace('\\', '/', $www_dir);
		return $www_dir; // d:/www
	}

	private function _getRelativePath($path){
		$path = realpath($path);
		$path = str_replace('\\', '/', $path);
		$www_dir =  $this->_getWWWDir();
		$path_r = str_replace($www_dir.'/', '', $path);
		return $path_r;
	}


}