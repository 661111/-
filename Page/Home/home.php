<?php include_once("header.php");?>
 <h3 class="m-t-none font-thin"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">首页<span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
                    <span class="bar1 a1 bg-primary lter"></span>
                    <span class="bar2 a2 bg-info lt"></span>
                    <span class="bar3 a3 bg-success"></span>
                    <span class="bar4 a4 bg-warning dk"></span>
                    <span class="bar5 a5 bg-danger dker"></span>
                  </span></font></font></h3>  
<div class="row">
<div class="col-lg-12">
 <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: 10px">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
<script type="text/javascript" src="http://www.lxh5068.com/tool/douyin/yulu.php"></script>
</button>
<strong><i class="fa icon-ghost"></i> 音乐热评:</strong>
<script>misaka()</script></div>
</div>
                <div class="col-lg-6">
                  <section class="panel panel-default">
                    <div class="panel-body">
                      <div class="clearfix text-center m-t">
                        <div class="inline">
                          <div class="easypiechart easyPieChart" data-percent="75" data-line-width="5" data-bar-color="#4cc0c1" data-track-color="#f5f5f5" data-scale-color="false" data-size="134" data-line-cap="butt" data-animate="1000" style="width: 134px; height: 134px; line-height: 134px;">
                            <div class="thumb-lg">
                              <img src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?=$userrow['qq']?>&spec=100" class="img-circle" alt="头像">
                            </div>
                          <canvas width="134" height="134"></canvas></div>
                          <div class="h4 m-t m-b-xs"><font style="vertical-align: inherit;">
						  <font style="vertical-align: inherit;"><?=$userrow['user']?></font></font></div>
                          <small class="text-muted m-b"><font style="vertical-align: inherit;">
						  <font style="vertical-align: inherit;"><?=$userrow['email']?></font></font></small>
                        </div>                      
                      </div>
                    </div>
                    <footer class="panel-footer bg-info text-center">
                      <div class="row pull-out">
                        <div class="col-xs-4 dk">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white"><font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;"><?=$userrow['uid']?></font></font></span>
                            <small class="text-muted"><font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;">UID</font></font></small>
                          </div>
                        </div>
                        <div class="col-xs-4 dk">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white"><font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;"><?=$userrow['amount']?></font></font></span>
                            <small class="text-muted"><font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;">额度</font></font></small>
                          </div>
                        </div>
                        <div class="col-xs-4 dk">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white"><font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;"><?=$keys?></font></font></span>
                            <small class="text-muted"><font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;">播放器</font></font></small>
                          </div>
                        </div>
                      </div>
                    </footer>
                  </section>
                </div>
 <div class="col-md-6 col-sm-12">
 <div class="panel panel-danger">
<div class="panel-heading2 bk-bg-danger">
	<h5>公告</h5>
</div>
<div class="panel-body">
<p> <?=$conf['gonggao']?></p>
</div>
</div></div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
          <span class="badge bg-warning pull-right"><?=$keys?></span>
          <a href="" class="font-bold">我的播放器</a>
        </div>
		 <div class="panel-body pre-scrollable">
		<?php
	$sql=$DB->query("SELECT * FROM " . DBQZ . "_key WHERE uid={$userrow['uid']} order by time desc");
     while($row = $DB->fetch($sql))
     {
	$id_arr = array_unique(array_filter(explode("|",$row['song_id'])));
	$img=parseSongImg($id_arr[1]);
	?>
	<div id="del<?=$row['kid']?>">
          <li class="list-group-item clearfix">
		    <span class="pull-left thumb-sm avatar m-r">
              <img src="/Public/player.png" alt="">
              <i class="on b-white bottom"></i>
            </span>
		    <span class="pull-right">
              <a href="?do=key_set&kid=<?=$row['kid']?>" class="btn btn-sm btn-icon btn-info"><i class="fa fa-cog"></i></a>
			  <a href="javascript:;" name="<?=$row['kid']?>" id="key_del" class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
            </span>
            <span class="clear">
              <span><?=$row['web_name']?></span>
              <small class="text-muted clear text-ellipsis"> <?=$row['time']?></small>
            </span>
          </li><br/>
		  </div>
	 <?php }
	 if($keys=="0"){
		 echo '你还没有添加播放器';
	 }
	 ?>
        </div>
        <div class="clearfix panel-footer">
          <div class="input-group">
            <input type="text" class="form-control input-sm btn-rounded" name="name" placeholder="请输入要添加的播放器名称">
            <span class="input-group-btn">
              <button type="submit" id="key_add" class="btn btn-default btn-sm btn-rounded">确定</button>
            </span>
          </div>
        </div>
      </div>       
    </div>
<div class="col-sm-6">
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
          <span class="badge bg-warning pull-right">铭记恩情</span>
          <a href="" class="font-bold">赞助项目(快来请我吃大餐吧~)</a>
        </div>
		 <div class="panel-body pre-scrollable">
		<img src="/Public/zanzhu.jpg">
        </div>
		</div>
      </div>       
    </div>
</div>
<?php include_once("footer.php");?>