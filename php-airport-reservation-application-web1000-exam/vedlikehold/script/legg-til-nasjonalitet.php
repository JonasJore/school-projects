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
<form method="post" onsubmit="return validerform()">
	<div class="col-md-6">
		<div class='panel panel-default'>
			<?php panelheader("Legg til en ny nasjon");?>
					<div class="col-md-6">
						<?php inputtext('land');?>
					</div>
					<div class="col-md-6">
						<?php inputtext('forkortelse');?>
					</div>
					<div class="col-md-6">
						<?php inputtext('retningsnummer');?>
					</div>
					<div class="col-md-12">
						<fieldset>
							<input type="submit" id="leggtilnasjonalitet" name="leggtilnasjonalitet" class="btn btn-success" value="Fortsett">
							<button id="reset" name="reset" class="btn btn-danger">Tilbakestill</button>
						</fieldset>
					</div>
			</div>
		</div>
<?php
@$leggtilnasjonalitet=$_POST["leggtilnasjonalitet"];
if($leggtilnasjonalitet)
{
	$land=$_POST["land"];
	$forkortelse=$_POST["forkortelse"];
	$retningsnummer=$_POST["retningsnummer"];
	if($land && $forkortelse && $retningsnummer){
		$sjekk=valider($_POST,3);
		if($sjekk===true){
			$sql="INSERT INTO `christensen2`.`nasjonalitet` (`land`, `forkortelse`, `retningsnummer`) VALUES ('$land', '$forkortelse', '$retningsnummer');";
			mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
			echo registrert("Landet \"$land\" ble registrert med retningsnummeret $retningsnummer!");
		}
		else{
			echo tilbakemelding($sjekk,"warning");
		}
		
	}else{
		echo tilbakemelding("Alle felt må fylles ut!","danger");
	}
	
}
?> 



	
	</div>
</form>
