<?php include_once("header.php");?>
<div class="row">
<div class="col-sm-6">
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
          <span class="badge bg-warning pull-right">共<?=$keys?>个</span>
          <div class="font-bold">播放器管理</div>
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
		 echo '你还没有添加播放器哦';
	 }
	 ?>
        </div>
      </div>       
    </div>
	<div class="row">
    <div class="col-sm-6">
	<div class="panel panel-info">
    <div class="panel-heading bk-bg-info">
          <div class="font-bold">添加播放器</div>
        </div>
		 <div class="panel-body pre-scrollable">
	<div class="clearfix panel-footer">
          <div class="input-group">
            <input type="text" class="form-control input-sm btn-rounded" name="name" placeholder="请输入要添加的播放器名称">
            <span class="input-group-btn">
              <button type="submit" id="key_add" class="btn btn-default btn-sm btn-info">确定</button>
            </span>
          </div>
        </div>
		</div>
<?php include_once("footer.php");?>