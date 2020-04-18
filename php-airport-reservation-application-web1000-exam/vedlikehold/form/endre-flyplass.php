<?php
include 'script/endre-flyplass.php';
$id=$_GET["id"];
$sql="SELECT * FROM flyplass where id=$id;";
$res=mysqli_query($db,$sql) or die("Her skjedde det noe feil (form-endre-flyplass.php)");
$rad=hentarray($sql);
$navn=$rad["navn"];
$by=$rad["by"];
$land=$rad["land"];
$forkortelse=$rad["forkortelse"];
?>
  <div class="col-md-6">
    <div class="panel panel-default">
      <?php panelheader("Du endrer nå $navn");?>
        <form method="post">
          <div class="form-group">
            <?php inputtext('navn', NULL, $navn);?>
          </div>
          <div class="form-group">
            <?php inputtext('by', NULL, $by);?>
          </div>
          <div class="form-group">
            <?php inputtext('land', NULL, $land);?>
          </div>
          <div class="form-group">
            <?php inputtext('forkortelse', NULL, $forkortelse);?>
          </div>
          <div class="form-group">
            <input type="submit" value="Fortsett" name="endreflyplass" class="btn btn-success">
            <input type="reset" value="Tilbakestill" name="tilbakestill" class="btn btn-danger">
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
@$endreflyplass=$_POST["endreflyplass"];
if($endreflyplass)
{
  $navn=$_POST["navn"];
  $by=$_POST["by"];
  $land=$_POST["land"];
  $forkortelse=$_POST["forkortelse"];
  $sjekk=valider($_POST,4);
  if(!$navn||!$by||!$land||!$forkortelse)
  {
    echo feilet("Har du sjekket at alle felter er korrekt utfylt?");
  }
  else{
	if($sjekk === true){
		echo $sql="UPDATE christensen2.flyplass set navn='$navn', flyplass.by='$by', land='$land', forkortelse='$forkortelse' where id='$id';";
		$res=mysqli_query($db,$sql) or die("Spørringa funker ikke (linje 58, form)");
		echo sendmedjs("flyplass.php?endre=1");
	}
	else{
		echo tilbakemelding($sjekk,"danger");
	}
  }
}
?>
