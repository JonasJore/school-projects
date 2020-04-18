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
	$sql="select beskrivelse from rute where id=$id;";
	$svar=mysqli_query($db, $sql) or die("Feil");
	$antall=mysqli_num_rows($svar);
	if($antall == 1){
		$rad=mysqli_fetch_assoc($svar);
		$beskrivelse=$rad["beskrivelse"];
		if(strlen($beskrivelse)>0){
			echo $beskrivelse;
		}
		else{
			echo"Ingen beskrivelse angitt";
		}
	}
	else{
		echo"Ingen tilhørende beskrivelse";
	}
	
}

?>