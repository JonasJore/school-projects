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
<form method="post" onsubmit="return validerform()">
	<div class="col-md-6">
		<div class='panel panel-default'>
				<?php panelheader("Legg til en ny prisgruppe");?>
					<div class="col-md-6">
						<?php inputtext("navn");?>
					</div>
					<div class="col-md-6">
						<fieldset class='form-group' id='prisf'>
							<label class='control-label'>Pris i %</label>
								<input type='number' class='form-control' id='pris' name='pris' onkeyup='valider(this.value, this.id)' max="100">
								<span id='priss' aria-hidden='true'></span>
							</label>
						</fieldset>
					</div>
					<div class="col-md-6">
						<?php textareabeskrivelse();?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="leggtilprisgruppe" name="leggtilprisgruppe" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
	<?php
	@$leggtilprisgruppe=$_POST["leggtilprisgruppe"];
	if($leggtilprisgruppe)
	{
		$navn=$_POST["navn"];
		$pris=$_POST["pris"];
		$beskrivelse=$_POST["beskrivelse"];
		$sjekk=valider($_POST,3);
		if($sjekk===true){
			$sql="INSERT INTO `christensen2`.`prisgruppe` (`navn`, `pris`, `beskrivelse`) VALUES ('$navn', '$pris', '$beskrivelse');";
			mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
			echo registrert("Prisgruppen <strong>\"$navn\"</strong> ble registrert");
		}
		else{
			echo tilbakemelding($sjekk,"danger");
		}
		
	}

?>
		
		
		
	</div>
</form>
