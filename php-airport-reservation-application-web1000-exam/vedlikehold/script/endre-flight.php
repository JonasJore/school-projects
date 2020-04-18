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
			<?php panelheader("Endre/slett flights",1);?>
			<div class="row">
				<div class="col-md-3">
					<form method="get">
						<fieldset class="form-group">
							<?php selectrutesorter("rutesorter", "Sorter på rute");?>
							<input type="submit" id="sorterrute" class="btn btn-default" value="Sorter">
						</fieldset>
					</form>
				</div>
			</div>
					<?php
					@$rutesorter=$_GET["rutesorter"];
					$where="";
					if($rutesorter){
						$where="where f.rute_id=$rutesorter";
					}
					$fra="flight";
					$sql="select f.id, f.avgang_tid, f.ankomst_tid, f.avgang_dato, f.ankomst_dato, f.pris, r.navn, fly.flynummer from flight f join fly on fly.id=f.fly_id join rute r on r.id=f.rute_id $where;";
					$antall=antall($sql);
					if($antall===0){
						echo "</Br>" . tilbakemelding("Ingen flights på valgt rute","danger");
					}else{
						echo"<div class='table-responsive'>
					<table class='table table-hover datatable'>
						<thead>
							<tr>
								<th>Flynummer</th>
								<th>Pris</th>
								<th>Avgang</th>
								<th>Ankomst</th>
								<th>Rute</th>
								<th class='text-center'>Endre</th>
								<th class='text-center'>Slett</th>
							</tr>
						</thead>
					<tbody>";
						$svar=mysqli_query($db,$sql);
						for($r=0;$r<$antall;$r++){
							$rad=mysqli_fetch_array($svar);
							$id=$rad["id"];
							$avgangtid=$rad["avgang_tid"];
							$avgangdato=$rad["avgang_dato"];
							$ankomsttid=$rad["ankomst_tid"];
							$ankomstdato=$rad["ankomst_dato"];
							$pris=$rad["pris"];
							$rutenavn=$rad["navn"];
							$flynummer=$rad["flynummer"];
							echo"<tr>
									<td>$flynummer</td>
									<td>$pris</td>
									<td>$avgangtid, $avgangdato</td>
									<td>$ankomsttid, $ankomstdato</td>
									<td>$rutenavn</td>
									<td class='text-center'><a href='endre.php?fra=$fra&id=$id'><i class='glyphicon glyphicon-cog'></i></a></td>
									<td class='text-center'><a href='slett.php?fra=$fra&id=$id' onClick=\"return slett()\"><i class='glyphicon glyphicon-trash'></i></a></td>
								</tr>";
						}
						
					}
					
					?>
					
					
					</table>
				</div>
			</div>
		</div>
	</div>
