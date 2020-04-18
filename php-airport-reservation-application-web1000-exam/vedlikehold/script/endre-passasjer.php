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
			<?php panelheader("Endre/slett passasjer",1);?>
				<div class='table-responsive'>
					<table class='table table-hover'>
						<thead>
							<tr>
								<th>Navn</th>
								<th>Telefonnummer</th>
								<th>Epost</th>
								<th>Passnummer</th>
								<th>Prisgruppe</th>
								<th>Kjønn</th>
								<th>Land</th>
								<th class='text-center'>Endre</th>
								<th class='text-center'>Slett</th>
							</tr>
						</thead>
					<tbody>
					<?php
					$fra="passasjer";
					$sql="select p.id, p.fornavn,p.etternavn,p.telefon_nummer,p.epost,p.pass_nummer, prisgruppe.navn, kjonn.kjonn, nasjonalitet.land,nasjonalitet.forkortelse from passasjer p join prisgruppe on prisgruppe.id=p.prisgruppe_id join kjonn on kjonn.id=p.kjonn_id join nasjonalitet on nasjonalitet.id=p.nasjonalitet_id;";
					$antall=antall($sql);
					$svar=mysqli_query($db,$sql);
					for($r=0;$r<$antall;$r++){
						$rad=mysqli_fetch_array($svar);
						$id=$rad["id"];
						$fornavn=$rad["fornavn"];
						$etternavn=$rad["etternavn"];
						$tlf=$rad["telefon_nummer"];
						$epost=$rad["epost"];
						$pass=$rad["pass_nummer"];
						$prisgruppe=$rad["navn"];
						$kjonn=$rad["kjonn"];
						$land=$rad["land"];
						$forkortelse=$rad["forkortelse"];
						echo"<tr>
								<td>$fornavn, $etternavn</td>
								<td>$tlf</td>
								<td>$epost</td>
								<td>$pass</td>
								<td>$prisgruppe</td>
								<td>$kjonn</td>
								<td>$land ($forkortelse)</td>
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
