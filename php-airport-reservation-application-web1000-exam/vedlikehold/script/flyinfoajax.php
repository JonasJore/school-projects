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
@$id=$_GET["id"];
if($id && $id !==""){
	$sql="select flytype.kapasitet, flytype.modell, fly.flynummer, flyselskap.navn from fly join flyselskap on flyselskap.id=fly.flyselskap_id join flytype on flytype.id=fly.flytype_id where fly.id=$id;";
	$svar=mysqli_query($db, $sql) or die("Feil");
	$antall=mysqli_num_rows($svar);
	if($antall == 1){
		$rad=mysqli_fetch_assoc($svar);
		$navn=$rad["navn"];
		$modell=$rad["modell"];
		$kapasitet=$rad["kapasitet"];
		echo"Flyselskapeier: <b>$navn</b></br>Modell: <b>$modell</b></br>Kapasitet: <b>$kapasitet</b>";
	}
	else{
		echo"Ingen tilhørende informasjon.";
	}
	
}

?>