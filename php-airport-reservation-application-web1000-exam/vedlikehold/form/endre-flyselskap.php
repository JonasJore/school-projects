<?php
include 'script/endre-flyselskap.php';
$id=$_GET["id"];
$sql="SELECT * FROM flyselskap where id=$id;";
$res=mysqli_query($db,$sql) or die("her skjedde det noe feil (form-endre-flyselskap.php)");
$rad=hentarray($sql);
$navn=$rad["navn"];
?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?php echo "<h4>Du endrer nå $navn</h4>";?>
      </div>
      <div class="panel-body">
        <form method="post">
          <div class="form-group">
            <?php inputtext('navn', NULL, $navn);?>
          </div>
          <div class="form-group">
            <input type="submit" value="Fortsett" name="endreflyselskap" class="btn btn-success">
            <input type="reset" value="Tilbakestill" name="tilbakestill" class="btn btn-danger">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
@$endreflyselskap=$_POST["endreflyselskap"];
if($endreflyselskap)
{
  $navn=$_POST["navn"];
  $valider["navn"]=$navn;
  if(!$navn)
  {
    echo feilet("Har du sjekket at alle felter er korrekt fylt ut?");
  }
  else
  {
    $sql="UPDATE christensen2.flyselskap set navn='$navn' where id='$id';";
    $res=mysqli_query($db,$sql) or die("spørringa funker ikke (form/endre-flyselskap.php)");
    echo sendmedjs("flyplass.php?endre=1");
  }
}
?>
