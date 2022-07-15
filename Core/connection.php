<?php
require 'Config/config.php'; //连接数据库
if (isset($db_qz)) define('DBQZ', $db_qz);
else define('DBQZ', 'cloud');
if (!isset($port)) $port = '3306';
include_once ("Config/db.class.php");
if (defined('SQLITE')) $DB = new DB($db_file);
else $DB = new DB($host, $user, $pwd, $dbname, $port);
include_once ("Other/cache.class.php");
?>