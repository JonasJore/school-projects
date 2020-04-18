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
<!-- LEGG TIL ADMINISTRATOR -->
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Legg til administrator-konto");?>
					<div class="col-md-6">
						<?php inputtext("navn");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("brukernavn");?>
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
			$brukernavn=$_POST["brukernavn"];
			$passord1=$_POST["passord1"];
			$passord2=$_POST["passord2"];
			$sjekk=valider($_POST,2);
			if($passord1==$passord2)
			{
				if($sjekk===true){
					$passordhash=password_hash($passord1, PASSWORD_BCRYPT);
					$antall = antall("select * from user where user='$brukernavn'");
					if($antall == 0){
						$sql="INSERT INTO `christensen2`.`user` (`user`, `password`, `navn`) VALUES ('$brukernavn', '$passordhash', '$navn');";
						mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
						echo registrert("Brukeren \"$brukernavn\" ble registrert.");
					}
					else{
						echo feilet("Brukernavnet $brukernavn er allerede i bruk.");
					}					
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
