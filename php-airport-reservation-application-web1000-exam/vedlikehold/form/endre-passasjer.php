<?php
	$sql="select * from passasjer where id=$id;";
	$bid=$_GET["bid"];
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
		<div class="col-md-6">
		<form method="post">
		<div class='panel panel-default'>
			<?php panelheader("Endre passasjer");?>
				<?php inputfornavn($fornavn);?>
				<?php inputetternavn($etternavn);?>
				<?php inputtlf($tlf);?>
				<?php inputpass($pass);?>
				<?php inputepost($epost);?>
				<?php selectprisgruppe($prisgruppe);?>
				<?php radiokjonn($kjonn);?>
				<?php selectnasjonalitet($nasjonalitet);?>
				<fieldset class="form-group">
					<input type="submit" class="btn btn-success" id="endrepassasjer" name="endrepassasjer" value="Fortsett">
					<input type="reset" class="btn btn-danger" value="Tilbakestill">
				</fieldset>
			</form>
		</div>
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
			echo feilet("Alle felt må fylles ut");
		}
		else
		{
			if($sjekk===true)
			{
				$sql="UPDATE passasjer SET fornavn='$fornavn', etternavn='$etternavn', telefon_nummer='$tlf', epost='$epost', pass_nummer='$pass', prisgruppe_id='$prisgruppe', kjonn_id='$kjonn', nasjonalitet_id='$nasjonalitet' WHERE id=$id;";
				$res=mysqli_query($db,$sql) or die("Noe er feil med SQL spørringen. Ta kontakt med noen som kan SQL");
				echo sendmedjs("billetter.php?id=$bid&endret=1");
			}
			else
			{
				echo tilbakemelding("$sjekk", "danger");
			}
		}
	}