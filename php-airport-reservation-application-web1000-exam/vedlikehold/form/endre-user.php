<?php
$sql="select * from user where id=$id;";
$svar=mysqli_query($db,$sql) or die("får ikke hentet informasjon fra id $id");
$rad=mysqli_fetch_array($svar);
$navn=$rad["navn"];
$brukernavn=$rad["user"];
?>
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Endre administrator-kontoen $brukernavn");?>
					<div class="col-md-6">
						<fieldset class='form-group' id='navnf'>
							<label class='control-label'>Navn</label>
								<input type='text' class='form-control' id='navn' name='navn' onkeyup='valider(this.value, this.id)'  value="<?php echo $navn;?>">
								<span id='navns' aria-hidden='true'></span>
							</label>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class='form-group' id='brukernavnf'>
							<label class='control-label'>Brukernavn</label>
								<input type='text' class='form-control' id='brukernavn' name='brukernavn' onkeyup='valider(this.value, this.id)'  value="<?php echo $brukernavn;?>" readonly>
								<span id='brukernavns' aria-hidden='true'></span>
							</label>
						</fieldset>
					</div>
					<div class="col-md-6">
						<?php inputpassord(1);?>
					</div>
					<div class="col-md-6">
						<?php inputpassord(2);?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="leggtiluser" name="leggtiluser" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$leggtiluser=$_POST["leggtiluser"];
		if($leggtiluser)
		{
			$navn=$_POST["navn"];
			$passord1=$_POST["passord1"];
			$passord2=$_POST["passord2"];
			$valider["navn"]=$navn;
			$sjekk=valider($valider,1);
			if($passord1==$passord2)
			{
				if($sjekk===true){
					$passordhash=password_hash($passord1, PASSWORD_BCRYPT);
					$sql="UPDATE `christensen2`.`user` SET `password`='$passordhash', `navn`='$navn' WHERE `id`='$id';";
					mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
					echo sendmedjs("$fra.php?endret=1");
										
				}
				else{
					echo feilet("$sjekk");
				}
			}
			else{
				echo feilet("Passordene stemmer ikke med hverandre.");
			}
		}
		?>
	</form>
</div>
