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
<form method="post" onsubmit="return validerform()">
	<div class="col-md-6">
		<div class='panel panel-default'>
				<?php panelheader("Legg til ett nytt kjønn (fremtidig)");?>
					<div class="col-md-6">
						<?php inputtext("kjonninput","Kjønn");?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="leggtilkjonn" name="leggtilkjonn" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$leggtilkjonn=$_POST["leggtilkjonn"];
		if($leggtilkjonn){
			$kjonn=$_POST["kjonninput"];
			$sjekk=valider($_POST,1);
			if($kjonn){
				$sql="INSERT INTO `christensen2`.`kjonn` (`kjonn`) VALUES ('$kjonn');";
				mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
				echo registrert("Kjønnet <strong>\"$kjonn\"</strong> ble registrert");
			}
			else{
				echo tilbakemelding($sjekk,"danger");
			}
			
		}
		?>
		
		
		
	</div>
</form>
