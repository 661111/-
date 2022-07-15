<?php
/*
By:www.lxh5068.com
*/
session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('PRC');
header('Content-Type: text/html; charset=UTF-8');
require 'connection.php';
include_once ("Function/function.php");
$CACHE = new CACHE();
$conf = $CACHE->pre_fetch(); //获取系统配置
//获取网站地址
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$weburl=$http_type . $_SERVER['HTTP_HOST'].'/';

$date = date("Y-m-d H:i:s");
$cookie = $_COOKIE[DBQZ . '_cookie'];
$userrow = $DB->get_row("select * FROM " . DBQZ . "_user where cookie ='$cookie' limit 1"); //获取用户信息
?>