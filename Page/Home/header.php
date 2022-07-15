<!DOCTYPE html>
<html lang="zh-CN" class="app js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie8 no-ie10 no-ie11 no-ios no-ios7 ipad">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <title><?=$conf['name']?> | <?=$title?></title>
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
  <link href="/Public/assets/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdn.bootcdn.net/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/Public/assets/app.css" type="text/css">  
</head>
<body>
  <section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside bg-info">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="#" class="navbar-brand text-lt">
          <span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
                    <span class="bar1 a1 bg-primary lter"></span>
                    <span class="bar2 a2 bg-info lt"></span>
                    <span class="bar3 a3 bg-success"></span>
                    <span class="bar4 a4 bg-warning dk"></span>
                    <span class="bar5 a5 bg-danger dker"></span>
                  </span>
          <span class="hidden-nav-xs m-l-sm">播放器</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="icon-settings"></i>
        </a>
      </div>      
	  <ul class="nav navbar-nav hidden-xs">
        <li>
          <a href="##nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted active">
            <i class="fa fa-indent text"></i>
            <i class="fa fa-dedent text-active"></i>
          </a>
        </li>
      </ul>

      <div class="navbar-right ">
        <ul class="nav navbar-nav m-n hidden-xs nav-user user">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?=$userrow['qq']?>&spec=100" alt="...">
              </span>
              <?=$userrow['user']?><b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">            
              <li>
                <span class="arrow top"></span>
                <a href="#">剩余额度: <font color="red"><?=$userrow['amount']?></font>个</a>
              </li>
              <li>
                <a href="?do=user_set">更改资料</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="javascript:;" id="logout">退出</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black dk aside hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f-md scrollable">
              <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 513px;">
			  <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railopacity="0.2" style="overflow: hidden; width: auto; height: 513px;">
                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav bg clearfix">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      控制台
                    </li>
                    <li>
                      <a href="?do=home">
                        <i class="fa  fa-asterisk text-success"></i>
                        <span class="font-bold">首页</span>
                      </a>
                    </li>
                    <?php if($userrow['uid']=="1"){?>
                    <li>
                        <a href="?do=web_set&type=web_set">
                        <i class="fa  fa-asterisk text-success"></i>
                        <span class="font-bold">后台管理</span>
                      </a>
                    </li>
                    <?php }?>
                    <li>
                      <a href="?do=bfq">
                        <i class="fa  fa-hand-o-right text-info"></i>
                        <span class="font-bold">添加播放器</span>
                      </a>
                    </li>
                    <li>
                      <a href="?do=chat#foot">
                        <i class="fa fa-commenting text-info-dker"></i>
                        <span class="font-bold">聊天室</span>
                      </a>
                    </li>
                    <li>
                      <a href="?do=help">
                        <i class="fa fa-th-large text-primary-lter"></i>
                        <span class="font-bold">关于本站</span>
                      </a>
                    </li>
                    <li class="m-b hidden-nav-xs"></li>
                  </ul>
                  <ul class="nav" data-ride="collapse">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      欢迎您，<?=$userrow['user']?>
                    </li>
                    <?php 
	           $keys=$DB->count("SELECT count(*) from " . DBQZ . "_key WHERE uid={$userrow['uid']}");
	          ?>
                    <li>
					<a href="#">
                        <i class="fa fa-list"></i>
                        <span>已用配额：<?=$keys?></span>
                      </a>
                    </li>
                    <li>
					<a href="#">
                        <i class="fa fa-music"></i>
                        <span>剩余配额：<?=$userrow['amount']?></span>
                      </a>
                    </li>
                    <li>
					<a href="?do=user_set">
                        <i class="fa fa-user"></i>
                        <span>个人中心</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                        <i class="fa fa-list">
                        </i>
                        <span>我的播放器</span>
                      </a>
                      <ul class="nav dk text-sm">
                        <li>
                          <a href="?do=bfq">                                                        
                            <i class="fa fa-angle-right text-xs"></i>
                            <span>添加播放器</span>
                          </a>
                        </li>
                        <li>
                          <a href="?do=bfq">                                                                                   
                            <i class="fa fa-angle-right text-xs"></i>
                            <span>播放器管理</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 10px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 0px; height: 513px;"></div><div class="slimScrollRail" style="width: 10px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div></div>
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <div class="bg hidden-xs ">
                  <div class="dropdown dropup wrapper-sm clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-left m-l-xs">                        
                        <img src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?=$userrow['qq']?>&spec=100" class="dker" alt="头像">
                        <i class="on b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-l">
                          <strong class="font-bold text-lt"><?=$userrow['user']?></strong> 
                        </span>
                        <span class="text-muted text-xs block m-l"><?=$userrow['email']?></span>
                      </span>
                    </a>
                  </div>
                </div>            
				</footer>
          </section>
        </aside>
  

               <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">