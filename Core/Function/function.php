<?php
function saveSetting($k, $v) {
    global $DB;
    $v = addslashes($v);
    return $DB->query("REPLACE INTO " . DBQZ . "_config SET v='$v',k='$k'");
}

function iflogin($cookie) {
session_start();
	if(isset($_COOKIE[DBQZ . "_cookie"])&&time()>$_COOKIE[DBQZ . "_cookie"]+3600*24*14){
		return true;
	}else{
		return false;
	}
}

function msg($msg, $jump)
{
    if($jump==1){
        $url = "window.history.go(-1);";
    }elseif ($jump) {
        $url = 'window.location.href="' . $jump . '";';
    }
    echo '
	<script language="javascript">
layer.msg("' . $msg . '",function(index){' . $url . 'layer.close(index);});
</script>';
    exit;
}

function daddslashes($string, $force = 0, $strip = FALSE) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}

function getkey($len = 20){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$strlen = strlen($str);
	$randstr = "";
	for ($i = 0; $i < $len; $i++) {
		$randstr .= $str[mt_rand(0, $strlen - 1)];
	}
	return $randstr;
}

function getnum($len = 1){
	$str = "1234567890";
	$strlen = strlen($str);
	$randstr = "";
	for ($i = 0; $i < $len; $i++) {
		$randstr .= $str[mt_rand(0, $strlen - 1)];
	}
	return $randstr;
}


function real_ip() {
    //判断服务器是否允许$_SERVER
    if(isset($_SERVER)){    
        if(isset($_SERVER[HTTP_X_FORWARDED_FOR])){
            $realip = $_SERVER[HTTP_X_FORWARDED_FOR];
        }elseif(isset($_SERVER[HTTP_CLIENT_IP])) {
            $realip = $_SERVER[HTTP_CLIENT_IP];
        }else{
            $realip = $_SERVER[REMOTE_ADDR];
        }
    }else{
        //不允许就使用getenv获取  
        if(getenv("HTTP_X_FORWARDED_FOR")){
              $realip = getenv( "HTTP_X_FORWARDED_FOR");
        }elseif(getenv("HTTP_CLIENT_IP")) {
              $realip = getenv("HTTP_CLIENT_IP");
        }else{
              $realip = getenv("REMOTE_ADDR");
        }
    }

    return $realip;
}


/**
 * 截取编码为utf8的字符串
 *
 * @param string $strings 预处理字符串
 * @param int $start 开始处 eg:0
 * @param int $length 截取长度
 */
function subString($strings, $start, $length) {
	if (function_exists('mb_substr') && function_exists('mb_strlen')) {
		$sub_str = mb_substr($strings, $start, $length, 'utf8');
		return mb_strlen($sub_str, 'utf8') < mb_strlen($strings, 'utf8') ? $sub_str . '...' : $sub_str;
	}
	$str = substr($strings, $start, $length);
	$char = 0;
	for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) >= 128)
			$char++;
	}
	$str2 = substr($strings, $start, $length + 1);
	$str3 = substr($strings, $start, $length + 2);
	if ($char % 3 == 1) {
		if ($length <= strlen($strings)) {
			$str3 = $str3 .= '...';
		}
		return $str3;
	}
	if ($char % 3 == 2) {
		if ($length <= strlen($strings)) {
			$str2 = $str2 .= '...';
		}
		return $str2;
	}
	if ($char % 3 == 0) {
		if ($length <= strlen($strings)) {
			$str = $str .= '...';
		}
		return $str;
	}
}

/**
 * 从可能包含html标记的内容中萃取纯文本摘要
 *
 * @param string $data
 * @param int $len
 */
function extractHtmlData($data, $len) {
	$data = strip_tags(subString($data, 0, $len + 30));
	$search = array("/([\r\n])[\s]+/", // 去掉空白字符
		"/&(quot|#34);/i", // 替换 HTML 实体
		"/&(amp|#38);/i",
		"/&(lt|#60);/i",
		"/&(gt|#62);/i",
		"/&(nbsp|#160);/i",
		"/&(iexcl|#161);/i",
		"/&(cent|#162);/i",
		"/&(pound|#163);/i",
		"/&(copy|#169);/i",
		"/\"/i",
	);
	$replace = array(" ", "\"", "&", " ", " ", "", chr(161), chr(162), chr(163), chr(169), "");
	$data = trim(subString(preg_replace($search, $replace, $data), 0, $len));
	return $data;
}

