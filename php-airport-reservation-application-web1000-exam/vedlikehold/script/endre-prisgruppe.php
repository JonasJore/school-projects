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
	<div class="col-md-6">
		<div class='panel panel-default'>
			<?php panelheader("Endre/slett prisgrupper",1);?>
				<div class='table-responsive'>
					<table class='table table-hover datatable'>
						<thead>
							<tr>
								<th>Navn</th>
								<th>Pris i %</th>
								<th>Beskrivelse</th>
								<th class='text-center'>Endre</th>
								<th class='text-center'>Slett</th>
							</tr>
						</thead>
					<tbody>
					<?php
					$fra="prisgruppe";
					$sql="select * from $fra;";
					$antall=antall($sql);
					$svar=mysqli_query($db,$sql);
					for($r=0;$r<$antall;$r++){
						$rad=mysqli_fetch_array($svar);
						$id=$rad["id"];
						$navn=$rad["navn"];
						$pris=$rad["pris"];
						$beskrivelse=$rad["beskrivelse"];
						echo"<tr>
								<td>$navn</td>
								<td>$pris</td>
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
