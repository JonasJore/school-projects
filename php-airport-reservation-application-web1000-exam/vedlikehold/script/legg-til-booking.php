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
				<?php panelheader("Gjør en booking");?>
					<div class="col-md-6">
							<?php selectfraflyplass1();?>
					</div>
					<div class="col-md-6">
						<div id="selecttilflyplass1">
							<?php selecttilflyplass1();?>
						</div>
					</div>
					<div class="col-md-6">
						<?php plussminusmax10("Antall billetter",null,"antallbilletter");?>
					</div>
					<div class="col-md-6">
							<fieldset class="form-group" id="dato1uavhengigf">
								<label class="control-label">Avreise</label>
								<input class="form-control hentdatepicker" type="text" name="fradato" id="dato1uavhengig" onchange="valider(this.value,this.id)" autocomplete="off" required>
							</fieldset>
						</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="dobooking" name="dobooking" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$dobooking=$_POST["dobooking"];
		if($dobooking){
			$frapost=$_POST["fra"];
			$tilpost=$_POST["til"];
			$fradatopost=$_POST["fradato"];
			$antallpost=$_POST["antallbilletter"];
			if($frapost && $tilpost && $fradatopost && $antallpost){
				echo sendmedjs("booking2.php?av=$frapost&an=$tilpost&fra=$fradatopost&ant=$antallpost");
			}
			else{
				echo tilbakemelding("Alle felt må fylles ut!","danger");
			}
		}
		?>
	</form>
</div>
