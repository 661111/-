<?php include_once("header.php");?>
<div class="row">
<div class="col-sm-12">
<div class="panel-body pre-scrollable">
<p>复制下方代码放到你的网站&lt;/body&gt;标签前边，注意你的网页中只能存在一个jquery，否则会造成冲突</p>
<pre class="mt-2"><code><font color="#42d031">&lt;!-- 音乐播放器插件开始 --&gt;</font>
<font color="#34a0ff">&lt;link</font> <font color="#ff343d">href</font>=<font color="#f5ee27">"https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"></font><font color="#34a0ff">&gt;</font>
<font color="#34a0ff">&lt;link</font> <font color="#ff343d">href</font>=<font color="#f5ee27">"<?=$weburl?>Public/XPlayer/style/player.css"</font> <font color="#ff343d">rel</font>=<font color="#f5ee27">"stylesheet"</font> <font color="#ff343d">type</font>=<font color="#f5ee27">"text/css"</font><font color="#34a0ff">&gt;</font>
<font color="#34a0ff">&lt;div</font> <font color="#ff343d">id</font>=<font color="#f5ee27">"XPlayer"</font><font color="#34a0ff">&gt;</font>
<font color="#34a0ff">&lt;/div&gt;</font>
<font color="#34a0ff">&lt;script</font> <font color="#ff343d">type</font>=<font color="#f5ee27">"text/javascript"</font><font color="#34a0ff">&gt;</font>
    key='<?=$row['key']?>';<font color="#42d031">/* 播放器key密钥 */</font>
	document.write("&lt;scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/jquery.min.js\"&gt;&lt;/sc"+"ript&gt;");
	document.write("&lt;scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/mousewheel.js\"&gt;&lt;/sc"+"ript&gt;");
	document.write("&lt;scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/scrollbar.js\"&gt;&lt;/sc"+"ript&gt;");
	document.write("&lt;scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/player.js\"&gt;&lt;/sc"+"ript&gt;");
<font color="#34a0ff">&lt;/script&gt;</font>
<font color="#42d031">&lt;!-- 音乐播放器插件结束 --&gt;</font>
</code></pre>
</div>
</div>
</div>
<!-- 音乐播放器插件开始 -->
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$weburl?>Public/XPlayer/style/player.css">
<div id="XPlayer">
</div>
<script type="text/javascript">
    key='<?=$row['key']?>';/*KEY密钥*/
	volume='<?=$row['web_volume']?>';/*默认音量*/
	musicfirsttip='<?=$row['web_volume']?>';/*欢迎语开关*/
	document.write("<scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/jquery.min.js\"></sc"+"ript>");
	document.write("<scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/mousewheel.js\"></sc"+"ript>");
	document.write("<scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/scrollbar.js\"></sc"+"ript>");
	document.write("<scr"+"ipt src=\"<?=$weburl?>Public/XPlayer/js/player.js\"></sc"+"ript>");
</script>
<!-- 音乐播放器插件结束 -->
<?php include_once("footer.php");?>