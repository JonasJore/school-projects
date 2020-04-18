<?php
$sql="select * from $fra where id=$id;";
$svar=mysqli_query($db,$sql) or die("får ikke hentet informasjon fra id $id");
$rad=mysqli_fetch_array($svar);
$navn=$rad["navn"];
$pris=$rad["pris"];
$beskrivelse=$rad["beskrivelse"];
?>
<form method="post" onsubmit="return validerform()">
	<div class="col-md-6">
		<div class='panel panel-default'>
				<?php panelheader("Legg til en ny prisgruppe");?>
					<div class="col-md-6">
						<?php inputtext("navn",null,$navn);?>
					</div>
					<div class="col-md-6">
						<fieldset class='form-group' id='prisf'>
							<label class='control-label'>Pris i %</label>
								<input type='number' class='form-control' id='pris' name='pris' onkeyup='valider(this.value, this.id)' max="100" value="<?php echo $pris;?>">
								<span id='priss' aria-hidden='true'></span>
							</label>
						</fieldset>
					</div>
					<div class="col-md-6">
						<?php textareabeskrivelse($beskrivelse);?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="endreprisgruppe" name="endreprisgruppe" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$endreprisgruppe=$_POST["endreprisgruppe"];
		if($endreprisgruppe){
			$navn=$_POST["navn"];
			$pris=$_POST["pris"];
			$beskrivelse=$_POST["beskrivelse"];
			$sjekk=valider($_POST,3);
			if($sjekk===true){
				$sql="UPDATE `christensen2`.`prisgruppe` SET `navn`='$navn', `pris`='$pris', `beskrivelse`='$beskrivelse' WHERE `id`='$id';";
				mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
				echo sendmedjs("$fra.php?endret=1");					
			}
			else{
				echo feilet("$sjekk");
			}
		}
		?>
	</form>
</div>
