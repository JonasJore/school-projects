<?php
include'start.php';
 ?>
 <form class="form-horizontal" method="post">
 <fieldset>


 <legend>Legg til Administrator-Konto</legend>

 <div class="form-group">
  <fieldset id="navnf">
   <label class="col-md-4 control-label" for="navn">Navn</label>
   <div class="col-md-4">
   <input type="text" placeholder="Fullt navn" id="navn" name="navn" class="form-control input-md" onkeyup="valider(this.value, this.id)" required>
   <span id="navns" aria-hidden="true"></span>
   </div>
   </fieldset>
 </div>

 <div class="form-group">
 <fieldset id="brukernavnf">
   <label class="col-md-4 control-label" id="brukernavntilbakemelding">Brukernavn</label>
   <div class="col-md-4">
   <input id="brukernavn" name="brukernavn" type="text" placeholder="" class="form-control input-md" onkeyup="valider(this.value, this.id)" required>
   <span id="brukernavns" aria-hidden="true"></span>
   </div>
   </fieldset>
 </div>

 <div class="form-group">
  <fieldset id="passord1f">
   <label class="col-md-4 control-label" for="textinput">Passord</label>
   <div class="col-md-4">
   <input id="passord1" name="passord1" type="password" placeholder="Minimum 8 tegn" class="form-control input-md" onkeyup="valider(this.value, this.id)" required>
   <span id="passord1s" aria-hidden="true"></span>
   </div>
   </fieldset>
 </div>

 <div class="form-group">
  <fieldset id="passord2f">
   <label class="col-md-4 control-label" id="bekreftpassord">Bekreft passord</label>
   <div class="col-md-4">
   <input id="passord2" name="passord2" type="password" placeholder="Gjenta passord" class="form-control input-md" onkeyup="valider(this.value, this.id)" required>
   <span id="passord2s" aria-hidden="true"></span>
   </div>
   </fieldset>
 </div>
<div class="form-group">
<div class="col-md-4 col-md-offset-4">
	<span id="passordtilbakemelding"></span>
	</div>
</div>
 <div class="form-group">
   <label class="col-md-4 control-label" for="button1id">Valg</label>
   <div class="col-md-8">
     <input type="submit" id="leggtiluser" name="leggtiluser" class="btn btn-success" value="Fortsett">
     <button id="reset" name="reset" class="btn btn-danger">Tilbakestill</button>
   </div>
 </div>

 </fieldset>
 </form>
<?php
@$leggtiluser=$_POST["leggtiluser"];
if($leggtiluser)
{
	echo"<div class='col-md-4 col-md-offset-3'>";
	$navn=$_POST["navn"];
	$brukernavn=$_POST["brukernavn"];
	$passord1=$_POST["passord1"];
	$passord2=$_POST["passord2"];
	$valider["navn"]=$navn;
	$valider["brukernavn"]=$brukernavn;
	$validerer=valider($valider);
	if($passord1==$passord2)
	{
		if($validerer===true){
			$passordhash=password_hash($passord1, PASSWORD_BCRYPT);
			$sql="INSERT INTO `christensen2`.`user` (`user`, `password`, `navn`) VALUES ('$brukernavn', '$passordhash', '$navn');";
			mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
			echo registrert("Brukeren \"$brukernavn\" ble registrert.");
			
		}
		else{
			echo feilet("$validerer");
		}
	
	}
	else{
		echo feilet("Passordene stemmer ikke med hverandre.");
	}
	echo "</div>";
}

?>

<?php
include 'slutt.php';
 ?>
