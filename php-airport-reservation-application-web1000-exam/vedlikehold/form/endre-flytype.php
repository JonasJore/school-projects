<?php
$sql="select * from $fra where id=$id;";
$svar=mysqli_query($db,$sql) or die("får ikke hentet informasjon fra id $id");
$rad=mysqli_fetch_array($svar);
$kapasitet=$rad["kapasitet"];
$modell=$rad["modell"];
?>
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Legg til en ny flytype");?>
					<div class="col-md-6">
						<?php inputtext("kapasitet","Kapasitet",$kapasitet);?>
					</div>
					<div class="col-md-6">
						<?php inputtext("modell","Navn på flymodell",$modell);?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="endreflytype" name="endreflytype" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$endreflytype=$_POST["endreflytype"];
		if($endreflytype){
			$sjekk=valider($_POST,2);
			$kapasitet=$_POST["kapasitet"];
			$modell=$_POST["modell"];
			if(!$kapasitet || !$modell){
				echo tilbakemelding("Alle felt må fylles ut","danger");
			}
			else{
				if($sjekk===true){
					$sql="UPDATE `christensen2`.`flytype` SET `kapasitet`='$kapasitet', `modell`='$modell' WHERE `id`='$id';";
					mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
					echo sendmedjs("fly.php?endret=1");
				}
				else{
					echo tilbakemelding($sjekk,"danger");
				}
			}
		}
		?>
	</form>
</div>
