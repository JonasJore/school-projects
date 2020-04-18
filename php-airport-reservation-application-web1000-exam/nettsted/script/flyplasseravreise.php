<?php
include("dbtilkobling.php");
$sql="select distinct fra.id, fra.navn, fra.`by`, fra.land, fra.forkortelse from flight f join rute r on r.id=f.rute_id join flyplass fra on fra.id=r.avgang_fp;";
$res=mysqli_query($db, $sql) or die("kunne ikke koble til db (flyplasser.php error 1)");
$rader=mysqli_num_rows($res);

for($r=1;$r<=$rader;$r++)
{
  $rad=mysqli_fetch_array($res);
  $id=$rad["id"];
  $navn=$rad["navn"];
  $forkortelse=$rad["forkortelse"];
  $land=$rad["land"];
  print("<option value='$id'>$navn $forkortelse $by $land</option>");
}

?>
