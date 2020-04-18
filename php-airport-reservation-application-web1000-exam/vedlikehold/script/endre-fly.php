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
	<div class="col-md-7">
		<div class='panel panel-default'>
			<?php panelheader("Endre/slett fly",1);?>
				<div class='table-responsive'>
					<table class='table table-hover datatable'>
						<thead>
							<tr>
								<th>Flynummer</th>
								<th>Modell</th>
								<th>Kapasitet</th>
								<th>Eid av</th>
								<th class='text-center'>Endre</th>
								<th class='text-center'>Slett</th>
							</tr>
						</thead>
					<tbody>
					<?php
					$fra="fly";
					$sql="select fly.id, flytype.kapasitet, flytype.modell, fly.flynummer, flyselskap.navn from fly join flyselskap on flyselskap.id=fly.flyselskap_id join flytype on flytype.id=fly.flytype_id;";
					$antall=antall($sql);
					$svar=mysqli_query($db,$sql);
					for($r=0;$r<$antall;$r++){
						$rad=mysqli_fetch_array($svar);
						$id=$rad["id"];
						$kapasitet=$rad["kapasitet"];
						$modell=$rad["modell"];
						$flynummer=$rad["flynummer"];
						$navn=$rad["navn"];
						echo"<tr>
								<td>$flynummer</td>
								<td>$modell</td>
								<td>$kapasitet</td>
								<td>$navn</td>
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
