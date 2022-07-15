<?php include_once("header.php");?>
<input type="hidden" class="form-control" name="kid" value="<?=$row['kid']?>">
<div class="row">
<div class="col-sm-6">
<div class="panel b-a">
 <div class="m-t-n-xxs item pos-rlt">
                      <div class="top text-right">
                        <span class="musicbar bg-success bg-empty inline m-r-lg m-t" style="width:25px;height:30px">
                          <span class="bar1 a3 lter"></span>
                          <span class="bar2 a5 lt"></span>
                          <span class="bar3 a1 bg"></span>
                          <span class="bar4 a4 dk"></span>
                          <span class="bar5 a2 dker"></span>
                        </span>
                      </div>
                      <div class="bottom gd bg-info wrapper-lg">
                         <div class="pull-right"> <a class="btn btn-info" href="?do=player&key=<?=$row['key']?>">
          <i class="fa fa-file-code-o text"></i>
          <span class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 获取对接代码</font></font></span>
        </a></div>          
            <div class="text-u-c h3 m-b-sm"><?=$row['web_name']?> </div>
            <div><b>添加于:</b><?=$row['time']?></div>
			<div>人这一生能遇到自己爱的TA，但终遇不到爱你的TA</div>
            </div>
            <img class="img-full" src="https://api.piphp.com/api/tu/" alt="...">
            </div>
		<?php 
		$song_id=isset($row['song_id'])?trim(str_replace(" ","",str_replace("\n", "",str_replace("\r\n", "",$row['song_id']))),'|'):'';;
	    $song_arr=array_unique(array_filter(explode("|",$song_id)));
		$json=json_encode($song_arr);
		?>
		<div class="panel-body pre-scrollable">
		<span id="song_list">
		</span>
		<?php
	foreach ($song_arr as  $v) { 
    $song_name=parseSongId($v);
	$song_Artist=parseSongArtist($v);	
	?>
	<div id="del<?=$v?>">
           <ul class="list-group list-group-lg no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                      <li class="list-group-item">
                        <div class="pull-right m-l">
                          <a href="javascript:;" name="<?=$v?>" id="song_del"><i class="icon-close"></i></a>
                        </div>
                        <div class="clear text-ellipsis">
                          <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$song_name?></font></font></span>
                          <span class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$song_Artist?></font></font></span>
                        </div>
                      </li>
                    </ul><br/>
		  </div>
	 <?php
	 }
	 if($row['song_id']==""){
		 echo '你还没有添加歌曲哦';
	 }?>
        </div>
      </div>
</div>
<div class="col-sm-6">
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
          <a href="" class="font-bold">基础信息</a>
        </div>
		 <div class="panel-body">
		                        <div class="form-group">
                                <label for="exampleFormControlInput12">播放器名称</label>
                                <input type="text" class="form-control r-0" name="web_name" placeholder="请输入播放器名称" value="<?=$row['web_name']?>">
                                </div>
								<div class="form-group">
                                <label for="exampleFormControlInput12">播放器欢迎语</label>
                                <input type="text" class="form-control r-0" name="web_welcome" placeholder="请输入播放器欢迎语" value="<?=$row['web_welcome']?>">
                                </div>
								<div class="form-group">
                                <label for="exampleFormControlInput12">歌单名称</label>
                                <input type="text" class="form-control r-0" name="song_album" placeholder="请输入歌单名称" value="<?=$row['song_album']?>">
                                </div>
								<div class="form-group">
                                <label for="exampleFormControlInput12">歌单后缀</label>
                                <input type="text" class="form-control r-0" name="song_album_1" placeholder="请输入歌单作者" value="<?=$row['song_album_1']?>">
                                </div>
	<button type="button" id="key_update" class="btn btn-success">更改</button>
      </div> 
	 </div> 
	 <div class="block full2">
<!--TAB标签-->
	<div class="block-title">
       <ul class="nav nav-tabs" id="panel-heading">
	        <li style="width: 25%;" class="active" align="center"><a href="#id_add" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-edit "></i> 手动添加</span></a></li>
			<li style="width: 25%;" align="center"><a href="#list_add" data-toggle="tab"><span style="font-weight:bold"><i class="fa  fa-file-sound-o"></i> 歌单导入</span></a></li>
            <li style="width: 25%;" align="center"><a href="#search_add" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-search"></i> 搜索添加</span></a></li>
        </ul>
    </div>
<!--TAB标签-->
    <div class="tab-content">
	<!--输入歌曲id添加-->
    <div class="tab-pane active" id="id_add">
    <div class="panel panel-info">
    <div class="panel-heading bk-bg-info">
          怎么找歌曲ID?<a href="https://www.bilibili.com/video/BV16z4y1k7ao" class="font-bold"><font color="#FF0000">【点我查看】</font> </a>
        </div>
		 <div class="panel-body">
		                        <div class="form-group">
                                <input type="text" class="form-control r-0" name="song_id" placeholder="请输入歌曲ID值" value="">
                                </div>
								<div class="form-group">
                               <select class="form-control" name="type">
								<option value="wy">网易云音乐</option>
								<option value="qq">QQ音乐（有的歌曲添加上会无法播放）</option>
								</select>
                                </div>
								<div id="alert_frame" class="alert alert-success animation-pullUp" style="font-weight: bold;"><div align="left">
								建议歌单内歌曲不超过100首，不然可能加载过慢
								</div>
								</div>
								<button id="song_add_id" class="btn btn-block btn-success">添加</button>
      </div> 
	 </div> 
	</div>
<!--输入歌单id导入-->
        <div class="tab-pane" id="list_add">
        <div class="panel panel-info">
        <div class="panel-heading bk-bg-info">
        怎么找歌单ID?<a href="https://www.bilibili.com/video/BV16z4y1k7ao" class="font-bold"><font color="#FF0000">【点我查看】</font> </a>
        </div>
		 <div class="panel-body">
								<div class="form-group">
                                <input type="text" class="form-control r-0" name="song_album_id" placeholder="请输入歌单ID" value="">
                                </div>
								<div class="form-group">
                                <select class="form-control" name="types">
								<option value="wy">网易云音乐</option>
								</select>
                                </div>
								<div id="alert_frame" class="alert alert-success animation-pullUp" style="font-weight: bold;"><div align="left">
								<font color="red">注意:目前只支持网易云音乐,日后会更新其他平台</font><br/>
								建议歌单内歌曲不超过100首,不然可能加载过慢
								</div>
								</div>
								<button type="button" id="song_add_playlist" class="btn btn-block btn-success">导入</button>
      </div> 
	 </div> 
	</div>
<!--输入歌单id导入-->
<!--搜索歌曲添加-->
    <div class="tab-pane" id="search_add">	
	<div class="panel panel-info">
    <div class="panel-heading bk-bg-info">
        <a href="" class="font-bold">搜索音乐</a>
        </div>
		 <div class="panel-body">
		 <div class="clearfix">
          <div class="input-group">
            <input type="text" class="form-control input-sm btn-rounded" name="song_name" placeholder="请输入要搜索的歌曲名称">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-sm btn-rounded" id="search" ><i class="fa fa-search"></i></button>
            </span>
          </div>
        </div>
		</div>
		<div class="panel-body pre-scrollable">
		<table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">歌曲名称</font></font></th>
            <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">歌手</font></font></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody id="search_list">      
        </tbody>
      </table>
        </div>
      </div> 
	 </div>
  	</div>
<!--搜索歌曲添加-->

    </div>
   </div>
  </div>
</div>
<?php include_once("footer.php");?>