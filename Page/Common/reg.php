<?php
if (!iflogin(DBQZ,$userrow['cookie'])) {
}else{
header("Location: ?do=home"); 
}
?>