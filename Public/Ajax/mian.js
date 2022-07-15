$().ready(function() {
	//user
	$("[id=logout]").click(function() {
		layer.confirm('您确定要退出吗？', {
			time: 20000, 
			btn: ['确认', '点错了']
		}, function(index) {
			layer.close(index);
			layer.load(2);
			setTimeout(function() {
				$.ajax({
					url: '/Core/ajax.php?act=logout',
					type: 'post',
					dataType: 'json',
					data: {
					},
					success: function(data) {
						layer.open({
    content: data.msg
    ,skin: 'msg'
    ,time: 2 //2秒后自动关闭
  });
						if (data.code == 0) {
						window.location.href = "?do=index";
						}
					}
				});
			}, 1000);
		});
	});
	
	$("#login").click(function(e) {
		var user = $("input[name='user']").val();
		var pwd = $("input[name='pwd']").val();
		if (user == '' || pwd == '') {
		layer.msg('<font color="#000000">请填充完整信息</font>', {icon: 3});
			return false;
		}
  $.ajax({
			url: '/Core/ajax.php?act=login',
			type: 'post',
			dataType: 'json',
			data:{"user":user,"pwd":pwd},
			success: function(data) {
			var str = data.msg;
			if (data.code == 1) {
			layer.msg('<font color="#000000">登陆成功,正在跳转...</font>',{icon:16,shade:0.3});
			window.location.href = "?do=home";
			}else if (data.code == 2) {
			layer.msg('<font color="#000000">用户名或密码错误</font>', {icon: 5});
			}
			}
		});
	});
	
	$("#reg").click(function(e) {
		var user = $("input[name='user']").val();
		var email = $("input[name='email']").val();
		var qq = $("input[name='qq']").val();
		var pwd = $("input[name='pwd']").val();
		var pwds = $("input[name='pwds']").val();
		if (user == '' || email == '' || qq == '' || pwd == '' || pwds == '') {
		layer.msg('<font color="#000000">请填充完整信息</font>', {icon: 3});
			return false;
		}
  $.ajax({
			url: '/Core/ajax.php?act=reg',
			type: 'post',
			dataType: 'json',
			data:{"user":user,"email":email,"qq":qq,"pwd":pwd,"pwds":pwds},
			success: function(data) {
			var str = data.msg;
			layer.close(layer.load());
			if (data.code == 1) {
			layer.msg('<font color="#000000">注册成功,正在跳转...</font>',{icon:16,shade:0.3});
			window.location.href = "?do=login";
			}else if (data.code == 2) {
			layer.msg('<font color="#000000">用户名已存在</font>', {icon: 5});
			}else if (data.code == 3) {
			layer.msg('<font color="#000000">此邮箱已注册过用户</font>', {icon: 5});
			}else if (data.code == 4) {
			layer.msg('<font color="#000000">两次密码输入不一致</font>', {icon: 5});
			}else if (data.code == 5) {
			layer.msg('<font color="#000000">电子邮箱无效</font>', {icon: 5});
			}else if (data.code == 6) {
			layer.msg('<font color="#000000">QQ账号已经被绑定</font>', {icon: 5});
			}
			}
		});
	});
	$("#user_update").click(function(e) {
		var email = $("input[name='email']").val();
		var qq = $("input[name='qq']").val();
		if (email == '' || qq == '') {
		layer.msg('请填写重要信息', {icon: 3});
			return false;
		}
  $.ajax({
			url: '/Core/ajax.php?act=user_update',
			type: 'post',
			dataType: 'json',
			data:{"email":email,"qq":qq},
			success: function(data) {
			var str = data.msg;
			if (data.code == 1) {
			layer.msg('更新资料成功，请刷新本页面', {icon: 6});
			}else if (data.code == 2) {
			layer.msg('网络错误', {icon: 5});
			}
			}
		});
	}); 
	$("#pwd_update").click(function(e) {
		var pwd = $("input[name='pwd']").val();
		var pwds = $("input[name='pwds']").val();
		if (pwd == '' || pwds == '') {
		layer.msg('请填写旧密码或者新密码', {icon: 3});
			return false;
		}else if(pwds == pwd){
		layer.msg('新密码不能跟旧密码相同', {icon: 4});
			return false;
		}
  $.ajax({
			url: '/Core/ajax.php?act=pwd_update',
			type: 'post',
			dataType: 'json',
			data:{"pwd":pwd,"pwds":pwds},
			success: function(data) {
			var str = data.msg;
			if (data.code == 1) {
			layer.msg('更新密码成功，请刷新本页面', {icon: 6});
			}else if (data.code == 2) {
			layer.msg('更新失败,网络错误', {icon: 5});
			}else if (data.code == 3) {
			layer.msg('更新失败,旧密码错误', {icon: 5});
			}
			}
		});
	}); 
	$("#key_add").click(function(e) {
		var name = $("input[name='name']").val();
		if (name == '') {
		layer.msg('请填写播放器名称', {icon: 3});
			return false;
		}
  $.ajax({
			url: '/Core/ajax.php?act=key_add',
			type: 'post',
			dataType: 'json',
			data:{"name":name},
			success: function(data) {
			if (data.code == 1) {
			layer.msg('添加播放器成功，请刷新本页面', {icon: 6});
			}else if (data.code == 2) {
			layer.msg('key分配失败,请重试', {icon: 5});
			}else if (data.code == 3) {
			layer.msg('额度不足', {icon: 5});
			}else if (data.code == 4) {
			layer.msg('网络错误', {icon: 5});
			}
			}
		});
	}); 
	//admin
	$.ajax({
		type : "GET",
		url : "/Core/ajax.php?act=admin_msg",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#texts').html(data.texts);
			$('#users').html(data.users);
			$('#comments').html(data.comments);
			x=document.getElementById("admin_msg");
	        x.innerHTML=data.admin_msg;
		}
	});
	$("[id=web_set]").click(function() {
		var name = $("input[name='name']").val();
		var cloudinfo = $("input[name='cloudinfo']").val();
		var description = $("input[name='description']").val();
		var keywords = $("input[name='keywords']").val();
		var web_zt = $("select[name='web_zt']").val();
		var gonggao = $("textarea[name='gonggao']").val();
		var help = $("textarea[name='help']").val();
		if (name == '') {
		layer.msg('网站名称不能为空', {icon: 5});
			return false;
		}
  $.ajax({
			url: '/Core/ajax.php?act=web_set',
			type: 'post',
			dataType: 'json',
			data:{"name":name,"cloudinfo":cloudinfo,"description":description,"keywords":keywords,"web_zt":web_zt,"gonggao":gonggao,"help":help},
			success: function(data) {
			var str = data.msg;
			if (data.code == 1) {
			layer.msg('更改成功', {icon: 6});
			}
			}
		});
	});
	$("[id=user_set]").click(function() {
		var uid = $("input[name='uid']").val();
		var user = $("input[name='user']").val();
		var amount = $("input[name='amount']").val();
		if (user == ''|| amount == '') {
		layer.msg('请填写完整', {icon: 5});
			return false;
		}
  $.ajax({
			url: '/Core/ajax.php?act=user_set',
			type: 'post',
			dataType: 'json',
			data:{"uid":uid,"user":user,"amount":amount},
			success: function(data) {
			var str = data.msg;
			if (data.code == 1) {
			layer.msg('更改成功，请刷新本页面', {icon: 6});
			}else{
			layer.msg('更改失败', {icon: 5});	
			}
			}
		});
	});
	$("[id=key_update]").click(function() {
		var kid = $("input[name='kid']").val();
		var web_name = $("input[name='web_name']").val();
		var web_welcome = $("input[name='web_welcome']").val();
		/*var web_musicfirsttip = $("select[name='web_musicfirsttip']").val();*/
		var song_album = $("input[name='song_album']").val();
		var song_album_1 = $("input[name='song_album_1']").val();
		var song_album_id = $("input[name='song_album_id']").val();
		/*var web_volume = $("input[name='web_volume']").val();*/
		if (web_name == '') {
		layer.msg('播放器名称不能为空', {icon: 5});
			return false;
		}
		layer.load(1);
  $.ajax({
			url: '/Core/ajax.php?act=key_update',
			type: 'post',
			dataType: 'json',
			data:{
				"kid":kid,
				"web_name":web_name,
				"web_welcome":web_welcome,
				"song_album":song_album,
				"song_album_1":song_album_1,
				"song_album_id":song_album_id,
				/*"web_musicfirsttip":web_musicfirsttip,
				"web_volume":web_volume*/
				},
			success: function(data) {
			layer.closeAll('loading');
			if (data.code == 1) {
			layer.msg('更改成功，请刷新本页面', {icon: 6});
			}else{
			layer.msg('更改失败', {icon: 5});	
			}
			}
		});
	});
	$("[id=song_add_playlist]").click(function() {
		var kid = $("input[name='kid']").val();
		var song_album_id = $("input[name='song_album_id']").val();
		var type = $("select[name='types']").val();
		layer.load(1);
  $.ajax({
			url: '/Core/ajax.php?act=song_add_playlist',
			type: 'post',
			dataType: 'json',
			data:{"kid":kid,"song_album_id":song_album_id,"type":type},
			success: function(data) {
			layer.closeAll('loading');
			if (data.code == 1) {
			layer.msg('添加成功，请刷新本页面', {icon: 6});
			}else{
			layer.msg('添加失败', {icon: 5});	
			}
			}
		});
	});
	$("[id=search]").click(function() {
		var kid = $("input[name='kid']").val();
		var name = $("input[name='song_name']").val();
		$('#search_list').html('<tr><th><img src="/Public/Other/layer/theme/default/loading-2.gif"  width="20px"/></th></tr>');
		 $.ajax({
			url: 'http://musicapi.leanapp.cn/search?',//音乐搜索接口
			type: 'GET',
			dataType: 'json',
			data:{
				"keywords":name
			},
			success: function(data) {
			if (data.code == 200) {
            var html = '';

				for (x in data["result"]["songs"]) {

					html = html + "<tr>";

					html = html + "<td><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>"+ data["result"]["songs"][x]["name"] +"</font></font></td>";

					html = html + "<td><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>"+ data["result"]["songs"][x]["artists"][0]["name"]+"</font></font></td>";

					html = html + "<td><a href='javascript:;' name='"+ data["result"]["songs"][x]["id"] +"wy'  id='song_add_search' class='active'><i class='glyphicon glyphicon-plus text-success text-active'></i><i class='fa fa-times text-danger text'></i></a></td>";

					html = html + "</tr>";

				}
	   $('#search_list').html(html);
       $("[id=song_add_search]").click(function() {
		var id = $(this).attr("name");
		layer.load(1);
  $.ajax({
			url: '/Core/ajax.php?act=song_add_search',
			type: 'post',
			dataType: 'json',
			data:{
				"kid":kid,
				"id":id,
				},
			success: function(data) {
			layer.closeAll('loading');
			if (data.code == 1) {
			layer.msg(data.msg, {icon: 6});
			}else{
			layer.msg(data.msg, {icon: 5});	
			}
			}
		});
	});
			}else if(data.code == 400){
				$('#search_list').html('<tr><th>糟糕，还没有输入搜索内容~</th></tr>');
			}
			}
		});
	});
	
	
	$("[id=song_add_id]").click(function() {
		var kid = $("input[name='kid']").val();
		var song_id = $("input[name='song_id']").val();
		var type = $("select[name='type']").val();
		layer.load(1);
  $.ajax({
			url: '/Core/ajax.php?act=song_add_id',
			type: 'post',
			dataType: 'json',
			data:{"kid":kid,"song_id":song_id,"type":type},
			success: function(data) {
			layer.closeAll('loading');
			if (data.code == 1) {
			layer.msg(data.msg, {icon: 6});
			}else{
			layer.msg(data.msg, {icon: 5});	
			}
			}
		});
	});
	$("[id=chat_add]").click(function() {
		var con = $("textarea[name='con']").val();
		if (con == '') {
		layer.msg('不能发布空白消息', {icon: 5});
			return false;
		}
		layer.load(1);
  $.ajax({
			url: '/Core/ajax.php?act=chat_add',
			type: 'post',
			dataType: 'json',
			data:{"con":con},
			success: function(data) {
			layer.closeAll('loading');
			if (data.code == 1) {
			layer.msg('发送消息成功，请刷新本页面', {icon: 6});
			}else{
			layer.msg('发送消息失败', {icon: 5});	
			}
			}
		});
	});
	$("[id=key_del]").click(function() {
		var kid = $(this).attr("name");

		layer.confirm('您确定要删除这个播放器吗？', {
			btn: ['确认', '取消']
		}, function(index) {
			layer.close(index);
			layer.load(1);
			setTimeout(function() {
				$.ajax({
					url: '/Core/ajax.php?act=key_del',
					type: 'post',
					dataType: 'json',
					data: {
						kid: kid,
					},
					success: function(data) {
						layer.closeAll('loading');
						if (data.code == 1) {
							$('#del' + kid).html('');
							layer.msg(data.msg, {icon: 6});
						} else {
							layer.msg(data.msg, {icon: 5});
						}
					}
				});
			}, 500);
		});
	})  
	$("[id=version_add]").click(function() {
		var version = $("input[name='version']").val();
		var con = $("textarea[name='con']").val();
		layer.load(1);
  $.ajax({
			url: '/Core/ajax.php?act=version_add',
			type: 'post',
			dataType: 'json',
			data:{
				"version":version,
				"con":con
				},
			success: function(data) {
			layer.closeAll('loading');
			if (data.code == 1) {
			layer.msg(data.msg, {icon: 6});
			}else{
			layer.msg(data.msg, {icon: 5});	
			}
			}
		});
	});
	$("[id=song_del]").click(function() {
		var id = $(this).attr("name");
		var kid = $("input[name='kid']").val();
        $('#del' + id).html('');
				$.ajax({
					url: '/Core/ajax.php?act=song_del',
					type: 'post',
					dataType: 'json',
					data: {
						id: id,kid: kid
					},
					success: function(data) {
						if (data.code == 1) {
							layer.msg(data.msg, {icon: 6});
						} else {
							layer.msg(data.msg, {icon: 5});
						}
					}
				});

	})  
});  
