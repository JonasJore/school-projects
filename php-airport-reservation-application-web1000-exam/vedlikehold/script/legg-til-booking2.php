<?php
$dbink = 'dbtilkobling.php';
$funksjonerink = 'funksjoner.php';
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
?>
<form method="post">
<?php
	echo"<div id='fraavgang'>";
	listfligths($avreisested,$ankomststed,"til", $fradato);
	echo "</div>";
	echo"<div id='tilavgang'>";
	if($turretur=="retur"){
		listfligths($ankomststed,$avreisested,"fra", $tildato);
	}
	echo "</div>";
	?><input type="submit" class="btn btn-primary" id="fortsett" name="kjopbilletter" value="Fortsett">
