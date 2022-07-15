<?php
include_once("common.php");
$title="Key对接代码获取";
if($_GET['key']==""){
    echo '播放器KEY没有值';
    exit;
}
$row = $DB->get_row("select * from ". DBQZ ."_key where `key` = '{$_GET['key']}' limit 1");
if($row['key']==""){
	echo '播放器KEY不存在';
    exit;
}
?>