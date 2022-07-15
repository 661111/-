<?php include_once("header.php");?>
<div class="row">
<div class="col-sm-12">
<?php if($_GET['uid']!=""){
if($_GET['uid']==""){
    echo '<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8" />
	<title>用户不存在</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script src="/Public/XPlayer/js/jquery.min.js"></script>
	<script src="/Public/Other/layer/layer.js"></script>
	</head>
	<body>
	<h3 style="text-align:center; margin-top:200px;">用户不存在</h3>
	<script language="javascript">layer.closeAll();layer.open({shadeClose:false,content:"用户不存在",btn: "好的",yes: function(index){window.location.href="?do=web_set";layer.close(index);}});</script>
	</body>
	</html>';
    exit;
}
$user = $DB->get_row("select * from ". DBQZ ."_user where `uid` = '{$_GET['uid']}' limit 1");
if($user['user']==''){
    echo '<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8" />
	<title>用户不存在</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script src="/Public/XPlayer/js/jquery.min.js""></script>
	<script src="/Public/Other/layer/layer.js"></script>
	</head>
	<body>
	<h3 style="text-align:center; margin-top:200px;">用户不存在</h3>
	<script language="javascript">layer.closeAll();layer.open({shadeClose:false,content:"用户不存在",btn: "好的",yes: function(index){window.location.href="?do=web_set";layer.close(index);}});</script>
	</body>
	</html>';
    exit;
}	
?>
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
          <a href="" class="font-bold">[UID:<?=$user['uid']?>]用户信息修改</a>
        </div>
		 <div class="panel-body">
						   <input type="hidden" class="form-control" name="uid" value="<?=$user['uid']?>">
								<div class="form-group">
                                    <label for="exampleFormControlInput12">用户名</label>
                                    <input type="text" class="form-control r-0" name="user" placeholder="请输入用户名" value="<?=$user['user']?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleFormControlInput12">额度</label>
                                    <input type="text" class="form-control r-0" name="amount" placeholder="播放器使用额度" value="<?=$user['amount']?>">
                                </div>
								<button type="button" id="user_set" class="btn btn-primary">更改</button>
                        </div>
                        </div>
<?php }?>
<div class="block-title">

       <ul class="nav nav-tabs" id="panel-heading">
	        <li style="width: 30%;" class="<?php if($_GET['type']=="web_set"){echo 'active';}?>" align="center"><a href="#web_set" data-toggle="tab"><span style="font-weight:bold"><i class="icon-wrench"></i> 网站</span></a></li>
			<li style="width: 30%;" class="<?php if($_GET['type']=="user_list"){echo 'active';}?>" align="center"><a href="#user_list" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-group"></i> 用户</span></a></li>
            <li style="width: 30%;" class="<?php if($_GET['type']=="version_set"){echo 'active';}?>" align="center"><a href="#version_set" data-toggle="tab"><span style="font-weight:bold"><i class="icon-emoticon-smile"></i> 说明</span></a></li>
        </ul>
		<div class="tab-content">
		<div class="tab-pane <?php if($_GET['type']=="web_set"){echo 'active';}?>" id="web_set">
        <div class="panel panel-info">
        <div class="panel-heading bk-bg-info">
          <a href="" class="font-bold">网站信息管理</a>
        </div>
		 <div class="panel-body">
		 <div class="form-group">
                                    <label for="exampleFormControlInput12">网站名称</label>
                                    <input type="text" class="form-control r-0" name="name" placeholder="请输入网站名称" value="<?=$conf['name']?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleFormControlInput12">网站副标题</label>
                                    <input type="text" class="form-control r-0" name="cloudinfo" placeholder="请输入网站副标题" value="<?=$conf['cloudinfo']?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleFormControlInput12">网站简介</label>
                                    <input type="text" class="form-control r-0" name="description" placeholder="请输入网站简介" value="<?=$conf['description']?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleFormControlInput12">网站关键词</label>
                                    <input type="text" class="form-control r-0" name="keywords" placeholder="请输入网站关键词" value="<?=$conf['keywords']?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput12">极验证ID</label>
                                    <input type="text" class="form-control r-0" name="CAPTCHA_ID" placeholder="请输入极验证ID" value="<?=$conf['CAPTCHA_ID']?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleFormControlInput12">极验证KEY</label>
                                    <input type="text" class="form-control r-0" name="PRIVATE_KEY" placeholder="请输入极验证KEY" value="<?=$conf['PRIVATE_KEY']?>">
                                </div>
								<div class="form-group">
                                    <label for="exampleFormControlInput12">网站状态</label>
                                    <select class="form-control" name="web_zt">
                                  <?php if($conf['web_zt']=="1"){
			                	echo '<option value="1">正常</option>
                              <option value="0">维护</option>';
		                  	}elseif($conf['web_zt']=="0"){
			                 	echo '<option value="0">维护</option>
			                   	<option value="1">开放</option>';
		                          	}?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label for="exampleFormControlInput12">用户中心公告</label>
                                    <textarea class="form-control" name="gonggao" rows="5" placeholder="用<br/>换行"><?=$conf['gonggao']?></textarea>
                                </div>
                                	<div class="form-group">
                                    <label for="exampleFormControlInput12">关于本站内容</label>
                                    <textarea class="form-control" name="help" rows="5" placeholder="用<br/>换行"><?=$conf['help']?></textarea>
                                </div>
								<button type="button" id="web_set" class="btn btn-success">更改</button>
	    </div>
		</div>
		</div>
		<div class="tab-pane <?php if($_GET['type']=="user_list"){echo 'active';}?>" id="user_list">
        <div class="panel panel-info">
        <div class="panel-heading bk-bg-info">
          <a href="" class="font-bold">用户管理</a>
        </div>
		<div class="row wrapper">
      <div class="col-sm-9">
      </div>
      <div class="col-sm-3">
	  <form method="GET">
	  <input type="hidden" class="form-control" name="do" value="web_set">
	  <input type="hidden" class="form-control" name="type" value="user_list">
        <div class="input-group">
              <input type="text" name="uid" class="form-control input-sm bg-light no-border rounded padder" placeholder="请输入用户UID">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
              </span>
            </div>
		</form>
      </div>
    </div>
	<div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">UID/用户名</font></font></th>
            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">邮箱</font></font></th>
            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系QQ</font></font></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
		<?php
