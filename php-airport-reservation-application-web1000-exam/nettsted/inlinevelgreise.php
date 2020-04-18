<!DOCTYPE html>
<head>
  <meta charset='utf-8'>
  <script src='script/kalender.js'></script>
  <script src='datepicker/js/datepicker.js'></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="datepicker/css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
  <div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
          </div>
          <form method="post"><br/>
              <select  name="avreisested" id="avreisested">
              	<option value="">Velg avreisested</option>
                <?php include("script/flyplasseravreise.php"); ?>
              </select><input type="text" name="fradato" id="fradato" readonly><br/>
              <select name="ankomststed" id="ankomststed">
                <option>Velg avreisested først</option>
              </select><input type="text" name="tildato" id="tildato" readonly>
              Velg antall flybilletter<select name="antbillett">
                <?php include("script/listeboksantall.php");?>
              </select> <input class="btn btn-success btn-sm"< type="submit" name="fortsettKnapp">
              </form>
            </div>
          </div>
        </div>
</body>
<?php include('slutt.php');?>
<?php
@$fortsettKnapp=$_POST["fortsettKnapp"];
if($fortsettKnapp)
{
  $antbillett=$_POST["antbillett"];
  @$avreisested=$_POST["avreisested"];
  @$ankomststed=$_POST["ankomststed"];
  @$fradato=$_POST["fradato"];
  @$tildato=$_POST["tildato"];
  //return valider_dato($fradato, $tildato);
  echo "<script>window.open('velg-flyreise-del2.php?av=$avreisested&an=$ankomststed&fra=$fradato&til=$tildato&ant=$antbillett', '_self')</script>";
}
?>
