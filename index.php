<?php
/*
By: www.lxh5068.com 
QQ: 3131282664
*/
error_reporting(7);
ob_start();
header('Content-Type: text/html; charset=UTF-8');

//加载核心文件
require_once("Core/common.php");
if($conf['web_zt']=="0"){
	require_once("Page/Home/weihu.php");
}else{
	//加载首页文件
$mod = isset($_GET['do'])?$_GET['do']:'index';
$url = "Page/Common/".$mod.".php";
if($mod==""){
	$title='页面丢失';
    require_once("Page/Home/404.php");
}elseif (file_exists($url)) {
    require_once("Page/Common/".$mod.".php");
    require_once("Page/Home/".$mod.".php");
} else {
	$title='页面丢失';
    require_once("Page/Home/404.php");
}

}