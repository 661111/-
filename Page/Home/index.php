<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="/favicon.ico">
   <title><?=$conf['name']?> | <?=$title?></title>
<meta name="keywords" content="<?=$conf['keywords']?>">
<meta name="description" content="<?=$conf['description']?>">
<link rel="shortcut icon" href="/favicon.ico">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="/Public/assets/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/assets/index/app.css">
<STYLE type="text/css">
body,.main{
background:#ecedf0 url("http://www.lxh5068.com/tapi/acgurl.php") fixed;
background-repeat:repeat;}
</STYLE>
</head>
<body>

<section class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-6 logo">
                <a href="/"><?=$conf['name']?></a>
            </div>
            <div class="col-md-10 col-sm-6 col-xs-6 nav-top">
                <ul>
                         <li class="link" style="margin-left:10px;"><a href="?do=reg">注册</a></li>
                        <li class="link" style="margin-left:10px;"><a href="?do=login">登录</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="container">
            <div class="index-bg-text">
                <h1>
                    <?=$conf['name']?>                    
					<p></p> <p></p>
					</h1><h3>免费／安全／人性化</h3>
                <p class="i">不只是一款html5播放器插件</p>
                <a href="?do=login" class="btn btn-lg btn-info btn-more">登录</a>
				<a href="?do=reg" class="btn btn-lg btn-success btn-more">注册</a>

            </div>
</section>
</body>
</html>