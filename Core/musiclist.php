<?php
include_once ("common.php");
if($_GET['key']==""){
    echo '播放器KEY没有值';
    exit;
}
$song = $DB->get_row("select * from ". DBQZ ."_key where `key` = '{$_GET['key']}' limit 1");
if($song['kid']==""){
	echo '播放器KEY不存在';
    exit;
}
?>

var wenkmList=[{song_album:"<?=$song['song_album']?>",
song_album1:"<?=$song['song_album_1']?>",
welcome:"<?=$song['web_welcome']?>",
musicfirsttip:"<?=$song['web_musicfirsttip']?>",
volume:"<?=$song['web_volume']?>",
song_file:"/",
song_name:"<?=$song['song_name']?>".split("|"),
song_id:"<?=$song['song_id']?>".split("|")}];