<?php
$title=$conf['cloudinfo'];
$users=$DB->count("SELECT count(*) from " . DBQZ . "_user WHERE 1");
$keys=$DB->count("SELECT count(*) from " . DBQZ . "_key WHERE 1");
?>