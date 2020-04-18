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
			<?php panelheader("Endre/slett bookinger");?>
				<div class='table-responsive'>
					<table class='table table-hover datatable'>
						<thead>
							<tr>
								<th>Referansenummer</th>
								<th>Antall billetter</th>
								<th class='text-center'>Endre</th>
								<th class='text-center'>Slett</th>
							</tr>
						</thead>
					<tbody>
					<?php
					$fra="booking";
					$sql="select booking.id, count(booking_id) as antall, booking.referansenummer from billett join booking on billett.booking_id=booking.id group by booking.referansenummer;";
					$antall=antall($sql);
					$svar=mysqli_query($db,$sql);
					for($r=0;$r<$antall;$r++){
						$rad=mysqli_fetch_array($svar);
						$id=$rad["id"];
						$referansenummer=$rad["referansenummer"];
						$antallbilletter=$rad["antall"];
						echo"<tr>
								<td>$referansenummer</td>
								<td>$antallbilletter</td>
								<td class='text-center'><a href='billetter.php?id=$id'><i class='glyphicon glyphicon-cog'></i></a></td>
								<td class='text-center'><a href='slett.php?fra=$fra&id=$id' onClick=\"return slett()\"><i class='glyphicon glyphicon-trash'></i></a></td>
							</tr>";
					}
					
					?>
					
					
					</table>
				</div>
			</div>
		</div>
	</div>