if(isset($_GET['uid'])) {
	$sql=" `uid`='{$_GET['uid']}'";
}else{
	$sql=1;
}
$numrows=$DB->count("SELECT count(*) from " . DBQZ . "_user WHERE {$sql}");
$pagesize=10;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);
$sql=$DB->query("SELECT * FROM " . DBQZ . "_user WHERE {$sql} order by time desc limit $offset,$pagesize");
while($row = $DB->fetch($sql))
   {
	?>
          <tr>
            <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[UID: <?=$row['uid']?>] <?=$row['user']?></font></font></td>
            <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$row['email']?></font></font></td>
            <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$row['qq']?></font></font></td>
            <td>
              <a href="?do=web_set&type=user_list&uid=<?=$row['uid']?>" class="btn btn-sm btn-icon btn-info"><i class="fa fa-cog"></i></a>
            </td>
          </tr>
<?php }?>
        </tbody>
      </table>
    </div>
	<footer class="panel-footer">
      <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4 text-right text-center-xs">                
        <?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li class="page-item"><a class="page-link" href="?do=user_list&page='.$first.$link.'" aria-label="Previous">第一页</a></li>';
} else {
echo '<li class="page-item disabled"><a class="page-link" aria-label="Previous">第一页</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a class="page-link" href="?do=user_list&page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a class="page-link" href="?do=user_list&page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="?do=user_list&page='.$last.$link.'" aria-label="Next">最后一页</a></li>';
} else {
echo '<li class="page-item disabled"><a class="page-link" aria-label="Next">最后一页</a></li>';
}
echo'</ul>';
#分页
?>
        </div>
      </div>
    </footer>
		</div>
	    </div>
		<div class="tab-pane <?php if($_GET['type']=="version_set"){echo 'active';}?>" id="version_set">
         <div class="panel panel-info">
         <div class="panel-heading bk-bg-info">
          <a href="" class="font-bold">说明：</a>
        </div>
		 <div class="panel-body pre-scrollable">
		 <div class="m-b b-l m-l-md streamline">
			<div>
          <div class="m-l-lg panel b-a">
            <div class="panel-heading pos-rlt b-b b-light">
              <span class="arrow left"></span>
              免费版以后更新都会在<a href="https://jq.qq.com/?_wv=1027&k=xzTpVDue"><font color="#FF0000">【点我进群】</font> </a>
            </div>
            <div class="panel-body">
             开发者QQ：24677102<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=24677102&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:24677102:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></div>
          </div>
        </div>
	 	<div>
          <div class="m-l-lg panel b-a">
            <div class="panel-heading pos-rlt b-b b-light">
              <span class="arrow left"></span>
              <a href="#">其它说明：</a>
            </div>
            <div class="panel-body">
             商业版采用TP框架5.0（即将使用6.0），更多功能/音乐接口/播放统计/及时通讯/7中播放器样式/2种歌词样式等等，全部本地化
             <p></p>
             演示站: music.piphp.com<a href="https://music.piphp.com"><font color="#FF0000">【点我查看】</font> </a>
             <p></p>
             如果需要请联系开发者购买，价格100R（可小砍，源码不加密)<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=24677102&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:24677102:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
            </div>
          </div>
        </div>
	 <?php ?>
        </div>
		</div>
      </div> 
	    </div>
	</div>
  </div>
</div>
</div>
<?php include_once("footer.php");?>