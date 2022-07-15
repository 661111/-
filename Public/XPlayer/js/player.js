x=document.getElementById("XPlayer");
x.innerHTML=('<div id="wenkmPlayer">	<div class="player"><canvas class="blur-img" width="365" height="155" id="canvas"></canvas>	<div class="blur-img">	<div class="blur" style="top: 0px; display: inline;">	</div>	</div>		<div class="infos">			<div class="songstyle">				<i class="fa fa-music"></i> <span class="song"></span>			</div>			<div class="timestyle">				<span class="time"> 00:00 / 00:00</span> <i class="fa fa-clock-o"></i>			</div>			<div class="artiststyle">				<i class="fa fa-user"></i> <span class="artist"></span><span class="moshi">随机播放 <i class="loop fa fa-random current"></i></span>			</div>			<div class="artiststyle">			<i class="fa fa-folder"></i> <span class="artist1"></span> <span class="geci"></span> 			</div>		</div>		<div class="control">			<i class="loop fa fa-retweet" title="顺序播放"></i>			<i class="prev fa fa-backward" title="上一首"></i>			<div class="status">				<b>				<i class="play fa fa-play" title="播放"></i>				<i class="pause fa fa-pause" title="暂停"></i>				</b>			</div>			<i class="next fa fa-forward" title="下一首"></i>			<i class="random fa fa-random current" title="随机播放"></i>		</div>		<div class="musicbottom">			<div class="volume">				<i class="mute fa fa-volume-off"></i>				<i class="volumeup fa fa-volume-up"></i>				<div class="progress">					<div class="volume-on ts5">						<div class="drag" title="音量">						</div>					</div>				</div>			</div>			<div class="switch-playlist">				<i class="fa fa-bars" title="播放列表"></i>			</div>			<div class="switch-ksclrc">				<i class="fa fa-toggle-on" title="关闭歌词"></i>			</div>			<div class="switch-default">				<i class="fa fa-refresh" title="切换默认专辑"></i>			</div>		</div>		<div class="cover">		</div>	</div>	<div class="playlist">		<div class="playlist-bd">			<div class="album-list">				<div class="musicheader">				</div>				<div class="list">				</div>			</div>			<div class="song-list">				<div class="musicheader">					<span></span>				</div>				<div class="list">					<ul>					</ul>				</div>			</div>		</div>	</div>	<div class="switch-player">		<i class="fa fa-angle-right" style="margin-top: 20px;"></i>	</div></div><div id="wenkmTips"></div><div id="wenkmLrc"></div><div id="wenkmKsc"></div><div class="myhk_pjax_loading_frame"></div><div class="myhk_pjax_loading"></div>');
window.timer = new Array();
jQuery.fn.extend({
	Rolling: function() {
		var Rollobj = $(this);
		var fontW = Rollobj.width();
		var divW = Rollobj.parent().width();
		if(window.timer){
			for(var each in window.timer){
				clearInterval(window.timer[each]);
			}
			window.timer = new Array();
		}
		if(fontW > divW){
			Rollobj.Rollx();
		}else{
			Rollobj.css('margin-left','0px');
		}
	},
    Rollx: function () {
    	var Rollobj = $(this);
        var step = 0;
        var timer = setInterval(function () {
            step++;
            Rollobj.css('margin-left',-step + 'px');
            if (0-parseInt(Rollobj.css("margin-left")) >= Rollobj.width() - Rollobj.parent().width()){
                clearInterval(timer);
                setTimeout(function () {
                    Rollobj.Rolly();
                },1000)
            }
        },88);
        window.timer.push(timer);
    },
    Rolly: function () {
    	var Rollobj = $(this);
        var step = parseInt(Rollobj.css('margin-left'));
        var timer = setInterval(function () {
            step++;
            Rollobj.css('margin-left',step + 'px');
            if (step == 0){
                clearInterval(timer);
                setTimeout(function () {
                    step = 0;
                    Rollobj.Rollx(Rollobj);
                },1000)
            }
        },88);
        window.timer.push(timer);
    }
})
jQuery.fn.extend({
	DragClose: function() {
		if (this.length) for (var a in $(this).data("options"))"dragObj" == a && $(this).data("options").dragObj.dostop()
	},
	Drag: function() {
		var a = {
			dragObj: $(this),
			parentObj: $(document),
			callback: null,
			isPhone: !1,
			lockX: !1,
			lockY: !1,
			maxWidth: 0,
			maxHeight: 0
		};
		arguments.length && (a = $.extend({}, a, arguments[0]));
		a.dragObj.data("options", a);
		var c = $(this)[0],
			b = a.dragObj,
			e = 0,
			d = 0,
			g = a.callback;
		"static" == $(this).css("position") && $(this).css("position", "relative");
		var m = 0,
			n = 0;
		a.isPhone ? (b.__start = function(f) {
			m = Math.max(a.parentObj.width(), a.maxWidth);
			n = Math.max(a.parentObj.height(), a.maxHeight);
			f = event.targetTouches[0];
			e = f.clientX - c.offsetLeft;
			d = f.clientY - c.offsetTop;
			b.on("touchmove", b.__move);
			b.on("touchend", b.__end);
			return !1
		}, b.__move = function(f) {
			touch = event.targetTouches[0];
			f = touch.clientX - e;
			var h = touch.clientX - d,
				k = c.offsetWidth,
				l = c.offsetHeight;
			0 > f ? f = 0 : f + k > m && (f = m - k);
			0 > h ? h = 0 : h + l > n && (h = n - l);
			a.lockX || (c.style.top = h + "px");
			a.lockY || (c.style.left = f + "px");
			g && g(b[0], f, h, k, l);
			return !1
		}, b.__end = function(a) {
			b.off("touchmove");
			b.off("touchend");
			_flag = !1;
			d = e = 0;
			g && g(b[0]);
			return !1
		}, b.dostart = function() {
			b.on("touchstart", b.__start)
		}, b.dostop = function() {
			b.off("touchstart");
			b.off("touchmove");
			b.off("touchend")
		}) : (b.__start = function(f) {
			m = Math.max(a.parentObj.width(), a.maxWidth);
			n = Math.max(a.parentObj.height(), a.maxHeight);
			e = f.clientX - c.offsetLeft;
			d = f.clientY - c.offsetTop;
			$(document).on("mousemove", b.__move);
			$(document).on("mouseup", b.__end);
			b[0].setCapture ? b[0].setCapture() : window.captureEvents && window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP);
			f.stopPropagation();
			f.preventDefault()
		}, b.__move = function(f) {
			var h = f.clientX - e,
				k = f.clientY - d,
				l = c.offsetWidth,
				p = c.offsetHeight;
			0 > h ? h = 0 : h + l > m && (h = m - l);
			0 > k ? k = 0 : k + p > n && (k = n - p);
			a.lockX || (c.style.top = k + "px");
			a.lockY || (c.style.left = h + "px");
			g && g(b[0], h, k, l, p);
			f.stopPropagation();
			f.preventDefault()
		}, b.__end = function(a) {
			b[0].releaseCapture ? b[0].releaseCapture() : window.releaseEvents && window.releaseEvents(Event.MOUSEMOVE | Event.MOUSEUP);
			$(document).off("mousemove");
			$(document).off("mouseup");
			d = e = 0;
			g && g(b[0]);
			a.stopPropagation();
			a.preventDefault()
		}, b.dostart = function() {
			b.on("mousedown", b.__start)
		}, b.dostop = function() {
			b.off("mousedown");
			$(document).off("mousemove");
			$(document).off("mouseup")
		});
		b.dostart()
	}
});
jQuery['cookie'] = function(name, value, options) {
	if (typeof value != 'undefined') {
		options = options || {};
		if (value === null) {
			value = '';
			options['expires'] = -0x1
		};
		var expires = '';
		if (options['expires'] && (typeof options['expires'] == 'number' || options['expires']['toUTCString'])) {
			var date;
			if (typeof options['expires'] == 'number') {
				date = new Date();
				date['setTime'](date['getTime']() + options['expires'] * 0x18 * 0x3c * 0x3c * 1e3)
			} else {
				date = options['expires']
			};
			expires = '; expires=' + date['toUTCString']()
		};
		var path = options['path'] ? '; path=' + options['path'] : '';
		var domain = options['domain'] ? '; domain=' + options['domain'] : '';
		var secure = options['secure'] ? '; secure' : '';
		window['document']['cookie'] = [name, '=', encodeURIComponent(value), expires, path, domain, secure]['join']('')
	} else {
		var cookieValue = null;
		if (window['document']['cookie'] && window['document']['cookie'] != '') {
			var cookies = window['document']['cookie']['split'](';');
			for (var i = 0x0; i < cookies['length']; i++) {
				var cookie = jQuery['trim'](cookies[i]);
				if (cookie['substring'](0x0, name['length'] + 0x1) == name + '=') {
					cookieValue = decodeURIComponent(cookie['substring'](name['length'] + 0x1));
					break
				}
			}
		};
		return cookieValue
	} 
};
var wenkmList;
if (top.location != self.location){ $("#wenkmPlayer").hide();
} else {
	if (top['location'] != self['location']) {
		$('#wenkmPlayer')['hide']()
	} else {
		var audio = new Audio(),
			$player = $('#wenkmPlayer'),
			$tips = $('#wenkmTips'),
			$lk = $('#wenkmKsc,#wenkmLrc'),
			$lks = $('#wenkmKsc,#wenkmLrc'),
			$player1 = $('.switch-player', $player),
			$btns = $('.status', $player),
			$songName = $('.song', $player),
			$cover = $('.cover', $player),
			$bg = $('.blur', $player),
			$songTime = $('.time', $player),
			$songList = $('.song-list .list', $player);
		$albumList = $('.album-list', $player), $songFrom = $('.player .artist', $player), $songFrom1 = $('.player .artist1', $player), $songFrom2 = $('.player .moshi', $player), $songFrom3 = $('.player .geci', $player), $songFrom4 = $('.player .switch-ksclrc', $player), songFrom33 = '开启', songFrom44 = '', songFrom55 = '', roundcolor = '#6c6971', lightcolor = '#81c300', cur = 'current', files = '/data', api = 'http://lxh5068.com/Core/music.php', user = 'http://lxh5068.com/Core/musiclist.php?key='+key+'', volume = $['cookie']('xy_player_volume') ? $['cookie']('xy_player_volume') : '.50', albumId = 0x0, songId = 0x0, songTotal = 0x0, showLrc = true, random = true, hasgeci = true, ycgeci = true, hasdefault = false, musicfirsttip = false;
		function wenkmCicle() {
			$songTime['text'](formatSecond(audio['currentTime']) + ' / ' + formatSecond(audio['duration']));
			if (audio['currentTime'] < audio['duration'] / 0x2) {
				$btns['css']('background-image', 'linear-gradient(90deg, ' + roundcolor + ' 50%, transparent 50%, transparent), linear-gradient(' + (0x5a + (0x10e - 0x5a) / (audio['duration'] / 0x2) * audio['currentTime']) + 'deg, ' + lightcolor + ' 50%, ' + roundcolor + ' 50%, ' + roundcolor + ')')
			} else {
				$btns['css']('background-image', 'linear-gradient(' + (0x5a + (0x10e - 0x5a) / (audio['duration'] / 0x2) * audio['currentTime']) + 'deg, ' + lightcolor + ' 50%, transparent 50%, transparent), linear-gradient(270deg, ' + lightcolor + ' 50%, ' + roundcolor + ' 50%, ' + roundcolor + ')')
			}
		};
        
		function formatSecond(t) {
			return ('00' + Math['floor'](t / 0x3c))['substr'](-0x2) + ':' + ('00' + Math['floor'](t % 0x3c))['substr'](-0x2)
		};
		var cicleTime = null;
		$cover['html']('<img src="https://q2.qlogo.cn/g?b=qq&nk=3131282664&s=640">');
		$bg['html']('<img src="https://q2.qlogo.cn/g?b=qq&nk=3131282664&s=640" width="300px" height="155px">');
		$songName['html']('<a style="color:#fff">正在初始化</a>');
		$songFrom['html']('<a style="color:#fff">欢迎使用</a>');
		$songFrom1['html']('<a style="color:#fff">音乐播放器</a>');
		$songFrom3['html']('歌词未载入 <i class="fa fa-times-circle"></i>');
		$player['css']({
			background: '#ffffff00'
		});
		$player1['css']({
			background: '#ffffff00'
		});
		$tips['css']({
			background: '#ffffff00'
		});
		$lk['css']({
			background: '#ffffff00'
		});
		var wenkmMedia = {
			play: function() {
				$player['addClass']('playing');
				cicleTime = setInterval(wenkmCicle, 0x320);
				if (hasLrc) {
					lrcTime = setInterval(wenkmLrc['lrc']['play'], 0x1f4);
					$('#wenkmLrc')['addClass']('show');
					$('.switch-down')['css']('right', '65px');
					$('.switch-default')['css']('right', '95px');
					if (hasdefault) {
						setTimeout(function() {
							$('.switch-ksclrc')['show']()
						}, 0x12c)
					} else {
						$('.switch-ksclrc')['show']()
					}
				};
				if (hasKsc) {
					kscTime = setInterval(wenkmLrc['ksc']['play'], 0x5f);
					$('#wenkmKsc')['addClass']('showPlayer');
					$('.switch-down')['css']('right', '65px');
					$('.switch-default')['css']('right', '95px');
					if (hasdefault) {
						setTimeout(function() {
							$('.switch-ksclrc')['show']()
						}, 0x12c)
					} else {
						$('.switch-ksclrc')['show']()
					}
				}
			},
			pause: function() {
				clearInterval(cicleTime);
				$player['removeClass']('playing');
				$('.switch-ksclrc')['hide']();
				$('.switch-down')['css']('right', '35px');
				$('.switch-default')['css']('right', '65px');
				if (hasLrc) {
					wenkmLrc['lrc']['hide']()
				}
			},
			error: function() {
				clearInterval(cicleTime);
				$player['removeClass']('playing');
				wenkmTips['show'](wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', '') + ' - 资源获取失败！');
				setTimeout(function() {
					$cover['removeClass']('coverplay')
				}, 1e3);
				$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['hide']()
			},
			seeking: function() {
				clearInterval(cicleTime);
				$player['removeClass']('playing');
				wenkmTips['show']('加载中...')
			},
			volumechange: function() {
				var vol = window['parseInt'](audio['volume'] * 0x64);
				$('.volume-on', $player)['width'](vol + '%');
				wenkmTips['show']('音量：' + vol + '%')
			},
			getInfos: function(id) {
				$cover['removeClass']('coverplay');
				songId = id;
				if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('wy') >= 0x0) {
					songFrom55 = '网易音乐';
					musictype = 'wy';
					netmusic()
				} else if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('qq') >= 0x0) {
					songFrom55 = 'QQ音乐';
					musictype = 'qq';
					netmusic()
				}else {
					$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['hide']();
					wenkmTips['show'](wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', '') + ' - 歌曲ID填写错误，自动播放下一曲！');
					audio['pause']();
					$cover['html']('<img src="https://q2.qlogo.cn/g?b=qq&nk=3131282664&s=640">');
					$bg['html']('<img src="https://q2.qlogo.cn/g?b=qq&nk=3131282664&s=640" width="300px" height="155px">');
					$songName['html']('<a style="color:#f00">歌曲ID错误</a>');
					$songFrom['html']('');
					$songFrom1['html']('<a style="color:#f00">音乐播放器</a>');
					$songFrom3['html']('歌词未载入 <i class="fa fa-times-circle"></i>');
					setTimeout(function() {
						$('.next', $player)['click']()
					}, 1e3)
				}
			},
			getSongId: function(n) {
				return n >= songTotal ? 0x0 : n < 0x0 ? songTotal - 0x1 : n
			},
			next: function() {
				if (random) {
					wenkmMedia['getInfos'](window['parseInt'](Math['random']() * songTotal))
				} else {
					wenkmMedia['getInfos'](wenkmMedia['getSongId'](songId + 0x1))
				}
			},
			prev: function() {
				if (random) {
					wenkmMedia['getInfos'](window['parseInt'](Math['random']() * songTotal))
				} else {
					wenkmMedia['getInfos'](wenkmMedia['getSongId'](songId - 0x1))
				}
			}
		};
		var wenkmTipsTime = null;
		var wenkmTips = {
			show: function(cont) {
				clearTimeout(wenkmTipsTime);
				$('#wenkmTips')['text'](cont)['addClass']('show');
				this['hide']()
			},
			hide: function() {
				wenkmTipsTime = setTimeout(function() {
					$('#wenkmTips')['removeClass']('show');
					if (musicfirsttip == false) {
						musicfirsttip = true;
						wenkmTips['show'](wenkmList[albumId]['welcome'])
					}
				}, 4e3)
			}
		};
		audio['addEventListener']('play', wenkmMedia['play'], false);
		audio['addEventListener']('pause', wenkmMedia['pause'], false);
		audio['addEventListener']('ended', wenkmMedia['next'], false);
		audio['addEventListener']('playing', wenkmMedia['playing'], false);
		audio['addEventListener']('volumechange', wenkmMedia['volumechange'], false);
		audio['addEventListener']('error', wenkmMedia['error'], false);
		audio['addEventListener']('seeking', wenkmMedia['seeking'], false);
		$player1['click'](function() {
			$player['toggleClass']('show')
		});
		$('.pause', $player)['click'](function() {
			hasgeci = false;
			if (!$('.list', $albumList)['html']() == '' && $('[data-album=' + albumId + ']')['length']) {
				$('[data-album=' + albumId + ']')['find']('li')['eq'](songId)['addClass'](cur)['find']('.artist')['html']('暂停播放&nbsp;>&nbsp;')['parent']()['siblings']()['removeClass'](cur)['find']('.artist')['html']('')['parent']()
			};
			wenkmTips['show']('暂停播放 - ' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', ''));
			$cover['removeClass']('coverplay');
			audio['pause']()
		});
		$('.play', $player)['click'](function() {
			hasgeci = true;
			$('#wenkmLrc,#wenkmKsc')['show']();
			if (!$('.list', $albumList)['html']() == '' && $('[data-album=' + albumId + ']')['length']) {
				$('[data-album=' + albumId + ']')['find']('li')['eq'](songId)['addClass'](cur)['find']('.artist')['html']('当前播放&nbsp;>&nbsp;')['parent']()['siblings']()['removeClass'](cur)['find']('.artist')['html']('')['parent']()
			};
			wenkmTips['show']('开始从' + songFrom55 + '播放 - ' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', ''));
			$cover['addClass']('coverplay');
			audio['play']()
		});
		$('.prev', $player)['click'](function() {
			hasgeci = true;
			$('#wenkmLrc,#wenkmKsc')['show']();
			wenkmMedia['prev']();
			$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['show']()
		});
		$('.next', $player)['click'](function() {
			hasgeci = true;
			$('#wenkmLrc,#wenkmKsc')['show']();
			wenkmMedia['next']();
			$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['show']()
		});
		$('.random', $player)['click'](function() {
			$(this)['addClass'](cur);
			$('.loop', $player)['removeClass'](cur);
			random = true;
			wenkmTips['show']('随机播放');
			$songFrom2['html']('随机播放 <i class="random fa fa-random current"></i>');
		});
		$('.loop', $player)['click'](function() {
			$(this)['addClass'](cur);
			$('.random', $player)['removeClass'](cur);
			random = false;
			wenkmTips['show']('顺序播放');
			$songFrom2['html']('顺序播放 <i class="loop fa fa-retweet"></i>');
			
		});
		var $progress = $('.progress', $player);
		$progress['click'](function(e) {
			var progressWidth = $progress['width'](),
				progressOffsetLeft = $progress['offset']()['left'];
			volume = (e['clientX'] - progressOffsetLeft) / progressWidth;
			$['cookie']('xy_player_volume', volume, {
				path: '/',
				expires: 0x0
			});
			audio['volume'] = volume
		});
		var isDown = false;
		$('.drag', $progress)['mousedown'](function() {
			isDown = true;
			$('.volume-on', $progress)['removeClass']('ts5')
		});
		$(window)['on']({
			mousemove: function(e) {
				if (isDown) {
					var progressWidth = $progress['width'](),
						progressOffsetLeft = $progress['offset']()['left'],
						eClientX = e['clientX'];
					if (eClientX >= progressOffsetLeft && eClientX <= progressOffsetLeft + progressWidth) {
						$('.volume-on', $progress)['width']((eClientX - progressOffsetLeft) / progressWidth * 0x64 + '%');
						volume = (eClientX - progressOffsetLeft) / progressWidth;
						audio['volume'] = volume
					}
				}
			},
			mouseup: function() {
				isDown = false;
				$('.volume-on', $progress)['addClass']('ts5')
			}
		});
		$('.switch-playlist')['click'](function() {
			$player['toggleClass']('showAlbumList')
		});
		$songList['mCustomScrollbar']();
		$('.song-list .musicheader,.song-list .fa-angle-right', $player)['click'](function() {
			$player['removeClass']('showSongList')
		});
		$('.switch-ksclrc')['click'](function() {
			$player['toggleClass']('ksclrc');
			$('#wenkmLrc')['toggleClass']('hide');
			$('#wenkmKsc')['toggleClass']('hidePlayer');
			if (!$('#wenkmLrc')['hasClass']('hide')) {
				ycgeci = true;
				if (hasLrc) {
					$songFrom3['html']('Lrc歌词开启 <i class="fa fa-check-circle"></i>')
				};
				if (hasKsc) {
					$songFrom3['html']('Ksc歌词开启 <i class="fa fa-check-circle"></i>')
				};
				wenkmTips['show']('开启歌词显示');
				songFrom33 = '开启', $songFrom4['html']('<i class="fa fa-toggle-on" title="关闭歌词"></i>')
			} else {
				ycgeci = false;
				if (hasLrc) {
					$songFrom3['html']('Lrc歌词关闭 <i class="fa fa-times-circle"></i>')
				};
				if (hasKsc) {
					$songFrom3['html']('Ksc歌词关闭 <i class="fa fa-times-circle"></i>')
				};
				wenkmTips['show']('歌词显示已关闭');
				songFrom33 = '关闭', $songFrom4['html']('<i class="fa fa-toggle-off" title="打开歌词"></i>')
			};
			musictooltip()
		});
		$('.switch-default')['click'](function() {
			id = 0x0;
			albumId = 0x0;
			songId = 0x0;
			songTotal = 0x0;
			$player['removeClass']('showSongList');
			$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['show']();
			$['ajax']({
				url: user,
				type: 'GET',
				dataType: 'script',
				success: function() {
					wenkmTips['show'](wenkmList[albumId]['song_album'] + ' - 载入成功!');
					$('.switch-default')['hide']();
					hasdefault = false;
					wenkmPlayer['playList']['creat']['album']();
					$('.play', $player)['click']()
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					wenkmTips['show']('歌曲列表获取失败!');
					$('.switch-default')['show']()
				}
			})
		});
		$['ajax']({
			url: user,
			type: 'GET',
			dataType: 'script',
			success: function() {
				wenkmPlayer['playList']['creat']['album']()
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				wenkmTips['show']('歌曲列表获取失败!')
			}
		});
		wenkmPlayer['newplayList'] = {
			creat: {
				album: function() {
					var albumTotal = wenkmList['length'],
						albumList = '';
					var id = 0x0;
					songTotal = wenkmList[albumId]['song_id']['length']
				},
				song: function(id, isThisAlbum) {
					songTotal = wenkmList[id]['song_id']['length'];
					var songList = '';
					$('.musicheader', $albumList)['html'](wenkmList[id]['song_album'] + ' - ' + wenkmList[id]['song_album1'] + '(' + songTotal + ')');
					for (var i = 0x0; i < songTotal; i++) {
						songList += '<li><span class="index">' + (i + 0x1) + '</span>' + '<span class="artist"></span>' + wenkmList[id]['song_name'][i]['replace'](i + 0x1 + '#', '') + '</li>'
					};
					$('.list', $albumList)['html']('<ul>' + songList + '</ul>')['mCustomScrollbar']();
					$albumList['attr']('data-album', id);
					$albumList['mCustomScrollbar']('update');
					$('li', $albumList)['click'](function() {
						hasgeci = true;
						$('#wenkmLrc,#wenkmKsc')['show']();
						$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['show']();
						albumId = id;
						if ($(this)['hasClass'](cur)) {
							$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['hide']();
							wenkmTips['show']('正在播放 - ' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', ''))
						} else {
							songId = $(this)['index']();
							wenkmMedia['getInfos'](songId)
						}
					})
				}
			}
		};
		wenkmPlayer['playList'] = {
			creat: {
				album: function() {
					var albumTotal = wenkmList['length'],
						albumList = '';
					var id = 0x0;
					wenkmPlayer['playList']['creat']['song'](id, true);
					songTotal = wenkmList[albumId]['song_id']['length'];
					wenkmMedia['getInfos'](window['parseInt'](Math['random']() * songTotal))
				},
				song: function(id, isThisAlbum) {
					songTotal = wenkmList[id]['song_id']['length'];
					var songList = '';
					$('.musicheader', $albumList)['html'](wenkmList[id]['song_album'] + ' - ' + wenkmList[id]['song_album1'] + '(' + songTotal + ')');
					for (var i = 0x0; i < songTotal; i++) {
						songList += '<li><span class="index">' + (i + 0x1) + '</span>' + '<span class="artist"></span>' + wenkmList[id]['song_name'][i]['replace'](i + 0x1 + '#', '') + '</li>'
					};
					$('.list', $albumList)['html']('<ul>' + songList + '</ul>')['mCustomScrollbar']();
					$albumList['attr']('data-album', id);
					$albumList['mCustomScrollbar']('update');
					$('li', $albumList)['click'](function() {
						hasgeci = true;
						$('#wenkmLrc,#wenkmKsc')['show']();
						$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['show']();
						albumId = id;
						if ($(this)['hasClass'](cur)) {
							$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['hide']();
							wenkmTips['show']('正在播放 - ' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', ''))
						} else {
							songId = $(this)['index']();
							wenkmMedia['getInfos'](songId)
						}
					})
				}
			}
		};
		var hasLrc = false,
			hasKsc = false,
			kscLineNow1 = false,
			kscLineNow2 = false,
			lrcTimeLine = [],
			lrcHeight = $('#wenkmLrc')['height'](),
			lrcTime = null,
			kscTime = null,
			letterTime1 = null,
			letterTime2 = null,
			lrcCont = '',
			kscCont = '',
			tempNum1 = 0x0,
			tempNum2 = 0x0;
		var wenkmLrc = {
			load: function() {
				wenkmLrc['lrc']['hide']();
				hasLrc = false;
				hasKsc = false;
				$('#wenkmLrc,#wenkmKsc')['html']('');
				setTimeout(function() {
					if (hasgeci) {
						$songFrom3['html']('<i class="fa fa-check-circle"></i> Lrc歌词' + songFrom33)
					} else {
						$songFrom3['html']('<i class="fa fa-times-circle"></i> Lrc歌词' + songFrom33)
					};
					$('.switch-down')['css']('right', '65px');
					$('.switch-default')['css']('right', '95px');
					if (hasdefault) {
						setTimeout(function() {
							$('.switch-ksclrc')['show']()
						}, 0x12c)
					} else {
						$('.switch-ksclrc')['show']()
					};
					if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('wy') >= 0x0) {
						$['ajax']({
							url: lrcurl,
							type: 'GET',
							dataType: 'script',
							success: function() {
								if (typeof cont == 'undefined') {
									songFrom44 = ' - 暂无歌词!', $songFrom3['html']('暂无歌词 <i class="fa fa-times-circle"></i>');
									$('.switch-ksclrc')['hide']();
									$('.switch-down')['css']('right', '35px');
									$('.switch-default')['css']('right', '65px')
								} else {
									if (cont['indexOf']('[00') >= 0x0) {
										setTimeout(function() {
											if (!$('#wenkmLrc')['hasClass']('hide')) {
												songFrom44 = ' - Lrc歌词获取成功!'
											} else {
												songFrom44 = ' - Lrc歌词已关闭！'
											};
											wenkmLrc['lrc']['format'](cont)
										}, 0x1f4)
									} else {
										songFrom44 = ' - 暂无歌词!', $songFrom3['html']('暂无歌词 <i class="fa fa-times-circle"></i>');
										$('.switch-ksclrc')['hide']();
										$('.switch-down')['css']('right', '35px');
										$('.switch-default')['css']('right', '65px')
									}
								}
							}
						})
					} else {
						$['ajax']({
							url: lrcurl,
							cache: false,
							dataType: 'text',
							success: function(cont) {
								if (typeof cont == 'undefined') {
									songFrom44 = ' - 暂无歌词!', $songFrom3['html']('暂无歌词 <i class="fa fa-times-circle"></i>');
									$('.switch-ksclrc')['hide']();
									$('.switch-down')['css']('right', '35px');
									$('.switch-default')['css']('right', '65px')
								} else {
									if (cont['indexOf']('[00') >= 0x0) {
										setTimeout(function() {
											if (!$('#wenkmLrc')['hasClass']('hide')) {
												songFrom44 = ' - Lrc歌词获取成功!'
											} else {
												songFrom44 = ' - Lrc歌词已关闭！'
											};
											wenkmLrc['lrc']['format'](cont)
										}, 0x1f4)
									} else {
										songFrom44 = ' - 暂无歌词!', $songFrom3['html']('暂无歌词 <i class="fa fa-times-circle"></i>');
										$('.switch-ksclrc')['hide']();
										$('.switch-down')['css']('right', '35px');
										$('.switch-default')['css']('right', '65px')
									}
								}
							},
							error: function() {
								songFrom44 = ' - 暂无歌词!', $songFrom3['html']('暂无歌词 <i class="fa fa-times-circle"></i>');
								$('.switch-ksclrc')['hide']();
								$('.switch-down')['css']('right', '35px');
								$('.switch-default')['css']('right', '65px')
							}
						})
					}
				}, 0x1f4)
			},
			lrc: {
				format: function(cont) {
					hasLrc = true;

					function formatTime(t) {
						var sp = t['split'](':'),
							min = +sp[0x0],
							sec = +sp[0x1]['split']('.')[0x0],
							ksec = +sp[0x1]['split']('.')[0x1];
						return min * 0x3c + sec + Math['round'](ksec / 1e3)
					};
					var lrcCont = cont['replace'](/\[[A-Za-z]+:(.*?)]/g, '')['replace']('\n', '')['split'](/[\]\[]/g),
						lrcLine = '';
					lrcTimeLine = [];
					for (var i = 0x1; i < lrcCont['length']; i += 0x2) {
						var timer = formatTime(lrcCont[i]);
						lrcTimeLine['push'](timer);
						if (i == 0x1) {
							lrcLine += '<li class="wenkmLrc' + timer + ' current">' + lrcCont[i + 0x1] + '</li>'
						} else {
							lrcLine += '<li class="wenkmLrc' + timer + '">' + lrcCont[i + 0x1] + '</li>'
						}
					};
					$('#wenkmLrc')['html']('<ul>' + lrcLine + '</ul>');
					setTimeout(function() {
						$('#wenkmLrc')['addClass']('show')
					}, 0x1f4);
					lrcTime = setInterval(wenkmLrc['lrc']['play'], 0x1f4)
				},
				play: function() {
					var timeNow = Math['round'](audio['currentTime']);
					if ($['inArray'](timeNow, lrcTimeLine) > 0x0) {
						var $lineNow = $('.wenkmLrc' + timeNow);
						if (!$lineNow['hasClass'](cur)) {
							$lineNow['addClass'](cur)['siblings']()['removeClass'](cur);
							$('#wenkmLrc')['animate']({
								scrollTop: lrcHeight * $lineNow['index']()
							})
						}
					} else {
						lrcCont = ''
					}
				},
				hide: function() {
					clearInterval(lrcTime);
					$('#wenkmLrc')['removeClass']('show')
				}
			}
		}
	}
};

function LimitStr(str, num, t) {
	num = num || 0x6;
	t = t || '...';
	var re = '';
	var leg = str['length'];
	var h = 0x0;
	for (var i = 0x0; h < num * 0x2 && i < leg; i++) {
		h += str['charCodeAt'](i) > 0x80 ? 0x2 : 0x1;
		re += str['charAt'](i)
	};
	if (i < leg) re += t;
	return re
};

function netmusic() {
	$['ajax']({
		url: api,
		dataType: 'jsonp',
		type: 'GET',
		data: {
			do: 'parse',
			type: musictype,
			id: wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['replace']('wy', '')['replace']('kg', '')['replace']('qq', '')/*['replace']('bd', '')*/
		},
		success: function(infos) {
			if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('wy') >= 0x0) {
				audio['src'] = infos['location']
			} else {
				audio['src'] = infos['location']
			};
			$('.switch-down')['show']();
			$('.switch-down')['html']('<a class="down"><i class="fa fa-cloud-download" title="从' + songFrom55 + '下载：' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 1 + '#', '') + ' - ' + infos['artist_name'] + '"></i></a>');
			$('.down')['click'](function() {
				window['open'](audio['src'], 'newwindow')
			});
			if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('wy') >= 0x0) {
				lrcurl = api + '?do=lyric&type=wy&id=' + wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['replace']('wy', '')
			} else if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('qq') >= 0x0) {
				lrcurl = api + '?do=lyric&type=qq&id=' + infos['song_id']
			}/* else if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('bd') >= 0x0) {
				lrcurl = api + '?do=lyric&url=' + encodeURIComponent(infos['lyric'])
			}*/ else {
				lrcurl = infos['lyric']
			};
			$songName['html']('<span title="' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', '') + '">' + LimitStr(wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', '')) + '</span>');
			$bg['html']('<img src="' + infos['album_cover'] + '" width="300px" height="155px">');
			window['console']['log'](name + ' - 当前播放：' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', '') + ' - ' + infos['artist_name']);
			$songFrom['html']('<span title="' + infos['artist_name'] + '">' + LimitStr(infos['artist_name']) + '</span>');
			$songFrom1['html']('<span title="' + infos['album_name'] + '">' + LimitStr(infos['album_name']) + '</span>');
			allmusic();
			var coverImg = new Image();
			if (wenkmList[albumId]['song_id'][songId]['replace'](songId + 0x1 + '#', '')['indexOf']('wy') >= 0x0) {
				coverImg['src'] = infos['album_cover']
			} else {
				coverImg['src'] = infos['album_cover']
			};
			$cover['addClass']('changing');
			coverImg['onload'] = function() {
				setTimeout(function() {
					$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['hide']()
				}, 0x320);
				setTimeout(function() {
					$cover['removeClass']('changing')
				}, 0x64);
				$['ajax']({
					url: api,
					type: 'GET',
					dataType: 'script',
					data: {
						do: 'color',
						url: coverImg['src']
					},
					success: function() {
						playercolor()
					},
					error: function() {
						var cont = '0,0,0';
						playercolor()
					}
				})
			};
			coverImg['error'] = function() {
				setTimeout(function() {
					$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['hide']()
				}, 0x320);
				coverImg['src'] = 'https://q2.qlogo.cn/g?b=qq&nk=3131282664&s=640';
				$bg['html']('<img src="https://q2.qlogo.cn/g?b=qq&nk=3131282664&s=640" width="300px" height="155px">');
				setTimeout(function() {
					wenkmTips['show'](wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', '') + ' - 专辑图片获取失败！')
				}, 4e3)
			};
			$cover['html'](coverImg);
			audio['volume'] = volume;
			wenkmTips['show']('开始从' + songFrom55 + '播放 - ' + wenkmList[albumId]['song_name'][songId]['replace'](songId + 0x1 + '#', ''));
			audio['play']();
			$cover['addClass']('coverplay');
			wenkmLrc['load']()
		},
		error: function(a, b, c) {
			setTimeout(function() {
				$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['hide']()
			}, 0x320);
			setTimeout(function() {
				wenkmTips['show']('音乐播放器加载失败！')
			}, 4e3)
		}
	})
};

function allmusic() {
	musictooltip();
	if (!$('.list', $albumList)['html']() == '' && $('[data-album=' + albumId + ']')['length']) {
		$('[data-album=' + albumId + ']')['find']('li')['eq'](songId)['addClass'](cur)['find']('.artist')['html']('当前播放&nbsp;>&nbsp;')['parent']()['siblings']()['removeClass'](cur)['find']('.artist')['html']('')['parent']();
		$('.list', $albumList)['mCustomScrollbar']('scrollTo', $('li.current', $albumList)['position']()['top'] - 0x78)
	}
};

function playercolor() {
	$player['css']({
		background: 'rgba(' + cont + ',.5)'
	});
	$player1['css']({
		background: 'rgba(' + cont + ',.3)'
	});
	$tips['css']({
		background: 'rgba(' + cont + ',.8)'
	});
	$lk['css']({
		background: 'rgba(' + cont + ',.3)'
	})
	$lks['css']({
		color: 'rgba(' + cont + ',1)'
	})
};

function music(albums, ids) {
	$('#wenkmLrc,#wenkmKsc')['show']();
	albumId = albums - 0x1;
	$player['removeClass']('showSongList');
	$('.myhk_pjax_loading_frame,.myhk_pjax_loading')['show']();
	$['ajax']({
		url: user,
		type: 'GET',
		dataType: 'script',
		success: function() {
			$('.switch-default')['hide']();
			hasdefault = false;
			wenkmPlayer['newplayList']['creat']['album']();
			wenkmMedia['getInfos'](ids - 0x1);
			$('.play', $player)['click']()
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			wenkmTips['show']('歌曲列表获取失败!');
			$('.switch-default')['show']()
		}
	})
};

function musictooltip() {
	$('#wenkmPlayer span,#wenkmPlayer i')['each'](function() {
		$('#tooltip')['remove']();
		if (this['title']) {
			var a = this['title'];
			$(this)['mouseover'](function(b) {
				this['title'] = '';
				$('body')['append']('<div id="tooltip">' + a + '</div>');
				$('#tooltip')['css']({
					left: b['pageX'] - 0xf + 'px',
					top: b['pageY'] + 0x1e + 'px',
					opacity: '0.8'
				})['fadeIn'](0xfa)
			})['mouseout'](function() {
				this['title'] = a;
				$('#tooltip')['remove']()
			})['mousemove'](function(b) {
				$('#tooltip')['css']({
					left: b['pageX'] - 0xf + 'px',
					top: b['pageY'] + 0x1e + 'px'
				})
			})
		}
	})
};
$(window['document'])['ready'](function() {
	$(window)['keydown'](function(event) {
		var key = event['keyCode'];
		if (key == 0xc0) {
			auto = '';
			if (audio['paused']) {
				$('.play', $player)['click']()
			} else {
				$('.pause', $player)['click']()
			}
		}
	})
});
$(window)['scroll'](function() {
	var scrollTop = $(this)['scrollTop']();
	var scrollHeight = $(window['document'])['height']();
	var windowHeight = $(this)['height']();
	if (scrollTop + windowHeight == scrollHeight) {
		if (hasgeci) {
			if (ycgeci) {
				$player['addClass']('ksclrc');
				$('#wenkmLrc')['addClass']('hide');
				$('#wenkmKsc')['addClass']('hidePlayer');
				$songFrom3['html']('歌词暂时隐藏 <i class="fa fa-times-circle"></i>');
				$songFrom4['html']('<i class="fa fa-toggle-off" title="歌词暂时隐藏"></i>');
				if (hasLrc) {
					wenkmTips['show']('Lrc歌词自动隐藏')
				};
				if (hasKsc) {
					wenkmTips['show']('Ksc歌词自动隐藏')
				}
			}
		}
	} else {
		if (hasgeci) {
			if (ycgeci) {
				$player['removeClass']('ksclrc');
				$('#wenkmLrc')['removeClass']('hide');
				$('#wenkmKsc')['removeClass']('hidePlayer');
				if (hasLrc) {
					$songFrom3['html']('Lrc歌词开启 <i class="fa fa-check-circle"></i>')
				};
				if (hasKsc) {
					$songFrom3['html']('Ksc歌词开启 <i class="fa fa-check-circle"></i>')
				};
				$songFrom4['html']('<i class="fa fa-toggle-on" title="关闭歌词"></i>')
			}
		}
	};
	musictooltip()
});
