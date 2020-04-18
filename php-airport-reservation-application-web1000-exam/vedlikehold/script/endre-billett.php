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
	<div class="col-md-10"><div class="row"><?php
					$fra="passasjer";
					$id=$_GET["id"];
					$sql="select b.sete, b.billettnummer, p.id as passasjerid, p.fornavn, p.etternavn, p.telefon_nummer, p.epost, p.pass_nummer,
pris.navn as prisgruppe,nas.retningsnummer, nas.land as nasjonland, nas.forkortelse as nasjonforkortelse, kjonn.kjonn, b.billettnummer,
fl.avgang_tid, fl.ankomst_tid, fl.avgang_dato, fl.ankomst_dato, fra.navn as franavn , fra.by as fraby, fra.land as fraland, til.navn as tilnavn, til.by as tilby, til.land as tilland
from billett b
join passasjer p on p.id=b.passasjer_id
join prisgruppe pris on pris.id=p.prisgruppe_id
join nasjonalitet nas on nas.id=p.nasjonalitet_id
join kjonn on kjonn.id=p.kjonn_id
join flight fl on fl.id=b.flight_id
join rute r on r.id=fl.rute_id
join flyplass fra on fra.id=r.avgang_fp
join flyplass til on til.id=r.ankomst_fp
where b.booking_id=$id;";
					$antall=antall($sql);
					$svar=mysqli_query($db,$sql);
					for($r=0;$r<$antall;$r++){
						$rad=mysqli_fetch_array($svar);
						$sete=$rad["sete"];
						$passasjerid=$rad["passasjerid"];
						$fornavn=$rad["fornavn"];
						$etternavn=$rad["etternavn"];
						$telefonnummer=$rad["telefon_nummer"];
						$epost=$rad["epost"];
						$passnummer=$rad["pass_nummer"];
						$prisgruppe=$rad["prisgruppe"];
						$retningsnummer=$rad["retningsnummer"];
						$nasjonland=$rad["nasjonland"];
						$nasjonforkortelse=$rad["nasjonforkortelse"];
						$kjonn=$rad["kjonn"];
						$billettnummer=$rad["billettnummer"];
						$avgangtid=$rad["avgang_tid"];
						$avgangdato=$rad["avgang_dato"];
						$ankomsttid=$rad["ankomst_tid"];
						$ankomstdato=$rad["ankomst_dato"];
						$franavn=$rad["franavn"];
						$fraby=$rad["fraby"];
						$fraland=$rad["fraland"];
						$tilnavn=$rad["tilnavn"];
						$tilby=$rad["tilby"];
						$tilland=$rad["tilland"];
						$idrandom=genererrandomnummer(23);
						echo"
							<div class='col-md-12'>
								<div class='table'>
									<table class='table table-condensed'>
										<thead>
											<tr>
												<th>Fornavn</th>
												<th>Etternavn</th>
												<th>Telefonnummer</th>
												<th>Epost</th>
												<th>Land</th>
												<th>Passnummer</th>
												<th>Prisgruppe</th>
												<th>Kjønn</th>
												<th class='text-center'>Flight informasjon</th>
												<th class='text-center'>Endre</th>
												<th class='text-center'>Slett</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>$fornavn</td>
												<td>$tilland</td>
												<td>($retningsnummer)$telefonnummer</td>
												<td>$epost</td>
												<td>$nasjonland ($nasjonforkortelse)</td>
												<td>$passnummer</td>
												<td>$prisgruppe</td>
												<td>$kjonn</td>
												<td class='text-center'><button class='btn btn-default btn-sm' href='#$idrandom' data-toggle='collapse'>Vis mer</button></td>
												<td class='text-center'><a href='endre.php?fra=$fra&id=$passasjerid&bid=$id'><i class='glyphicon glyphicon-cog'></i></a></td>
												<td class='text-center'><a href='slett.php?fra=$fra&id=$passasjerid' onClick=\"return slett()\"><i class='glyphicon glyphicon-trash'></i></a></td>
												</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div id='$idrandom' class='well collapse col-md-12'>
								<div class='row'>
									<div class='col-md-4'>
										<h4>Sete</h4>
										<p>
										<strong>$sete</strong>
										</p>
									</div>
									<div class='col-md-4'>
										<h4>Avgang</h4>
										<p>
										<strong>Sted: </strong> $franavn, $fraby, $fraland</br>
										<strong>Tid: </strong> $avgangtid $avgangdato</br>
										</p>
									</div>
									<div class='col-md-4'>
										<h4>Ankomst</h4>
										<p>
										<strong>Sted: </strong> $tilnavn, $tilby, $tilland</br>
										<strong>Tid: </strong> $ankomsttid $ankomstdato</br>
										</p>
									</div>
								</div>
							</div>
							";
					}
					
					?>
					
				
	</div>
