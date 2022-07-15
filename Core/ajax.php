<?php 
include("./common.php");
$act=isset($_GET['act'])?($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');
switch($act){
case 'login':
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$ip=real_ip();
	$pwd=md5($pwd);
	if($row=$DB->get_row("SELECT uid,user FROM ".DBQZ."_user WHERE user='$user' and pwd='$pwd' limit 1")){
	$cookie=md5(uniqid().rand(1,1000));
	$DB->query("update ".DBQZ."_user set cookie='$cookie',ip='$ip' where uid='{$row[uid]}'");
	setcookie(DBQZ."_cookie",$cookie,time()+3600*24*14,'/');
	$json=array("code" => 1, "msg" => '登陆账户成功');
	}else{
	$json=array("code" => 2, "msg" => '用户名或密码错误');
	}
	exit(json_encode($json));
break;
case 'reg':
	$user=safe_replace($_POST['user']);
	$qq=safe_replace($_POST['qq']);
	$email=safe_replace($_POST['email']);
	$pwd=$_POST['pwd'];
	$pwds=$_POST['pwds'];
	$ip=real_ip();
	$pwd=md5($pwd);
	$pwds=md5($pwds);
if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
    if($DB->get_row("SELECT * FROM ". DBQZ ."_user WHERE user='{$user}' limit 1")){
		$json=array("code" => 2);
	}elseif($DB->get_row("SELECT * FROM ". DBQZ ."_user WHERE qq='{$qq}' limit 1")){
		$json=array("code" => 5);
	}elseif($DB->get_row("SELECT * FROM ". DBQZ ."_user WHERE email='{$email}' limit 1")){
		$json=array("code" => 3);
	}elseif($pwd=$pwds){
		$DB->query("INSERT INTO `". DBQZ ."_user`(`user`, `email`, `qq`, `pwd`, `ip`, `time`) VALUES ('{$user}','{$email}','{$qq}','{$pwd}','{$ip}','{$date}')");
		$json=array("code" => 1);
	}else{
		$json=array("code" => 4);
	}
}
else
{
    $json=array("code" => 5);
}
	exit(json_encode($json));
break;
case 'pwd_update':
    $pwd=md5($_POST['pwd']);
	$pwds=md5($_POST['pwds']);
	if($pwd!=$userrow['pwd']){
		$json=array("code" => 3);
	}elseif($pwd=$userrow['pwd']){
		$DB->query("UPDATE `". DBQZ ."_user` SET pwd='{$pwds}' where `uid` = '{$userrow['uid']}'");
		$json=array("code" => 1);
	}else{
		$json=array("code" => 2);
	}
	exit(json_encode($json));
break;
case 'user_update':
    $email=safe_replace($_POST['email']);
	$qq=safe_replace($_POST['qq']);
	$sql=$DB->query("update " . DBQZ . "_user set email='$email',qq='$qq' where uid='{$userrow['uid']}'");
	if($sql){
		$json=array("code" => 1);
	}else{
		$json=array("code" => 2);
	}
	exit(json_encode($json));
break;
case 'key_add':
	$uid=$userrow['uid'];
	$name=safe_replace($_POST['name']);
	$key=getkey();
	$amount=($userrow['amount'] - 1);
	$sql=$DB->query("INSERT INTO `". DBQZ ."_key`(`uid`, `web_name`, `key`, `time`) VALUES ('{$uid}','{$name}','{$key}','{$date}')");
    if($DB->get_row("SELECT * FROM ". DBQZ ."_user WHERE amount=0 limit 1")){
		$json=array("code" => 3);
	}elseif($sql){
		$DB->query("update " . DBQZ . "_user set amount='$amount' where uid='{$userrow['uid']}'");
		$json=array("code" => 1);
	}
exit(json_encode($json));
break;
case 'key_name':
	$key=$_POST['key'];
	$keyname = $DB->get_row("select * from ". DBQZ ."_key where `key` = '{$key}' limit 1");
    $json=array("code" => 1,"name" => ''.$keyname['web_welcome'].'');
exit(json_encode($json));
break;
case 'key_del':
	$kid = $_POST['kid'];
	$amount=($userrow['amount'] + 1);
	if($DB->query("DELETE FROM `". DBQZ ."_key` where `kid` = '{$kid}'")){
		$DB->query("update " . DBQZ . "_user set amount='$amount' where uid='{$userrow['uid']}'");
		$json=array("code" => 1, "msg" => '删除成功');
	}else{
		$json=array("code" => 0, "msg" => '删除失败');
	}
	exit(json_encode($json));
break;
case 'key_update':
    $kid=$_POST['kid'];
	$web_name=safe_replace($_POST['web_name']);
	$web_welcome=safe_replace($_POST['web_welcome']);
	$song_album=safe_replace($_POST['song_album']);
	$song_album_1=safe_replace($_POST['song_album_1']);
	/*$web_musicfirsttip=safe_replace($_POST['web_musicfirsttip']);
	$web_volume=safe_replace($_POST['web_volume']);*/
	$sql=$DB->query("update " . DBQZ . "_key set web_name='$web_name',web_welcome='$web_welcome',song_album='$song_album',song_album_1='$song_album_1' where kid='{$kid}'");
	if($sql){
		$json=array("code" => 1);
	}else{
		$json=array("code" => 2);
	}
	exit(json_encode($json));
break;
case 'song_add_playlist':
    $kid=$_POST['kid'];
	$key=$DB->get_row("select * from ". DBQZ ."_key where `kid` = '{$kid}' limit 1");
	$song_album_id=$_POST['song_album_id'].$_POST['type'];
	$song_id=isset($key['song_id'])?trim(str_replace(" ","",str_replace("\n", "",str_replace("\r\n", "",$key['song_id']))),'|'):'';;
	$song_album_id_arr=array_unique(array_filter(explode("|",$song_album_id)));
	$song_album_id=implode('|', $song_album_id_arr);
	foreach ($song_album_id_arr as $value) {
		$song_id.=parseSheet($value);
	}
	$song_album_id_arr=array_unique(array_filter(explode("|",$song_id)));
	$song_id=implode('|',$song_album_id_arr);
	$song_name='';
	foreach ($song_album_id_arr as $value) {
		$song_name.=parseSongId($value).'|';
	}
	$song_name=trim($song_name);
	$sql=$DB->query("update " . DBQZ . "_key set song_name='$song_name',song_id='$song_id' where kid='{$kid}'");
	if($sql){
		$json=array("code" => 1);
	}else{
		$json=array("code" => 2);
	}
	exit(json_encode($json));
break;
case 'song_add_id':
    $kid=$_POST['kid'];
	$song_id=$_POST['song_id'].$_POST['type'];
	$key=$DB->get_row("select * from ". DBQZ ."_key where `kid` = '{$kid}' limit 1");
	$song_name=parseSongId($song_id);
	$song_names=parseSongId($song_id);
	$song_id_arr = array($key['song_id'],$song_id);
	$song_name_arr = array($key['song_name'],$song_name);
	if($key['song_id']==""){
	$song_id=implode($song_id_arr);
	$song_name=implode($song_name_arr);
	}else{
	$song_id=implode('|',$song_id_arr);
	$song_name=implode('|',$song_name_arr);
	}
	if(!$song_names){
		$json=array("code" => 2, "msg" => 'ID不正确');
	}elseif($DB->query("update " . DBQZ . "_key set song_name='$song_name',song_id='$song_id' where kid='{$kid}'")){
		$json=array("code" => 1, "msg" => '成功添加音乐'.$song_names.'，请刷新页面');
	}else{
		$json=array("code" => 2, "msg" => '可能是网络错误');
	}
	exit(json_encode($json));
break;
case 'song_add_search':
    $kid=$_POST['kid'];
	$song_id=$_POST['id'];
	$key=$DB->get_row("select * from ". DBQZ ."_key where `kid` = '{$kid}' limit 1");
	$song_name=parseSongId($song_id);
	$song_names=parseSongId($song_id);
	$song_Artist=parseSongArtist($song_id);
	$song_id_arr = array($key['song_id'],$song_id);
	$song_name_arr = array($key['song_name'],$song_name);
	if($key['song_id']==""){
	$song_id=implode($song_id_arr);
	$song_name=implode($song_name_arr);
	}else{
	$song_id=implode('|',$song_id_arr);
	$song_name=implode('|',$song_name_arr);
	}
	if(!$kid){
		$json=array("code" => 2, "msg" => 'KID获取失败');
	}elseif(!$song_names){
		$json=array("code" => 2, "msg" => 'ID不正确');
	}elseif($DB->query("update " . DBQZ . "_key set song_name='$song_name',song_id='$song_id' where kid='{$kid}'")){
		$json=array("code" => 1, "msg" => '成功添加音乐'.$song_names.'，请刷新页面');
	}else{
		$json=array("code" => 2, "msg" => '可能是网络错误');
	}
	exit(json_encode($json));
break;
case 'song_del':
	$id = $_POST['id'];/*歌曲的ID*/
	$name = parseSongId($id);/*歌曲的名称*/
	$kid = $_POST['kid'];/*播放器的ID*/
	$row=$DB->get_row("select * from ". DBQZ ."_key where `kid` = '{$kid}' limit 1");/*读写歌单sql*/
	$id_arr = array_unique(array_filter(explode("|",$row['song_id'])));/*将字符串转为数组*/
	$name_arr = array_unique(array_filter(explode("|",$row['song_name'])));/*将字符串转为数组*/
	$key=array_search($id ,$id_arr);/*添加$id进数组*/
	$keys=array_search($name ,$name_arr);/*添加$name进数组*/
    array_splice($id_arr,$key,1);/*在数组中删除$id的值*/
	array_splice($name_arr,$keys,1);/*在数组中删除$name的值*/
    var_dump($id_arr);/*返回的数据*/
	var_dump($name_arr);/*返回的数据*/
	$song_id=implode('|',$id_arr);/*将数组转为字符串*/
	$song_name=implode('|',$name_arr);/*将数组转为字符串*/
	if($DB->query("update " . DBQZ . "_key set song_name='$song_name',song_id='$song_id' where kid='{$kid}'")){/*将字符串导入到数据库*/
		$json=array("code" => 1, "msg" => '删除成功');/*json数据*/
	}else{
		$json=array("code" => 0, "msg" => '删除失败');/*json数据*/
	}
	exit(json_encode($json));/*返回json数据*/
break;
case 'chat_add':
	$uid=$userrow['uid'];
	$con=safe_replace_2($_POST['con']);
	$sql=$DB->query("INSERT INTO `". DBQZ ."_chat`(`uid`, `con`, `time`) VALUES ('{$uid}','{$con}','{$date}')");
    if($sql){
		$json=array("code" => 1);
	}else{
		$json=array("code" => 2);
	}
exit(json_encode($json));
break;
case 'version_add':
	$version=$_POST['version'];
	$con=$_POST['con'];
	$sql=$DB->query("INSERT INTO `". DBQZ ."_update`(`version`, `con`, `time`) VALUES ('{$version}','{$con}','{$date}')");
    if($sql){
		$json=array("code" => 1,"msg" => '添加成功，请刷新页面');
	}else{
		$json=array("code" => 2,"msg" => '添加失败');
	}
exit(json_encode($json));
break;
/*管理员部分*/
case 'web_set':
    $name=$_POST['name'];
	$cloudinfo=$_POST['cloudinfo'];
	$description=$_POST['description'];
	$keywords=$_POST['keywords'];
	$web_zt=$_POST['web_zt'];
	$gonggao=$_POST['gonggao'];
	$help=$_POST['help'];
	/*------------------------------------*/
	saveSetting('name',$_POST['name']);
	saveSetting('cloudinfo',$_POST['cloudinfo']);
	saveSetting('description',$_POST['description']);
	saveSetting('keywords',$_POST['keywords']);
	saveSetting('web_zt',$_POST['web_zt']);
	saveSetting('gonggao',$_POST['gonggao']);
	saveSetting('help',$_POST['help']);
	/*------------------------------------*/
	$json=array("code" => 1);
	exit(json_encode($json));
break;
case 'user_set':
    $uid=$_POST['uid'];
    $user=$_POST['user'];
	$amount=$_POST['amount'];
	$sql=$DB->query("update " . DBQZ . "_user set user='$user',amount='$amount' where uid='{$uid}'");
	if($sql){
	$json=array("code" => 1);
	}else{
	$json=array("code" => 2);
	}
	exit(json_encode($json));
break;
case 'logout':
	$new_cookie = md5(uniqid() . rand(1, 1000));
	$DB->query("update " . DBQZ . "_user set cookie='".$new_cookie."' where uid='".$userrow['uid']."'");
	setcookie(DBQZ . "_cookie", "", -1, '/');
	$json=array("code" => 0, "msg" => '退出成功');
	exit(json_encode($json));
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}

function get_rand($proArr)
{
	$result = "";
	$proSum = array_sum($proArr);
	foreach ($proArr as $key => $proCur) {
		$randNum = mt_rand(1, $proSum);
		if ($randNum <= $proCur) {
			$result = $key;
			break;
		}
		$proSum -= $proCur;
	}
	unset($proArr);
	return $result;
}
?>