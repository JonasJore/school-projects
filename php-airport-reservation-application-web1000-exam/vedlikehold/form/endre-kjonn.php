<?php
$sql="select * from $fra where id=$id;";
$svar=mysqli_query($db,$sql) or die("får ikke hentet informasjon fra id $id");
$rad=mysqli_fetch_array($svar);
$kjonn=$rad["kjonn"];
?>
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Endre kjønnet $kjonn");?>
					<div class="col-md-6">
						<fieldset class='form-group' id='kjonninputf'>
							<label class='control-label'>Kjønn</label>
								<input type='text' class='form-control' id='kjonninput' name='kjonninput' onkeyup='valider(this.value, this.id)'  value="<?php echo $kjonn;?>">
								<span id='kjonninputs' aria-hidden='true'></span>
							</label>
						</fieldset>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="endrekjonn" name="endrekjonn" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$endrekjonn=$_POST["endrekjonn"];
		if($endrekjonn)
		{
			$kjonn=$_POST["kjonninput"];
			$sjekk=valider($_POST,1);
			if($sjekk===true){
				$sql="UPDATE `christensen2`.`kjonn` SET `kjonn`='$kjonn' WHERE `id`='$id';";
				mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
				echo sendmedjs("$fra.php?endret=1");
			}
			else{
				echo tilbakemelding($sjekk,"danger");
			}
			
		}
		?>
	</form>
</div>
