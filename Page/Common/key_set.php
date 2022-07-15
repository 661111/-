<?php
include_once("common.php");
$title="播放器编辑";
if($_GET['kid']==""){
    echo '播放器KEY没有值';
    exit;
}
$row = $DB->get_row("select * from ". DBQZ ."_key where `kid` = '{$_GET['kid']}' limit 1");
if($row['key']==""){
	echo '播放器KEY不存在';
    exit;
}elseif($row['uid']!=$userrow['uid']){
	echo '你没有权利编辑这个播放器';
    exit;
}
?>
