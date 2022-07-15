<?php
$url=isset($_GET['url'])?$_GET['url']:$urlblog;
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
正在加载中,请耐心等待...
<script language='javascript'>window.location.href='".$url."';</script>";