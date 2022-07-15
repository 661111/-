<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title><?=$conf['name']?> - 你访问的页面跑丢了哦</title>
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
  <link href="/Public/assets//bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="/Public/assets/animate.css" type="text/css">
  <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdn.bootcdn.net/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/Public/assets/app.css" type="text/css">  
</head>
<body>
    <div class="row m-n">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="text-center m-b-lg">
          <h1 class="h text-white animated fadeInDownBig"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">404</font></font></h1>
        </div>
        <div class="list-group auto m-b-sm m-b-lg">
          <a href="?do=index" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>返回前页</a>
          <a href="?do=login" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>立即登陆</a>
          <a href="?do=reg" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i> 立即注册</a>
        </div>
      </div>
    </div>
  <script src="/Public/assets/jquery.min.js"></script>
  <script src="/Public/assets/bootstrap.js"></script>
  <script src="/Public/assets/app.js"></script>  
  <script src="/Public/assets/jquery.slimscroll.min.js"></script>
  <script src="/Public/Other/layer/layer.js"></script>
  <script src="/Public/Ajax/mian.js"></script>
</body>
</html>