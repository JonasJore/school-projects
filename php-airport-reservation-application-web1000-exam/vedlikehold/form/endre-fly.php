<?php
$sql="select * from $fra where id=$id;";
$svar=mysqli_query($db,$sql) or die("får ikke hentet informasjon fra id $id");
$rad=mysqli_fetch_array($svar);
$flynummer=$rad["flynummer"];
$flytype=$rad["Flytype_id"];
$flyselskap=$rad["flyselskap_id"];
?>
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Legg til en ny flytype");?>
					<div class="col-md-6">
						<?php selectflyselskap($flyselskap);?>
					</div>
					<div class="col-md-6">
						<?php selectflytype($flytype);?>
					</div>
					<div class="col-md-6">
						<?php inputtext("flynummer",null,$flynummer);?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="endrefly" name="endrefly" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$endrefly=$_POST["endrefly"];
		if($endrefly){
			$sjekk=valider($_POST,1);
			if(!$flyselskap || !$flytype || !$flynummer){
				echo tilbakemelding("Alle felt må fylles ut.","danger");
			}
			else{
				if($sjekk===true){
				$flyselskap=$_POST["flyselskap"];
				$flytype=$_POST["flytype"];
				$flynummer=$_POST["flynummer"];
				$sql="UPDATE `christensen2`.`fly` SET `flynummer`='$flynummer', `Flytype_id`='$flytype', `flyselskap_id`='$flyselskap' WHERE `id`='$id';";
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
