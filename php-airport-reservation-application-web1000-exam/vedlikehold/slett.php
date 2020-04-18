<?php
$dbink = 'script/dbtilkobling.php';
$funksjonerink = 'script/funksjoner.php';
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
@$return=$fra;
@$id=$_GET["id"];
if($fra==="rute" || $fra==="flight"){
	$return="flight";
}
if($fra==="flytype"){
	$return="fly";
}
if($fra && $id !=="")
{
	if($fra=="billett"){
		$sql="DELETE FROM `christensen2`.`$fra` WHERE `billettnummer`='$id';";
		mysqli_query($db,$sql) or die("Feil under sletting av billettnummer $id fra tabellen $fra.");
		echo sendmedjs("$return.php?slettet=1");

	}
	else{
		$sql="DELETE FROM `christensen2`.`$fra` WHERE `id`='$id';";
		mysqli_query($db,$sql) or die("Feil under sletting av id $id fra tabellen $fra.");
		echo sendmedjs("$return.php?slettet=1");
	}
	
}

?>