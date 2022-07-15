<?php
error_reporting(0);

$do=isset($_GET['do'])?$_GET['do']:exit;



switch($do){

	case 'parse':

		$type=isset($_GET['type'])?$_GET['type']:exit;

		$id=isset($_GET['id'])?$_GET['id']:null;

		$callback=isset($_GET['callback'])?$_GET['callback']:null;

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

		echo $callback.'({"location":"'.$ListenUrl.'","lyric":"'.$LrcUrl.'","album_cover":"'.$PicUrl.'","album_name":"'.$Album.'","artist_name":"'.$Artist.'","song_name":"'.$SongName.'","song_id":"'.$id.'"}) ';

	break;



	case 'lyric':

		if($_GET['type']=='wy'){

			$id=isset($_GET['id'])?$_GET['id']:null;

			$data=get_curl('http://music.163.com/api/song/lyric?os=pc&id='.$id.'&lv=-1&kv=-1&tv=-1',0,'http://music.163.com/');

			$arr=json_decode($data, true);

			$data=$arr['lrc']['lyric'];

		}elseif($_GET['type']=='qq'){
        			$id=isset($_GET['id'])?$_GET['id']:null;
        			$data=get_curl("http://i.y.qq.com/lyric/fcgi-bin/fcg_query_lyric.fcg?pcachetime=".time()."&songmid=".$id,0,"http://y.qq.com/",0);
        			preg_match('!MusicJsonCallback\((.*?)\)!',$data,$json);
        			$arr=json_decode($json[1], true);
        			$data=str_replace(array('&#58;','&#40;','&#41;','&#32;','&#10;','&#45;','&#46;',';',"\r"),array(';','(',')',' ','','-','.',':',''),base64_decode($arr['lyric']));
        		}else{

			$url=isset($_GET['url'])?$_GET['url']:null;

			$data=get_curl($url);

		}

		echo "var cont = '".str_replace("\n","",$data)."';";

	break;



	case 'color':
			$color = imgColor($_GET["url"]);
			$img_color = "{$color["r"]},{$color["g"]},{$color["b"]}";
			$data = array(
				"img_color" => $img_color
			);
		   echo "var cont = '" . $data["img_color"] . "';";

	break;

}

function imgColor($url) {
    $imageInfo = getimagesize($url);
    //图片类型
    $imgType = strtolower(substr(image_type_to_extension($imageInfo[2]) , 1));
    //对应函数
    $imageFun = 'imagecreatefrom' . ($imgType == 'jpg' ? 'jpeg' : $imgType);
    $i = $imageFun($url);
    //循环色值
    $rColorNum = $gColorNum = $bColorNum = $total = 0;
    for ($x = 0; $x < imagesx($i); $x++) {
        for ($y = 0; $y < imagesy($i); $y++) {
            $rgb = imagecolorat($i, $x, $y);
            //三通道
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $rColorNum+= $r;
            $gColorNum+= $g;
            $bColorNum+= $b;
            $total++;
        }
    }
    $rgb = array();
    $rgb['r'] = round($rColorNum / $total);
    $rgb['g'] = round($gColorNum / $total);
    $rgb['b'] = round($bColorNum / $total);
    return $rgb;
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

function ipcxiami($location){

$count = (int)substr($location, 0, 1);

$url = substr($location, 1);

$line = floor(strlen($url) / $count);

$loc_5 = strlen($url) % $count;

$loc_6 = array();

$loc_7 = 0;

$loc_8 = '';

$loc_9 = '';

$loc_10 = '';

while ($loc_7 < $loc_5){

$loc_6[$loc_7] = substr($url, ($line+1)*$loc_7, $line+1);

$loc_7++;

}

$loc_7 = $loc_5;

while($loc_7 < $count){

$loc_6[$loc_7] = substr($url, $line * ($loc_7 - $loc_5) + ($line + 1) * $loc_5, $line);

$loc_7++;

}

$loc_7 = 0;

while ($loc_7 < strlen($loc_6[0])){

$loc_10 = 0;

while ($loc_10 < count($loc_6)){

$loc_8 .= @$loc_6[$loc_10][$loc_7];

$loc_10++;

}

$loc_7++;

}

$loc_9 = str_replace('^', 0, urldecode($loc_8));

return $loc_9;

}