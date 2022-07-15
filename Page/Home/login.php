<!DOCTYPE html>
<html lang="zh-CN" class="app js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie8 no-ie10 no-ie11 no-ios no-ios7 ipad translated-ltr">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title><?=$conf['name']?> |  登录</title> 
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
  <link href="/Public/assets/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdn.bootcdn.net/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/Public/assets/app.css" type="text/css">  
 </head> 
 <body class="bg-info dker" style=""> 
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp"> 
   <div class="container aside-xl"> 
    <a class="navbar-brand block" href="#"><span class="h1 font-bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$conf['name']?></font></font></span></a> 
    <section class="m-b-lg"> 
     <header class="wrapper text-center"> 
      <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">输入信息完成登录</font></font></strong> 
     </header>  
      <div class="form-group"> 
       <input type="text" placeholder="用户名" name="user" class="form-control rounded input-lg text-center no-border" /> 
      </div> 
      <div class="form-group"> 
       <input type="password" placeholder="密码" name="pwd" class="form-control rounded input-lg text-center no-border" /> 
      </div> 
	   <div class="checkbox i-checks m-b">
        <label class="m-l"><input type="checkbox" checked=""><i></i> 记住状态</label></div>
      <button type="button" id="login" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded">
	  <i class="icon-arrow-right pull-right"></i>
	  <span class="m-r-n-lg">
	  <font style="vertical-align: inherit;">
	  <font style="vertical-align: inherit;">登入</font></font></span></button> 
      <div class="line line-dashed"></div> 
      <p class="text-muted text-center"><small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">还没有账号？</font></font></small></p> 
      <a href="?do=reg" class="btn btn-lg btn-info btn-block rounded"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">创建一个帐户</font></font></a> 
    </section> 
   </div> 
  </section> 
 <script src="/Public/assets/jquery.min.js"></script>
  <script src="/Public/assets/bootstrap.js"></script>
  <script src="/Public/assets/app.js"></script>  
  <script src="/Public/assets/jquery.slimscroll.min.js"></script>
  <script src="/Public/Other/layer/layer.js"></script>
  <script src="/Public/Ajax/mian.js"></script>
 </body>
</html>