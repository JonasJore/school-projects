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
<!-- LEGG TIL flytype -->
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Legg til ett nytt fly");?>
					<div class="col-md-6">
						<?php selectflyselskap();?>
					</div>
					<div class="col-md-6">
						<?php selectflytype();?>
					</div>
					<div class="col-md-6">
						<?php inputtext("flynummer");?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="leggtilfly" name="leggtilfly" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$leggtilfly=$_POST["leggtilfly"];
		if($leggtilfly){
			$flyselskap=$_POST["flyselskap"];
			$flytype=$_POST["flytype"];
			$flynummer=$_POST["flynummer"];
			if(!$flyselskap || !$flytype || !$flynummer){
				echo tilbakemelding("Alle felt må fylles ut.","danger");
			}
			else{
				$sjekk=valider($_POST,1);
				if($sjekk === true){
					$sql="INSERT INTO `christensen2`.`fly` (`flytype_id`, `flynummer`, `flyselskap_id`) VALUES ('$flytype', '$flynummer', '$flyselskap');";
					mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
					echo registrert("Du har registrert flyet <b>\"$flynummer\"</b>");
				}
				else{
					echo tilbakemelding($sjekk,"danger");
				}
			}
			;
		}
		?>
	</form>
</div>
