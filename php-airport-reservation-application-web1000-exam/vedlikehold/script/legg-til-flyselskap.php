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
			<?php panelheader("Legg til nytt flyselskap");?>
					<div class="col-md-6">
						<?php inputtext('navn','Flyselskap');?>
					</div>
					<div class="col-md-12">
						<fieldset>
							<input type="submit" id="leggtilflyselskap" name="leggtilflyselskap" class="btn btn-success" value="Fortsett">
							<button id="reset" name="reset" class="btn btn-danger">Tilbakestill</button>
						</fieldset>
					</div>
			</div>
		</div>
<?php
@$leggtilflyselskap=$_POST["leggtilflyselskap"];
if($leggtilflyselskap)
{
  $navn=$_POST["navn"];
  if(!$navn)
  {
    echo feilet("Alle felter må fylles ut for å kunne registrere");
  }
	else
  {
	  $sql="INSERT INTO `christensen2`.`flyselskap` (`navn`) VALUES ('$navn');";
	  mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
	  echo registrert("$navn ble registrert");
  }
}
?>
	</div>
</form>
