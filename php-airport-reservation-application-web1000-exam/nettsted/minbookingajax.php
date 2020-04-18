<?php
include 'script/dbtilkobling.php';
include '../vedlikehold/script/funksjoner.php';
	@$referansenummer=$_GET["referansenummer"];
	if($referansenummer){
		if(refsjekk($referansenummer)===true){
			$referansenummer=$_GET["referansenummer"];
			$sql="select b.sete, booking.referansenummer, p.id as passasjerid, p.fornavn, p.etternavn, p.telefon_nummer, p.epost, p.pass_nummer,
			pris.navn as prisgruppe,nas.retningsnummer, nas.land as nasjonland, nas.forkortelse as nasjonforkortelse, kjonn.kjonn, b.billettnummer,
			fl.avgang_tid, fl.ankomst_tid, fl.avgang_dato, fl.ankomst_dato, fra.navn as franavn , fra.by as fraby, fra.land as fraland, til.navn as tilnavn, til.by as tilby, til.land as tilland
			from billett b
			join booking on booking.id=b.booking_id
			join passasjer p on p.id=b.passasjer_id
			join prisgruppe pris on pris.id=p.prisgruppe_id
			join nasjonalitet nas on nas.id=p.nasjonalitet_id
			join kjonn on kjonn.id=p.kjonn_id
			join flight fl on fl.id=b.flight_id
			join rute r on r.id=fl.rute_id
			join flyplass fra on fra.id=r.avgang_fp
			join flyplass til on til.id=r.ankomst_fp
			where booking.referansenummer='$referansenummer';";
			$antall=antall($sql);
			$svar=mysqli_query($db,$sql);
			echo"
			<div class='panel panel-default'>
				<div class='panel-heading'>
					<h3>Dine billetter</h3></div>
			<div class='panel-body'>";
			for($r=0;$r<$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$fra="min-booking";
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
										<th class='text-center'>Fornavn</th>
										<th class='text-center'>Etternavn</th>
										<th class='text-center'>Telefonnummer</th>
										<th class='text-center'>Epost</th>
										<th class='text-center'>Land</th>
										<th class='text-center'>Passnummer</th>
										<th class='text-center'>Prisgruppe</th>
										<th class='text-center'>Kjønn</th>
										<th class='text-center'>Flight informasjon</th>
										<th class='text-center'>Endre</th>
										<th class='text-center'>Slett</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class='text-center'>$fornavn</td>
										<td class='text-center'>$tilland</td>
										<td class='text-center'>($retningsnummer)$telefonnummer</td>
										<td class='text-center'>$epost</td>
										<td class='text-center'>$nasjonland ($nasjonforkortelse)</td>
										<td class='text-center'>$passnummer</td>
										<td class='text-center'>$prisgruppe</td>
										<td class='text-center'>$kjonn</td>
										<td class='text-center'><button class='btn btn-default btn-sm' href='#$idrandom' data-toggle='collapse'>Vis mer</button></td>
										<td class='text-center'><a href='endre-booking.php?pid=$passasjerid'><i class='glyphicon glyphicon-cog'></i></a></td>
										<td class='text-center'><a href='slett.php?fra=$fra&passasjerID=$passasjerid&billett=$billettnummer' onClick=\"return slett('Er du sikker på at du vil avbestille? Pengene vil ikke bli refundert.')\"><i class='glyphicon glyphicon-trash'></i></a></td>
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
			echo"
					</div>
				</div>
				</div>";
		}
		else{
			echo "<div class='alert alert-danger' role='alert'>
			Referansenummeret: <b>$referansenummer</b> er ugyldig.
			</div>";
		}
	}
?>
