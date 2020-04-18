<?php
@$avreisested=$_POST["avreisested"];
if($avreisested)
{
	echo"dette gikk";
	include("script/dbtilkobling.php");
	$sql="select distinct til.id, til.navn, til.by, til.land, til.forkortelse from flight f join rute r on r.id=f.rute_id join flyplass til on til.id=r.ankomst_fp where avgang_fp='$avreisested';";
	$res=mysqli_query($db, $sql) or die("feil");
	$antall=mysqli_num_rows($res);
	for($r=1;$r<=$antall;$r++)
	{
	  $rad=mysqli_fetch_array($res);
	  $id=$rad["id"];
	  $navn=$rad["navn"];
	  $forkortelse=$rad["forkortelse"];
	  $land=$rad["land"];
	  print("<option value='$id'>$navn ($forkortelse)</option>");
	}
	$where="where r.avgang_fp=$id";
}
else{
	echo "<option> Velg avreise først</option>";
}
?>
