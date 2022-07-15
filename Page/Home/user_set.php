<?php include_once("header.php");?>
<div class="row">
<div class="col-sm-6">
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
          <a href="" class="font-bold">信息修改</a>
        </div>
		 <div class="panel-body">
		<div class="form-group">
       <label for="exampleFormControlInput12">电子邮箱</label>
       <input type="email" class="form-control r-0" name="email" placeholder="请输入电子邮箱" value="<?=$userrow['email']?>">
       </div>
       <div class="form-group">
       <label for="exampleFormControlInput12">QQ账号</label>
       <input type="text" class="form-control r-0" name="qq" placeholder="请输入QQ账号" value="<?=$userrow['qq']?>">
       </div>
       <button type="button" id="user_update" class="btn btn-success">更改</button>
      </div> 
	 </div> 
  </div>
 <div class="col-sm-6">
<div class="panel panel-info">
<div class="panel-heading bk-bg-info">
          <a href="" class="font-bold">密码修改</a>
        </div>
		 <div class="panel-body">
		<div class="form-group">
       <label for="exampleFormControlInput12">旧密码</label>
       <input type="password" class="form-control r-0" name="pwd" placeholder="请输入旧密码">
       </div>
	   <div class="form-group">
       <label for="exampleFormControlInput12">新密码</label>
        <input type="password" class="form-control r-0" name="pwds" placeholder="请输入新密码">
        </div>
		<button type="button" id="pwd_update" class="btn btn-success">更改</button>
      </div> 
	 </div> 
  </div>
</div>
<?php include_once("footer.php");?>