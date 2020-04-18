<div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="well">
			<form class="form-group" method="post" onsubmit="return validerform()">
				<div class="row">
					<fieldset class="form-group">
						<div class="col-md-6">
							<label class="control-label">Type reise</label></br>
							<div class="btn-group" data-toggle="buttons">
								<label id="enkeltreise" class="btn btn-default active">
									<input name="turretur" type="radio" value="tur" checked><span class="glyphicon glyphicon-share-alt"></span> Tur
								</label>
								<label id="tur-retur" class="btn btn-default">
									<input name="turretur"  type="radio" value="retur" ><span class="glyphicon glyphicon-retweet"></span> Tur/retur
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<?php plussminusmax10("Antall", null,"antall");?>
							<div id="antallajax"></div>
						</div>
					</fieldset>
				</div>
				<div class="row">
					<fieldset class="form-group">
						<div class="col-md-6">
							<?php selectfraflyplass();?>
						</div>
						<div class="col-md-6">
							<?php selecttilflyplass();?>
						</div>
					</fieldset>
						<div class="col-md-6">
							<fieldset class="form-group" id="dato1f">
								<label class="control-label">Avreise</label>
								<input class="form-control hentdatepicker" type="text" name="fradato" id="dato1" onchange="valider(this.value,this.id)" autocomplete="off">
							</fieldset>
						</div>
						<div class="col-md-6" id="dato" style="display:none;">
							<fieldset class="form-group" id="dato2f">
								<label class="control-label">Hjemreise</label>
								<input class="form-control hentdatepicker" type="text" name="tildato" id="dato2" onchange="valider(this.value,this.id)" autocomplete="off">
							</fieldset>
						</div>
					</fieldset>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="ladda-button" data-style="slide-left" data-color="blue" name="sok" id="sok" value="finn biletter">
							<span class="ladda-label">Finn biletter</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<div class="col-md-6">
			<h4 class="text-center">Smaken av Sentral-Europa</h4>
			<img class="img-responsive img-rounded" src="bilder/london.jpg" alt="Venice">
		</div>
	</div>
</div>
<?php
@$sok=$_POST["sok"];
if($sok){
	@$fradatopost=$_POST["fradato"];
	@$tildatopost=$_POST["tildato"];
	@$turretur=$_POST["turretur"];
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
	if($turretur=="retur"){
		if($tildatopost){
			$link .="&til=$tildatopost";
		}
	}
	if($turretur){
		$link .="&turretur=$turretur";
	}
	$variabler=substr($link,1);
	echo sendmedjs("flight.php?$variabler");
}
?>
