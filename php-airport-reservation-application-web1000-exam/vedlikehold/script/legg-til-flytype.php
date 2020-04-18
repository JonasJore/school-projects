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
				<?php panelheader("Legg til en ny flytype");?>
					<div class="col-md-6">
						<?php inputtext("kapasitet","Kapasitet");?>
					</div>
					<div class="col-md-6">
						<?php inputtext("modell","Navn på flymodell");?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="leggtilflytype" name="leggtilflytype" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$leggtilflytype=$_POST["leggtilflytype"];
		if($leggtilflytype){
			$kapasitet=$_POST["kapasitet"];
			$modell=$_POST["modell"];
			$sjekk=valider($_POST,2);
			if(!$kapasitet || !$modell){
				echo tilbakemelding("Alle felt må fylles ut","danger");
			}
			else{
				if($sjekk=true){
					$sql="INSERT INTO `christensen2`.`flytype` (`kapasitet`, `modell`) VALUES ('$kapasitet', '$modell');";
					mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
					echo registrert("Du har registrert flytypen <b>\"$modell\"</b>");
				}
				else{
					echo tilbakemelding($sjekk,"danger");
				}
			}
		}
		?>
	</form>
</div>
