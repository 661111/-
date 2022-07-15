<?php 
if (!iflogin(DBQZ,$userrow['cookie'])) {
    echo '<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8" />
	<title>请先登录</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script src="/Public/XPlayer/js/jquery.min.js"></script>
	<script src="/Public/Other/layer/layer.js"></script>
	</head>
	<body>
	<h3 style="text-align:center; margin-top:200px;">请先登录</h3>
	<script language="javascript">layer.closeAll();layer.open({shadeClose:false,content:"请先完成登录",btn: "好的",yes: function(index){window.location.href="?do=login";layer.close(index);}});</script>
	</body>
	</html>';
    exit;
}
if(!$userrow['uid']){
	setcookie(DBQZ . "_cookie", "", -1, '/');
	echo '<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8" />
	<title>请先登录</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script src="/Public/XPlayer/js/jquery.min.js"></script>
	<script src="/Public/Other/layer/layer.js"></script>
	</head>
	<body>
	<h3 style="text-align:center; margin-top:200px;">请先登录</h3>
	<script language="javascript">layer.closeAll();layer.open({shadeClose:false,content:"请先完成登录",btn: "好的",yes: function(index){window.location.href="?do=login";layer.close(index);}});</script>
	</body>
	</html>';
    exit;
}
?>