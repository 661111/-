CREATE TABLE IF NOT EXISTS `cloud_config` (
  `k` varchar(32) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `cloud_config` (`k`, `v`) VALUES
('name', 'html播放器'),
('cloudinfo', '一行代码快速接入您的网站'),
('description', 'html播放器是一款简约的HTML悬浮音乐播放器'), 
('keywords', 'wordpress音乐插件,emlog音乐插件,typecho音乐插件,z-blog音乐插件,HTML5音乐播放器'),
('web_zt', '1'),
('CAPTCHA_ID', 'fd772a9a5dbd10d2b164870729abbd2d'), 
('PRIVATE_KEY', 'f4c61df26a8552cc51697bd53d352b4b'),
('gonggao', ''),
('help', '');

CREATE TABLE IF NOT EXISTS `cloud_key` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `key` varchar(50) DEFAULT NULL,
  `web_name` varchar(50) DEFAULT NULL,
  `web_welcome` varchar(50) DEFAULT '',
  `web_musicfirsttip` varchar(10) DEFAULT 'false',
  `web_volume` varchar(3) DEFAULT '50',
  `song_album` varchar(50) DEFAULT '',
  `song_album_1` varchar(50) DEFAULT '',
  `song_name` varchar(255) DEFAULT '',
  `song_id` varchar(255) DEFAULT '',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `cloud_chat` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `con` varchar(10000) DEFAULT '',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `cloud_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `qq` varchar(50) DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `amount` int(11) DEFAULT '5',
  `cookie` varchar(255) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
INSERT INTO `cloud_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '24677102', '24677102@qq.com', '5', '', '127.0.0.1', '2019-01-24 00:00:00');