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
<form method="post" onsubmit="return validerform()">
	<div class="col-md-6">
		<div class='panel panel-default'>
			<?php panelheader("Legg til ny eier");?>
					<div class="col-md-6">
						<?php inputtext('fornavn');?>
					</div>
					<div class="col-md-6">
						<?php inputtext('etternavn');?>
					</div>
					<div class="col-md-6">
						<?php inputtlf();?>
					</div>
					<div class="col-md-6">
						<?php inputepost();?>
					</div>
					<div class="col-md-12">
						<fieldset>
							<input type="submit" id="leggtileier" name="leggtileier" class="btn btn-success" value="Fortsett">
							<button id="reset" name="reset" class="btn btn-danger">Tilbakestill</button>
						</fieldset>
					</div>
			</div>
		</div>
<?php
@$leggtileier=$_POST["leggtileier"];
if($leggtileier)
{
	$fornavn=$_POST["fornavn"];
	$etternavn=$_POST["etternavn"];
	$telefonnr=$_POST["tlf"];
	$epost=$_POST["epost"];
	$sql="INSERT INTO `christensen2`.`eier` (`fornavn`, `etternavn`, `telefonnummer`, `epost`) VALUES ('$fornavn', '$etternavn', '$telefonnr', '$epost');";
	mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
	echo registrert("$fornavn, $etternavn ble registrert");
}
?> 
	</div>
</form>
