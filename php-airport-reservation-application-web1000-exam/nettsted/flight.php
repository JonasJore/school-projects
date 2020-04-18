<?php
include 'start.php';
@$avreisested=$_GET["av"];
@$ankomststed=$_GET["an"];
@$fradato=$_GET["fra"];
@$tildato=$_GET["til"];
@$antbillett=$_GET["ant"];
@$turretur=$_GET["turretur"];
if(!$turretur)
{
	$turretur="tur";
}
if(!$avreisested)
{
	$avreisested="%";
}
if(!$ankomststed)
{
	$ankomststed="%";
}
if(!$fradato)
{
	$fradato="";
}
if(!$tildato)
{
	$tildato="";
}
$vis=false;
if($avreisested !=="%" || $ankomststed !=="%" ){
	$vis=true;
}
?>
<legend>Flyavganger</legend>
<div class="panel panel-default">
	<?php panelheader("Ditt søk",$vis);?>
	<form class="form-group" method="post" onsubmit="return validerform()">
		<div class="row">
			<fieldset class="form-group">
				<div class="col-md-6">
					<div id="tilflyplassdependant">
					<?php selectfraflyplass($avreisested);?>
					</div>
				</div>
				<div class="col-md-6">
					<div id="fraflyplassdependant">
					<?php selecttilflyplass($ankomststed);?>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="row">
		<fieldset class="form-group">
			<div class="col-md-6">
			<label class="control-label">Type reise</label></br>
				<div class="btn-group" data-toggle="buttons">
					<label id="enkeltreise" class="btn btn-default <?php if($turretur==="tur"){echo "active";}?>">
						<input name="turretur"  type="radio" value="tur" <?php if($turretur==="tur"){echo "checked";}?>><span class="glyphicon glyphicon-share-alt"></span> Tur
					</label>
					<label id="tur-retur" class="btn btn-default <?php if($turretur==="retur"){echo "active";}?>">
						<input name="turretur"  type="radio" value="retur" <?php if($turretur==="retur"){echo "checked";}?>><span class="glyphicon glyphicon-retweet"></span> Tur/retur
					</label>
				</div>
			</div>
		</fieldset>
		</div>
		<div class="row">
		<fieldset class="form-group">
			<div class="col-md-6">
				<fieldset class="form-group" id="dato1f">
					<label class="control-label">Dato for avreise</label>
					<input class="form-control hentdatepicker" type="text" name="fradato" value="<?php echo $fradato;?>" id="dato1" onchange="valider(this.value,this.id)" autocomplete="off">
				</fieldset>
			</div>
			<div class="col-md-6" id="dato" <?php if($turretur==="tur"){?>style="display:none"<?php } ?>>
				<fieldset class="form-group" id="dato2f">
					<label class="control-label">Dato for hjemreise</label>
					<input class="form-control hentdatepicker" type="text" name="tildato" value="<?php echo $tildato;?>" id="dato2" onchange="valider(this.value,this.id)" autocomplete="off">
				</fieldset>
			</div>



		</fieldset>
		</div>
		<div class="row">
		<fieldset class="form-group">
			<div class="col-md-2">
				<?php plussminusmax10("Antall", null,"antall", $antbillett);?>
			</div>
			<div class="col-md-5" id="antallajax">
			</div>
		</fieldset>
		</div>
		<div class="row">
		<fieldset class="form-group">
			<div class="col-md-12">
				<input type="submit" class="btn btn-primary" name="endresok" id="endresok" value="Oppdater søket">
			</div>
		</fieldset>
		</div>
		</form>
		</div>
	</div>
<form method="post">
<?php if($avreisested =="%" && $ankomststed =="%"){
	echo tilbakemelding("<h3>Du må velge enten avreise eller ankomststed!</h3>", "danger");
}
else{
	echo"<div id='fraavgang'>";
	listfligths($avreisested,$ankomststed,"til", $fradato);
	echo "</div>";
	echo"<div id='tilavgang'>";
	if($turretur=="retur"){
		listfligths($ankomststed,$avreisested,"fra", $tildato);
	}
	echo "</div>";
	?><input type="submit" class="btn btn-primary" id="fortsett" name="kjopbilletter" value="Fortsett"><?php
}
?>

</form>
<?php
@$endresok=$_POST["endresok"];
if($endresok){
@$avreisested=$_GET["av"];
@$ankomststed=$_GET["an"];
@$fradato=$_GET["fra"];
@$tildato=$_GET["til"];
@$antbillett=$_GET["ant"];
	@$avreisestede=$_GET["av"];
	@$ankomststede=$_GET["an"];
	@$fradatopost=$_POST["fradato"];
	@$tildatopost=$_POST["tildato"];
	@$turretur=$_POST["turretur"];
	@$antbillette=$_GET["ant"];
	$fra=explode(";",$_POST["avgangflyplass"]);
	$til=explode(";",$_POST["ankomstflyplass"]);
	$antall=$_POST["antall"];
	$link="";
	if($fra[0]){
		$link .="&av=$fra[0]";
	}
	if($til[0]){
		$link .="&an=$til[0]";
	}
	if($antall){
		$link .="&ant=$antall";
	}
	if($fradatopost){
		$link .="&fra=$fradatopost";
	}
	if($turretur){
		$link .="&turretur=$turretur";
		if($turretur=="retur"){
			$link .="&til=$tildatopost";
		}
	}
	$variabler=substr($link,1);
	echo sendmedjs("flight.php?$variabler");
}
@$kjopbilletter=$_POST["kjopbilletter"];
if($kjopbilletter){
	$link="";
	@$fra=$_POST["til"];
	@$til=$_POST["fra"];
	$link="";
	if($antbillett){
		$link .="&a=$antbillett";
	}
	if($til){
		$link .="&til=$til";
	}
	if($fra){
		$link .="&fra=$fra";
	}
	$variabler=substr($link,1);
	if($fra && $antbillett){
		echo"<script>window.open('bestilling.php?$variabler', '_self')</script>";
	}
	else{
		echo "</br>";
		echo tilbakemelding("Ingen avgang valgt!","danger");
		
	}
}

include 'slutt.php';?>
