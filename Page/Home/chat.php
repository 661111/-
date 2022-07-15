<?php include_once("header.php");?>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">快与大家热聊吧</font></font><span class="pull-right"><a href="#head">以往的消息</a></span></div>
        <div class="panel-body pre-scrollable" background="#000">
		<?php 
	 $sql=$DB->query("SELECT * FROM " . DBQZ . "_chat WHERE 1");
     while($row = $DB->fetch($sql))
     {
	 $user=$DB->get_row("select * from ". DBQZ ."_user where `uid` = '{$row['uid']}' limit 1");
     $dates=time_tran($row['time']);	
	 if($user['uid']==$userrow['uid']){
	 ?> 
	 <span id="head"></span>
	 <div id="<?=$row['cid']?>" class="m-b">
            <a href="" class="pull-right thumb-sm avatar"><img src="https://q2.qlogo.cn/headimg_dl?dst_uin=<?=$user['qq']?>&spec=100" class="img-circle" alt="<?=$user['user']?>"></a>
            <div class="m-r-xxl">
              <div class="pos-rlt wrapper bg-primary r r-2x">
                <span class="arrow right pull-up arrow-primary"></span>
                <p class="m-b-none"><font style="vertical-align: inherit;"><?=$row['con']?></font></p>
              </div>
              <small class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> <?=$dates?></font></font></small>
            </div>
          </div> 
	 <?php }else{?>		
     <div  id="<?=$row['cid']?>" class="m-b">
             <a href="" class="pull-left thumb-sm avatar"><img src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?=$user['qq']?>&spec=100" class="img-circle" alt="<?=$user['user']?>"></a>
            <div class="m-l-xxl">
              <div class="pos-rlt wrapper b b-light r r-2x">
                <span class="arrow left pull-up"></span>
                <p class="m-b-none"><?=$row['con']?></p>
              </div>
              <small class="text-muted"><i class="fa fa-ok text-success"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> <?=$dates?></font></font></small>
            </div>
          </div>
	 <?php }}?>	 
	 <span id="foot"></span>
        </div>
        <footer class="panel-footer">
          <div>
            <textarea  class="form-control" name="con" rows="5"></textarea><br/>
			<div id="embed-captcha">
			<a id="loadcode" class="btn btn-lg btn-default btn-block">点击加载验证码</a>
			</div><br>
			<button type="button" id="chat_add" class="btn btn-success">发送</button>
          </div>
        </footer>
      </div>
</div>
</div>

<script src="/Core/Core/static/gt.js"></script>
<?php include_once("footers.php");?>