<?php
@$leggtilrute=$_GET["leggtilrute"];
@$leggtilflytype=$_GET["leggtilflytype"];
if($leggtilrute){
	include 'legg-til-rute.php';
}
if($leggtilflytype){
	include 'legg-til-flytype.php';
}
?>