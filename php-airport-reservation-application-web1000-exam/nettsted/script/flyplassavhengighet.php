<?php
$dbink = '../../vedlikehold/script/dbtilkobling.php';
$funksjonerink = '../../vedlikehold/script/funksjoner.php';
$dbinkfinnes=false;
$funksjonerinkfinnes=false;
$ink = get_included_files();
foreach ($ink as $fil) {
    if($dag=strpos($fil, $dbink) !== false){
		$dbinkfinnes=true;
	}
	if($dag=strpos($fil, $funksjonerink) !== false){
		$funksjonerinkfinnes=true;
	}
}
if($dbinkfinnes===false)
{
	include $dbink;
}
if($funksjonerinkfinnes===false)
{
	include $funksjonerink;
}
@$til=$_GET["til"];
@$fra=$_GET["fra"];
if($til){
	if($fra==="avgang"){
		selectdeptilflyplass(null, $til);
	}
	if($fra==="ankomst"){
		selectdepfraflyplass(null, $til);
	}
}



?>