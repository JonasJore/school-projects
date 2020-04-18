<?php
include("script/endre-nasjonalitet.php");
$sql="SELECT * FROM nasjonalitet where id=$nid;";
$res=mysqli_query($db, $sql) or die("kunne ikke hente fra db (nasjonalitet)");
$fetch=mysqli_fetch_array($res);
$land=$fetch["land"];
$forkortelse=$fetch["forkortelse"];
$retningsnummer=$fetch["retningsnummer"];
?>
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
			<?php panelheader("Endre nasjonalitet");?>
				<div class="col-md-6">
					<?php inputtext('land', NULL, $land);?>
				</div>
				<div class="col-md-6">
					<?php inputtext('forkortelse', NULL, $forkortelse);?>
				</div>
				<div class="col-md-6">
					<?php inputtext('retningsnummer', NULL, $retningsnummer);?>
				</div>
				<div class="col-md-12">
					<fieldset class="form-group">
						<input type='submit' class='btn btn-success' name='endrenasjon' value="Fortsett">
						<input type='reset' class='btn btn-danger' value='Tilbakestill' name='tilbakestill'>
					</fieldset>
				</div>
			</div>
		</div>
	</form>
</div>
<?php
  @$endrenasjon=$_POST["endrenasjon"];
  if($endrenasjon)
  {
    @$land=$_POST["land"];
    @$forkortelse=$_POST["forkortelse"];
    @$retningsnummerfrapost=$_POST["retningsnummer"];
    $sjekk=valider($_POST,3);
    if(!$land||!$forkortelse||!$retningsnummerfrapost)
    {
      echo feilet("Feltet kan ikke stå tomt. Da blir det fort full forvirring!");
    }
    else
    {
		if($sjekk===true){
			$sql="UPDATE nasjonalitet set land='$land', forkortelse='$forkortelse', retningsnummer='$retningsnummerfrapost' where id='$nid';";
			mysqli_query($db, $sql) or die("kunne ikke endre i db (sql 2 i endre nasjon)");
			echo sendmedjs("nasjonalitet.php?endret=1");
		}
		else{
			echo tilbakemelding($sjekk,"danger");
		}
      
    }
  }
?>