function remove_xss($string) { 
    $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

    $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

    $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

    $parm = array_merge($parm1, $parm2); 

    for ($i = 0; $i < sizeof($parm); $i++) { 
        $pattern = '/'; 
        for ($j = 0; $j < strlen($parm[$i]); $j++) { 
            if ($j > 0) { 
                $pattern .= '('; 
                $pattern .= '(&#[x|X]0([9][a][b]);?)?'; 
                $pattern .= '|(&#0([9][10][13]);?)?'; 
                $pattern .= ')?'; 
            }
            $pattern .= $parm[$i][$j]; 
        }
        $pattern .= '/i';
        $string = preg_replace($pattern, ' ', $string); 
    }
    return $string;
}

/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
    $string = str_replace('%20','',$string);
    $string = str_replace('%27','',$string);
    $string = str_replace('%2527','',$string);
    $string = str_replace('*','',$string);
    $string = str_replace('"','&quot;',$string);
    $string = str_replace("'",'',$string);
    $string = str_replace('"','',$string);
    $string = str_replace(';','',$string);
    $string = str_replace('<','',$string);
    $string = str_replace('>','',$string);
    $string = str_replace("{",'',$string);
    $string = str_replace('}','',$string);
	$string = str_replace('/','',$string);
    $string = str_replace('\\','',$string);
    return $string;
}

function safe_replace_2($string) {
    $string = str_replace('%20','',$string);
    $string = str_replace('%27','',$string);
    $string = str_replace('%2527','',$string);
    $string = str_replace('*','',$string);
    $string = str_replace('"','&quot;',$string);
    $string = str_replace("'",'',$string);
    $string = str_replace('"','',$string);
    $string = str_replace(';','',$string);
    $string = str_replace('<','&lt;',$string);
    $string = str_replace('>','&gt;',$string);
    $string = str_replace("{",'',$string);
    $string = str_replace('}','',$string);
    $string = str_replace('\\','',$string);
    return $string;
}

/**
 * 时间转化函数
 */

function time_tran($the_time) {
    $now_time = date("Y-m-d H:i:s", time());
	//echo $now_time;
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {//30天内
                        return floor($dur / 86400) . '天前';
                    } else {
                    if ($dur < 31104000) {//12月内
                        return floor($dur / 2592000) . '月前';
                    }else{if ($dur < 3110400000) {//100年内
                        return floor($dur / 31104000) . '年前';
                    } else{
                        return $the_time;
                    }
                }
            }
        }
    }
	}
  }
  }


function get_ip_city($ip) {
    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=';
    @$city = get_curl($url . $ip);
    $city = json_decode($city, true);
    if ($city['city']) {
        $location = $city['province'] . $city['city'];
    } else {
        $location = $city['province'];
    }
    if ($location) {
        return $location;
    } else {
        return false;
    }
}
 
function img($comtent){
preg_match_all('/<img.*?src="(.*?)".*?>/is',$comtent,$matchContent);
if(isset($matchContent[1][0])){
return $matchContent[1][0];
}else{
return "1";
}
}

function get_curl($url, $post=0, $referer=0, $cookie=0, $header=0, $ua=0, $nobaody=0)

{

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

	$httpheader[] = "Accept:application/json";

	$httpheader[] = "Accept-Encoding:gzip,deflate,sdch";

	$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";

	$httpheader[] = "Connection:close";

	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);

	if ($post) {

		curl_setopt($ch, CURLOPT_POST, 1);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

	}

	if ($header) {

		curl_setopt($ch, CURLOPT_HEADER, true);

	}

	if ($cookie) {

		curl_setopt($ch, CURLOPT_COOKIE, $cookie);

	}

	if($referer){

		if($referer==1){

			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');

		}else{

			curl_setopt($ch, CURLOPT_REFERER, $referer);

		}

	}

	if ($ua) {

		curl_setopt($ch, CURLOPT_USERAGENT, $ua);

	}

	else {

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (MSIE 9.0; Windows NT 6.1; Trident/5.0)");

	}

	if ($nobaody) {

		curl_setopt($ch, CURLOPT_NOBODY, 1);

	}

	curl_setopt($ch, CURLOPT_ENCODING, "gzip");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$ret = curl_exec($ch);

	curl_close($ch);

	return $ret;

}

