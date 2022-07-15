<?php
include_once("common.php");
$title="管理员后台";
if($userrow['uid']!="1"){
    echo '无权限';
    exit;
}
?>