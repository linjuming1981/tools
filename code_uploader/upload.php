<?php 

// $arr=getopt("a:b",['name::']);
// print_r($arr);


$domain = 'localhost';
$domain = 'www.linjuming.top';



$arr = getopt('', ['path:']);
$path = $arr['path'];

require(__DIR__.'/classes/Uploader.class.php');
$uploader = new Uploader();
$uploader->setTargetDomain($domain);
$uploader->setUpFile($path);
$uploader->send();



