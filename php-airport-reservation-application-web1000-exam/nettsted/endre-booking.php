<?php
include 'start.php';
@$passasjerID=$_GET["pid"];
$sql="select bo.referansenummer from billett b join booking bo on bo.id=b.booking_id where b.passasjer_id=$passasjerID";
$svar=mysqli_query($db,$sql);
$rad=mysqli_fetch_array($svar);
$referansenummer=$rad["referansenummer"];
?>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
	<ol class="breadcrumb">
	  <li><a href="minbooking.php?referansenummer=<?php echo $referansenummer;?>">Min reise</a></li>
	  <li class="active">Endre billett</li>
	</ol>
	<h3 class="page-header">Endre billett</h3>
<?php
if($passasjerID)
{
	$sql="select * from passasjer where id=$passasjerID;";
	$svar=hentarray($sql);
	$fornavn=$svar["fornavn"];
	$etternavn=$svar["etternavn"];
	$tlf=$svar["telefon_nummer"];
	$pass=$svar["pass_nummer"];
	$epost=$svar["epost"];
	$prisgruppe=$svar["prisgruppe_id"];
	$kjonn=$svar["kjonn_id"];
	$nasjonalitet=$svar["nasjonalitet_id"];
	?>
	<div class="row">
		<div class="col-md-6">
			<form method="post">
				<?php inputfornavn($fornavn);?>
				<?php inputetternavn($etternavn);?>
				<?php inputtlf($tlf);?>
				<?php inputpass($pass);?>
				<?php inputepost($epost);?>
				<?php selectprisgruppe($prisgruppe);?>
				<?php radiokjonn($kjonn);?>
				<?php selectnasjonalitet($nasjonalitet);?>
				<fieldset class="form-group">
					<input type="submit" class="btn btn-primary" id="endrepassasjer" name="endrepassasjer" value="Fortsett">
					<input type="reset" class="btn btn-default" value="Tilbakestill">
				</fieldset>
			</form>
		</div>
	</div>
	<?php
	@$endrepassasjer=$_POST["endrepassasjer"];
	if($endrepassasjer){
		$sjekk=valider($_POST, 5);
		@$fornavn=$_POST["fornavn"];
		@$etternavn=$_POST["etternavn"];
		@$tlf=$_POST["tlf"];
		@$pass=$_POST["pass"];
		@$epost=$_POST["epost"];
		@$prisgruppe=$_POST["prisgruppe"];
		@$kjonn=$_POST["kjonn"];
		@$nasjonalitet=$_POST["nasjonalitet"];
		if(!$fornavn||!$etternavn||!$tlf||!$pass||!$epost)
		{
			echo feilet("Alle felt må fylles ut!");
		}
		else
		{
			if($sjekk===true)
			{
				$sql="UPDATE passasjer SET fornavn='$fornavn', etternavn='$etternavn', telefon_nummer='$tlf', epost='$epost', pass_nummer='$pass', prisgruppe_id='$prisgruppe', kjonn_id='$kjonn', nasjonalitet_id='$nasjonalitet' WHERE id=$passasjerID;";
				mysqli_query($db,$sql) or die("Noe er feil med SQL spørringen. Ta kontakt med noen som kan SQL");
				echo registrert("Din info er nå oppdatert $fornavn $etternavn");
			}
			else
			{
				echo tilbakemelding("$sjekk", "danger");
			}
		}
	}
}
else{
	snu();
}
//registrert();
?>
	</div>
</div>
<?php
include 'slutt.php';
?>
