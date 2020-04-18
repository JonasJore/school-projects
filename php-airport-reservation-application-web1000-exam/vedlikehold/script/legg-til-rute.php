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
<!-- LEGG TIL RUTE -->
<form method="post" onsubmit="return validerform()">
	<div class="col-md-6">
		<div class='panel panel-default'>
			<?php panelheader("Legg til ny rute");?>
					<div class="col-md-6">
						<?php selectruteflyplass(1);?>
					</div>
					<div class="col-md-6">
						<?php selectruteflyplass(2);?>
					</div>
					<div class="col-md-6">
						<?php textareabeskrivelse();?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="leggtilrute" name="leggtilrute" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
			</div>
		</div>
		<?php
@$leggtilrute=$_POST["leggtilrute"];
if($leggtilrute){
	$ruteflyplass1=$_POST["ruteflyplass1"];
	$ruteflyplass2=$_POST["ruteflyplass2"];
	$beskrivelse=$_POST["beskrivelse"];
	if(!$ruteflyplass1 || !$ruteflyplass2 || !$beskrivelse){
		echo tilbakemelding("Alle felt må fylles ut!","danger");
	}
	else{
		$avgangfrapost=explode(";", $ruteflyplass1);
		$ankomstfrapost=explode(";", $ruteflyplass2);
		$avgangid=$avgangfrapost[0];
		$ankomstid=$ankomstfrapost[0];
		$avgangnavn=$avgangfrapost[1];
		$ankomstnavn=$ankomstfrapost[1];
		$navn=$avgangnavn . " - " . $ankomstnavn;
		if($avgangfrapost && $ankomstfrapost){
			$antall=antall("select * from rute where navn='$navn'");
			if($antall <1){
				$sql="INSERT INTO `christensen2`.`rute` (`avgang_FP`, `ankomst_FP`, `navn`, `beskrivelse`) VALUES ('$avgangid', '$ankomstid', '$navn', '$beskrivelse');";
				mysqli_query($db,$sql) or die("Her skjedde det noe galt");
				echo registrert("Du har registrert ruten <b>\"$navn\"</b>");
			}
			else{
				echo tilbakemelding("Ruten <b>\"$navn\"</b> finnes fra før.","danger");
			}
		}
	}
	
}
?> 
	</div>
</form>
