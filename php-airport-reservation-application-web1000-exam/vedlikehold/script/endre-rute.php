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
<!-- LEGG TIL RUTE -->
	<div class="col-md-12">
		<div class='panel panel-default'>
			<?php panelheader("Endre/slett ruter",1);?>
				<div class='table-responsive'>
					<table class='table table-hover datatable'>
						<thead>
							<tr>
								<th>Flyr fra</th>
								<th>Flyr til</th>
								<th>Beskrivelse</th>
								<th class='text-center'>Endre</th>
								<th class='text-center'>Slett</th>
							</tr>
						</thead>
					<tbody>
					<?php
					$fra="rute";
					$sql="SELECT r.id, r.navn, r.beskrivelse, fra.navn as franavn, fra.forkortelse as fraforkortelse, fra.land as fraland, til.navn as tilnavn, til.forkortelse as tilforkortelse, til.land as tilland from rute r join flyplass fra on fra.id=r.avgang_FP join flyplass til on til.id=r.ankomst_FP;";
					$antall=antall($sql);
					$svar=mysqli_query($db,$sql);
					for($r=0;$r<$antall;$r++){
						$rad=mysqli_fetch_array($svar);
						$id=$rad["id"];
						$beskrivelse=$rad["beskrivelse"];
						$franavn=$rad["franavn"];
						$fraforkortelse=$rad["fraforkortelse"];
						$fraland=$rad["fraland"];
						$tilnavn=$rad["tilnavn"];
						$tilforkortelse=$rad["tilforkortelse"];
						$tilland=$rad["tilland"];
						echo"<tr>
								<td>$franavn ($fraforkortelse), $fraland</td>
								<td>$tilnavn ($tilforkortelse), $tilland</td>
								<td>$beskrivelse</td>
								<td class='text-center'><a href='endre.php?fra=$fra&id=$id'><i class='glyphicon glyphicon-cog'></i></a></td>
								<td class='text-center'><a href='slett.php?fra=$fra&id=$id' onClick=\"return slett()\"><i class='glyphicon glyphicon-trash'></i></a></td>
							</tr>";
							}
					
					?>
					
					
					</table>
				</div>
			</div>
		</div>
	</div>
