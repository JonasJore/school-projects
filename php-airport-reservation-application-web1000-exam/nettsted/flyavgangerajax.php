<?php
include 'script/dbtilkobling.php';
@$filtrer=$_GET["filtrer"];
$where="";
if($filtrer)
{
	$where="where beskrivelse like '%$filtrer%' or fra.navn like '%$filtrer%' or fra.by like '%$filtrer%' or fra.land like '%$filtrer%' or fra.forkortelse like '%$filtrer%' or til.navn like '%$filtrer%' or til.by like '%$filtrer%' or til.land like '%$filtrer%' or til.forkortelse like '%$filtrer%'";

}
$sql="select r.beskrivelse, f.id, fra.id as fraid, til.id as tilid, fra.navn as franavn, fra.`by` as fraby, fra.land as fraland, fra.forkortelse as fraforkortelse, til.navn as tilnavn, til.`by` as tilby, til.land as tilland, til.forkortelse as tilforkortelse, count(f.id) as antallflights, min(f.pris) as lavestepris from rute r join flyplass fra on fra.id=r.avgang_fp join flyplass til on til.id=r.ankomst_fp inner join flight f on f.rute_id=r.id $where group by r.navn;";
$svar=mysqli_query($db,$sql) or die("feil");
$antall=mysqli_num_rows($svar);
if($antall===0)
{
	echo "
<div class='alert alert-danger'>
  <strong>Obs!</strong></br>Ingen treff på \"<strong>" . $filtrer . "</strong>\" i flyruter.
</div>";
}
else{
	echo "
	<div class='table-responsive'>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th>Fra</th>
				<th>Til</th>
				<th class='text-center'>Antall avganger</th>
				<th class='text-center'>Fly fra kr</th>
				<th class='text-center'>Beskrivelse</th>
			</tr>
		</thead>
	<tbody>";
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$avgangid=$rad["fraid"];
				$ankomstid=$rad["tilid"];
				$beskrivelse=$rad["beskrivelse"];
				$id=$rad["id"];
				$franavn=$rad["franavn"];
				$fraby=$rad["fraby"];
				$fraland=$rad["fraland"];
				$fraforkortelse=$rad["fraforkortelse"];
				$tilnavn=$rad["tilnavn"];
				$tilby=$rad["tilby"];
				$tilland=$rad["tilland"];
				$tilforkortelse=$rad["tilforkortelse"];
				$antallflights=$rad["antallflights"];
				$lavestepris=$rad["lavestepris"];
				$pris= $lavestepris . " ,-";
				echo"
				<tr onclick=\"window.location.href = 'flight.php?av=$avgangid&an=$ankomstid';\">
					<td>$franavn ($fraforkortelse), $fraby, $fraland</td>
					<td>$tilnavn ($tilforkortelse), $tilby, $tilland</td>
					<td class='text-center'>$antallflights</td>
					<td class='text-center'>$pris</td>
					<td class='text-center'>$beskrivelse</td>
				</tr>
				";
			}
			echo "</table></div>";
}
?>