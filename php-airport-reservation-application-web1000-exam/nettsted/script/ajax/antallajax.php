<?php
$dbink = '../../../vedlikehold/script/dbtilkobling.php';
$funksjonerink = '../../../vedlikehold/script/funksjoner.php';
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
$antall=$_GET["antall"];
if($antall>9){
	echo tilbakemelding("For store bestillinger kontakt oss pr. telefon/epost.","danger");
}
?>