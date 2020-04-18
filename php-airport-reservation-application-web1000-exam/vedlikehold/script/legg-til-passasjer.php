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
<form method="post" onsubmit="return validerform()">
	<div class="col-md-6">
		<div class='panel panel-default'>
			<?php panelheader("Legg til ny passasjer");?>
					<div class="col-md-6">
						<?php inputtext("fornavn");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("etternavn");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("tlf","Telefonnummer");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("epost");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("pass","Passnummer");?>
					</div>
					<div class="col-md-6">
						<?php selectprisgruppe();?>
					</div>
					<div class="col-md-6">
						<?php selectnasjonalitet();?>
					</div>
					<div class="col-md-6">
						<?php radiokjonn();?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" id="leggtilpassasjer" name="leggtilpassasjer" class="btn btn-success" value="Fortsett">
						<button id="reset" name="reset" class="btn btn-danger">Tilbakestill</button>
					</fieldset>
					</div>
			</div>
		</div>
<?php
@$leggtilpassasjer=$_POST["leggtilpassasjer"];
if($leggtilpassasjer)
{
	$fornavn=$_POST["fornavn"];
	$etternavn=$_POST["etternavn"];
	$tlf=$_POST["tlf"];
	$epost=$_POST["epost"];
	$pass=$_POST["pass"];
	$pris=$_POST["prisgruppe"];
	$kjonn=$_POST["kjonn"];
	$id=genpassasjerid(6);
	$nasjonalitet=$_POST["nasjonalitet"];
	$sql="INSERT INTO `christensen2`.`passasjer` (`id`, `fornavn`, `etternavn`, `telefon_nummer`, `epost`, `pass_nummer`, `prisgruppe_id`, `kjonn_id`, `nasjonalitet_id`) VALUES ('$id','$fornavn', '$etternavn', '$tlf', '$epost', '$pass', '$pris', '$kjonn', '$nasjonalitet');";
	mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
	echo registrert("Passasjeren \"$fornavn, $etternavn\" ble registrert.");
}
?> 
	</div>
</form>
