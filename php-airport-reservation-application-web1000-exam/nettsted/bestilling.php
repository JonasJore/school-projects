<?php
include 'start.php';
?>
<ol class="breadcrumb">
	  <li><a href="flight.php">Velg flyavgang(er)</a></li>
	  <li class="active">Bestilling</li>
	</ol>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class='col-md-12'>
<?php
@$antallbilletter=$_GET["a"]; // Antall billetter
if(!$antallbilletter){ //Hvis antall ikke er angitt, så er det 1
	$antallbilletter=1;
}
@$fra=$_GET["fra"]; // FLIGHTID til flighten TUR
@$til=$_GET["til"]; // FLIGHTID til flighten RETUR
@$leggtilpassasjer=$_POST["leggtilpassasjer"]; // HVIS DU TRYKKER FORTSETT
if(!$til&&!$fra||!$fra) // Finner ingen flight info
{
	snu();
}
if($til) //TUR_RETUR =true
{
	$sql="SELECT fl.id, fl.avgang_tid, fl.avgang_dato, fl.ankomst_tid, fl.ankomst_dato, fl.pris, fly.flynummer, f.navn as avgangnavn, f.land as avgangland, f.forkortelse as avgangforkortelse, t.navn as ankomstnavn, t.land as ankomstland, t.forkortelse as ankomstforkortelse from flight fl join fly on fly.id=fl.fly_id join rute on rute.id=fl.rute_id join flyplass f on f.id=rute.avgang_fp join flyplass t on t.id=rute.ankomst_fp where fl.id=$til;";
	$svar=mysqli_query($db,$sql) or die ("feil");
	$rad=mysqli_fetch_assoc($svar);
	$avgangTid=klokkeslett($rad["avgang_tid"]);
	$avgangDato=$rad["avgang_dato"];
	$date=$avgangDato . " " . $avgangTid;
	$dato=datoformat($date);
	$ankomstTid=klokkeslett($rad["ankomst_tid"]);
	$ankomstDato=$rad["ankomst_dato"];
	$pris=$rad["pris"];
	$flynummer=$rad["flynummer"];
	$avgangnavn=$rad["avgangnavn"];
	$avgangland=$rad["avgangland"];
	$avgangforkortelse=$rad["avgangforkortelse"];
	$ankomstnavn=$rad["ankomstnavn"];
	$ankomstland=$rad["ankomstland"];
	$ankomstforkortelse=$rad["ankomstforkortelse"];
	@$returinfo="
			<h3>Retur</h3>
			<div class='row'>
				<div class='col-sm-4'>
					<b>Rute</b></br>
					$avgangnavn ($avgangforkortelse) - $ankomstnavn ($ankomstforkortelse)
				</div>
				<div class='col-sm-2'>
					<b>Dato</b></br>
					$dato
				</div>
				<div class='col-sm-2'>
					<b>Tid</b></br>
					$avgangTid - $ankomstTid
				</div>
				<div class='col-sm-2'>
					<b>Pris</b></br>
					$pris
				</div>
				<div class='col-sm-2'>
					<b>Antall</b></br>
					$antallbilletter
				</div>
			</div>
	";
}
if($fra) //EN VEI=true
{
	if($leggtilpassasjer) // BESTILLING FULLFØRT
	{
		//Genererer referansenummer og henter ID'en
		$referansenummer=refnr();
		$sql="INSERT INTO `christensen2`.`booking` (`referansenummer`) VALUES ('$referansenummer');";
		mysqli_query($db,$sql);
		$sql="select id from booking where referansenummer='$referansenummer';";
		$refid=hentid($sql);
		$valider=array();
		$godkjent=true;
		for($r=0;$r<$antallbilletter;$r++)
		{
			$teller=$r+1;
			@$fornavn=$_POST["fornavn"][$r];
			@$etternavn=$_POST["etternavn"][$r];
			@$tlf=$_POST["tlf"][$r];
			@$epost=$_POST["epost"][$r];
			@$pass=$_POST["pass"][$r];
			@$pris=$_POST["prisgruppe"][$r];
			@$kjonn=$_POST["kjonn$teller"];
			@$nasjonalitet=$_POST["nasjonalitet"][$r];
			$valider["fornavn"]=$fornavn;
			$valider["etternavn"]=$etternavn;
			$valider["tlf"]=$tlf;
			$valider["epost"]=$epost;
			$valider["pass"]=$pass;
			$validerer=valider($valider,5);
			if($fornavn && $etternavn && $tlf && $epost && $pass && $pris && $kjonn && $nasjonalitet)
			{
				if($validerer===true){

				}
				else{
					$godkjent=false;
					echo"
					<div class='alert alert-danger' role='alert'>
						<b>Passasjer $teller</b></br>
						$validerer
					</div>";
				}
			}
			else{
				$godkjent=false;
				echo"
				<div class='alert alert-danger' role='alert'>
					<b>Passasjer $teller</b></br>
					Alle felt må fylles ut.
				</div>";

			}
		}
		if($godkjent===true){
			for($r=0;$r<$antallbilletter;$r++)
			{
				$teller=$r+1;
				@$fornavn=$_POST["fornavn"][$r];
				@$etternavn=$_POST["etternavn"][$r];
				@$tlf=$_POST["tlf"][$r];
				@$epost=$_POST["epost"][$r];
				@$pass=$_POST["pass"][$r];
				@$pris=$_POST["prisgruppe"][$r];
				@$kjonn=$_POST["kjonn$teller"];
				@$nasjonalitet=$_POST["nasjonalitet"][$r];
				$id=genpassasjerid(6);
				$sql="INSERT INTO `christensen2`.`passasjer` (`id`,`fornavn`, `etternavn`, `telefon_nummer`, `epost`, `pass_nummer`, `prisgruppe_id`, `kjonn_id`, `nasjonalitet_id`) VALUES ('$id','$fornavn', '$etternavn', '$tlf', '$epost', '$pass', '$pris', '$kjonn', '$nasjonalitet');";
				mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
				$passasjerid=$id;
				//Genererer billettnummer og inserter billetten
				$billettnummer=billettnummer(6);
				$sete=gensete($fra);
				if($sete>0){
					$sql="INSERT INTO `christensen2`.`billett` (`flight_id`, `passasjer_id`, `booking_id`, `sete`, `billettnummer`) VALUES ('$fra', '$passasjerid', '$refid', '$sete', '$billettnummer');";
					mysqli_query($db,$sql) or die("feil med billett");
				}
				if($til){	
					$sete=gensete($til);
					if($sete>0){
						$billettnummer=billettnummer();
						$sql="INSERT INTO `christensen2`.`billett` (`flight_id`, `passasjer_id`, `booking_id`, `sete`, `billettnummer`) VALUES ('$til', '$passasjerid', '$refid', '$sete', '$billettnummer');";
						mysqli_query($db,$sql) or die("feil med");
					}
					
				}
			}
			echo"
					<div class='col-md-12'>
						<div class='well' role='alert'>
							Ditt referansenummer er : <b>$referansenummer</b><br/>
							Ta vare på referansenummeret ditt. Det kan du bruke til å hente billetter før avreise <a href='minbooking.php?referansenummer=$referansenummer' target='_blank'><b>her</b></a>.<br/>
							Vi ser frem til å ha deg ombord.
						</div>
					</div>";

				die();
		}
	}
	if(!@$godkjent){
	$sql="SELECT fl.id, fl.avgang_tid, fl.avgang_dato, fl.ankomst_tid, fl.ankomst_dato, fl.pris, fly.flynummer, f.navn as avgangnavn, f.land as avgangland, f.forkortelse as avgangforkortelse, t.navn as ankomstnavn, t.land as ankomstland, t.forkortelse as ankomstforkortelse from flight fl join fly on fly.id=fl.fly_id join rute on rute.id=fl.rute_id join flyplass f on f.id=rute.avgang_fp join flyplass t on t.id=rute.ankomst_fp where fl.id=$fra;";
	$svar=mysqli_query($db,$sql) or die ("feil");
	$rad=mysqli_fetch_assoc($svar);
	$avgangTid=klokkeslett($rad["avgang_tid"]);
	$avgangDato=$rad["avgang_dato"];
	$date=$avgangDato . " " . $avgangTid;
	$dato=datoformat($date);
	$ankomstTid=klokkeslett($rad["ankomst_tid"]);
	$ankomstDato=$rad["ankomst_dato"];
	$pris=$rad["pris"];
	$flynummer=$rad["flynummer"];
	$avgangnavn=$rad["avgangnavn"];
	$avgangland=$rad["avgangland"];
	$avgangforkortelse=$rad["avgangforkortelse"];
	$ankomstnavn=$rad["ankomstnavn"];
	$ankomstland=$rad["ankomstland"];
	$ankomstforkortelse=$rad["ankomstforkortelse"];
	echo "
	<div class='well'>
	<h2>Valgte avganger</h3>
			<h3>Tur</h3>
			<div class='row'>
				<div class='col-sm-4'>
					<b>Rute</b></br>
					$avgangnavn ($avgangforkortelse) - $ankomstnavn ($ankomstforkortelse)
				</div>
				<div class='col-sm-2'>
					<b>Dato</b></br>
					$dato
				</div>
				<div class='col-sm-2'>
					<b>Tid</b></br>
					$avgangTid - $ankomstTid
				</div>
				<div class='col-sm-2'>
					<b>Pris</b></br>
					$pris
				</div>
				<div class='col-sm-2'>
					<b>Antall</b></br>
					$antallbilletter
				</div>
			</div>" .
			@$returinfo ."
		<form method='post' class='form-horizontal' onsubmit=\"return validerform();\">
	</div>
</div>
<div class='row'>
	<div class='col-md-12'>";
	for($r=1;$r<=$antallbilletter;$r++){

	?>
<div class="col-md-6">
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h3 class="panel-title">Passasjer <?php echo $r;?></h3>
		</div>
		<div class='panel-body'>
			<div class="col-md-6">
				<?php inputfornavn(null,1,$r);?>
			</div>
			<div class="col-md-6">
				<?php inputetternavn(null,1,$r);?>
			</div>
			<div class="col-md-6">
				<?php inputtlf(null,1,$r);?>
			</div>
			<div class="col-md-6">
				<?php inputepost(null,1,$r);?>
			</div>
			<div class="col-md-6">
				<?php inputpass(null,1,$r);?>
			</div>
			<div class="col-md-6">
					<?php selectprisgruppe(NULL, 1, $r);?>
			</div>
			<div class="col-md-6">
					<?php radiokjonn(NULL, 1,$r);?>
			</div>
			<div class="col-md-6">
					<?php selectnasjonalitet(NULL, 1,$r);?>
			</div>
		</div>
	</div>
</div>
<?php
	}
	echo "
	</div>
</div>";
?>
<div class="col-md-12">
<?php
echo "
<input class='btn btn-primary' type='submit' id='leggtilpassasjer' name='leggtilpassasjer' value='Fortsett'>
<input class='btn btn-default' type='reset' value='Tilbakestill'>
";
?>
</div>
<?php
//ENDER FOR ANTALL, ENDER ROW
}} // ENDER IF-EN EN VEI= TRUE OG AT GODKJENT IKKE ER SANN
?>
		</form>
		</div> 		<!-- ENDER ANDRE ROW, INNHOLD SKAL OVER DENNE -->
	</div>		<!-- ENDER COL-MD-12 -->
</div>			<!-- ENDER FØRSTE ROW -->
<?php
include 'slutt.php';
?>
