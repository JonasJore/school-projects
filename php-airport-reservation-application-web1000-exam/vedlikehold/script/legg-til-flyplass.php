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
				<?php panelheader("Legg til flyplass");?>
					<div class="col-md-6">
						<?php inputtext("navn");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("by");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("land");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("forkortelse");?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="leggtilflyplass" name="leggtilflyplass" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>

			</div>
		</div>
		<?php
		@$leggtilflyplass=$_POST["leggtilflyplass"];
		if($leggtilflyplass){
			@$flyselskap=$_POST["navn"];
			@$by=$_POST["by"];
			@$land=$_POST["land"];
			@$forkortelse=$_POST["forkortelse"];
			$sjekk=valider($_POST,4);
			if(!$flyselskap||!$by||!$land||!$forkortelse){
				echo feilet("Et eller flere felter er tomme. Fyll ut alle og prøv igjen");
			}
			else{
				if($sjekk === true){
					$sql="INSERT INTO flyplass (navn, flyplass.by, land, forkortelse) VALUES ('$flyselskap','$by','$land','$forkortelse');";
					mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
					echo registrert("Du har registrert ny flyplass <b>\"$flyselskap\"</b>");
				}
				else{
					echo tilbakemelding($sjekk,"danger");
				}
				
			}
		}
		?>
	</form>
</div>
