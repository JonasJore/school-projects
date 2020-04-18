<?php
$dbink = 'dbtilkobling.php';
$funksjonerink = 'funksjoner.php';
$dbinkfinnes=false;
$funksjonerinkfinnes=false;
$customjs=false;
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
	include "../." . $dbink;
}
if($funksjonerinkfinnes===false)
{
	include "../." . $funksjonerink;
}

?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Finn din reise</h2><br/>
          </div>
          <div class="padding"  style="padding-left: 10%; padding-right: 10%; padding-top:5%;">
            <div class="col-md-6 col-md-offset-3">
              <a href="#" id="tur-retur" class="btn btn-sm btn-info">Tur-retur <span class="glyphicon glyphicon-retweet"></span></a>
              <a href="#" id="enkeltreise" class="btn btn-sm btn-info">Enkeltreise <span class="glyphicon glyphicon-share-alt"></span></a><br/><br/>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
              avreisested<br/>
              <select class="form-control input-md" name="avreisested" id="avreisested">
              	<option value="">Velg avreisested</option>
                <?php include("script/flyplasseravreise.php");?>
              </select>
            </div>
            <div class="col-md-6">
              ankomststed<br/>
              <select class="form-control input-md" name="ankomststed" id="ankomststed">
                <option>Velg avreisested først</option>
              </select>
            </div>
          </div>
        <div class="form-group row">
          <div class="col-md-6">
            Dato for avreise<br/>
            <input class="form-control" type="text" name="fradato" id="fradato" readonly>
			</div>
			<div class="col-md-6" id="dato2">
          Dato for hjemreise<br/>
          <input class="form-control" type="text" name="tildato" id="tildato" readonly>
        </div>
        <div class="form-group row">
          <div class="col-md-6 col-md-offset-3">
          Velg antall flybilletter<br/>
          </form>
          <?php plussminus("Antall", 0, "ant"); ?>
          </div>
        </div>
            <div class="form-group row">
              <div class="col-md-6  col-md-offset-3">
              <input type="submit" name="fortsettKnapp" class="btn btn-lg btn-success btn-block">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
@$fortsettKnapp=$_POST["fortsettKnapp"];
if($fortsettKnapp)
{
  @$antbillett=$_POST["ant"];
  @$avreisested=$_POST["avreisested"];
  @$ankomststed=$_POST["ankomststed"];
  @$fradato=$_POST["fradato"];
  @$tildato=$_POST["tildato"];

  echo "<script>window.open('flight.php?av=$avreisested&an=$ankomststed&fra=$fradato&til=$tildato&ant=$antbillett', '_self')</script>";
}
?>