function parseSheet($songsheetstr) {
		$type=substr($songsheetstr,-2);
		$songsheetid=substr($songsheetstr, 0, -2);
		$play_list='';

		if($type=='wy'){
    		$data = get_curl('http://music.163.com/api/playlist/detail?id='.$songsheetid,0,'http://music.163.com/');
    		$arr = json_decode($data, true);
    		foreach ($arr["result"]["tracks"] as $value) {
			    $music_id = $value["id"];
			    $play_list .= '|'.$music_id.'wy';
    		}
		}elseif($type=='qq'){
			$data=get_curl('https://c.y.qq.com/v8/fcg-bin/fcg_v8_toplist_cp.fcg?g_tk=5381&uin=0&format=json&inCharset=utf-8&outCharset=utf-8&notice=0&platform=h5&needNewCode=1&tpl=3&page=detail&type=top&topid=27&_='.$songsheetid);
			$data=substr($data,21,-1);
			$arr=json_decode($data,true);
			foreach($arr["songlist"][1]["albummid"] as $value) {
				$music_id = $value["songmid"];
			   	 $play_list .= '|'.$music_id.'qq';
			}
		}
		return $play_list;
}

function parseSongId($id_type) {
	$type=substr($id_type,-2);
	$id=substr($id_type, 0, -2);
		if($type=='wy'){
			$data=get_curl('http://musicapi.leanapp.cn/song/detail?ids='.$id.'',0,'');

			$arr=json_decode($data, true);

			$SongName=$arr['songs'][0]['name'];

			$Artist=$arr['songs'][0]['ar'][0]['name'];

			$Album=$arr['songs'][0]['al']['name'];

			$ListenUrl='http://music.163.com/song/media/outer/url?id='.$id.'.mp3';

			$PicUrl=$arr['songs'][0]['al']['picUrl'];
		}elseif($type=='qq'){
        			$data=get_curl('https://music.clwl.online/api/music?type=qq&id='.$id.'&lrc=true');
        			$arr=json_decode($data,true);
					
        			$SongName=$arr['Data']['SongName'];
					
        			$Artist=$arr['Data']['SingerName'];
					
        			$Album=$arr['Data']['AlbumName'];
					
        			$ListenUrl=$arr['Data']['Url'];
					
        			$LrcUrl=$arr['Data']['Lrc'];
					
        			$PicUrl=$arr['Data']['Logo'];
					
        		}

		return $SongName;

}

function parseSongImg($id_type) {
	$type=substr($id_type,-2);
	$id=substr($id_type, 0, -2);
		if($type=='wy'){
			$data=get_curl('http://musicapi.leanapp.cn/song/detail?ids='.$id.'',0,'');

			$arr=json_decode($data, true);

			$SongName=$arr['songs'][0]['name'];

			$Artist=$arr['songs'][0]['ar'][0]['name'];

			$Album=$arr['songs'][0]['al']['name'];

			$ListenUrl='http://music.163.com/song/media/outer/url?id='.$id.'.mp3';

			$PicUrl=$arr['songs'][0]['al']['picUrl'];
		}elseif($type=='qq'){
        			$data=get_curl('https://music.clwl.online/api/music?type=qq&id='.$id.'&lrc=true');
        			$arr=json_decode($data,true);
					
        			$SongName=$arr['Data']['SongName'];
					
        			$Artist=$arr['Data']['SingerName'];
					
        			$Album=$arr['Data']['AlbumName'];
					
        			$ListenUrl=$arr['Data']['Url'];
					
        			$LrcUrl=$arr['Data']['Lrc'];
					
        			$PicUrl=$arr['Data']['Logo'];
					
        		}

		return $PicUrl;

}

function parseSongArtist($id_type) {
	$type=substr($id_type,-2);
	$id=substr($id_type, 0, -2);
		if($type=='wy'){
			$data=get_curl('http://musicapi.leanapp.cn/song/detail?ids='.$id.'',0,'');

			$arr=json_decode($data, true);

			$SongName=$arr['songs'][0]['name'];

			$Artist=$arr['songs'][0]['ar'][0]['name'];

			$Album=$arr['songs'][0]['al']['name'];

			$ListenUrl='http://music.163.com/song/media/outer/url?id='.$id.'.mp3';

			$PicUrl=$arr['songs'][0]['al']['picUrl'];
		}elseif($type=='qq'){
        		$data=get_curl('https://music.clwl.online/api/music?type=qq&id='.$id.'&lrc=true');
        			$arr=json_decode($data,true);
					
        			$SongName=$arr['Data']['SongName'];
					
        			$Artist=$arr['Data']['SingerName'];
					
        			$Album=$arr['Data']['AlbumName'];
					
        			$ListenUrl=$arr['Data']['Url'];
					
        			$LrcUrl=$arr['Data']['Lrc'];
					
        			$PicUrl=$arr['Data']['Logo'];
					
        		}

		return $Artist;

}
?>
