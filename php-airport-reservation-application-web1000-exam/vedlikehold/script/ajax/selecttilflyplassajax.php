<?php
$dbink = '../../script/dbtilkobling.php';
$funksjonerink = '../../script/funksjoner.php';
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
@$fra=$_GET["fra"];
if($fra === ""){
	selecttilflyplass1();
}
else{
	selecttilflyplass1($fra);
}
?>