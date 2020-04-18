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
<!-- LEGG TIL ADMINISTRATOR -->
<div class="col-md-12">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Legg til flight(s)");?>
					<div class="col-md-12">
						<fieldset class="form-group">
						<label class="control-label">Gjentagende</label></br>
							<div class="btn-group" data-toggle="buttons">
								<label id="enkeltreise" class="btn btn-default active" onclick="leggtilflightajax('nei')" >
									<input name="gjentagende"  type="radio" value="nei" checked>Nei
								</label>
								<label id="tur-retur" class="btn btn-default" onclick="leggtilflightajax('ja')">
									<input name="gjentagende"  type="radio" value="ja">Ja
								</label>
							</div>
						</fieldset>
					</div>
					<div id="leggtilflightajaxsvar">
						<?php include 'script/legg-til-flightajax.php';?>
					</div>
		</div>
</div>
<?php
@$leggtilflightnei=$_POST["leggtilflightnei"];
@$leggtilflightja=$_POST["leggtilflightja"];
if($leggtilflightnei){
	$rute=$_POST["rute"];
	$fly=$_POST["fly"];
	$avgangdatofrapost=$_POST["avgangdato"];
	$avgangklokkeslett=$_POST["avgangklokkeslett"];
	$flytid=$_POST["flytid"];
	$pris=$_POST["flybillettpris"];
	$avgangtidforsplit = date('H:i d.m.Y',strtotime($avgangdatofrapost . " " . $avgangklokkeslett));
	$ankomstforsplit = date('H:i d.m.Y',strtotime('+'. $flytid.' minutes',strtotime($avgangtidforsplit)));
	$avngangtidsplit=explode(" ", $avgangtidforsplit);
	$ankomsttidsplit=explode(" ", $ankomstforsplit);
	$avgangtid=$avngangtidsplit[0] . ":00";;
	$avgangdato=date('Y-m-d',strtotime($avngangtidsplit[1]));
	$ankomsttid=$ankomsttidsplit[0] . ":00";
	$ankomstdato=date('Y-m-d',strtotime($ankomsttidsplit[1]));
	$valider["dato"]=$avgangdatofrapost;
	$valider["klokkeslett"]=$avgangklokkeslett;
	$valider["flytid"]=$flytid;
	$valider["pris"]=$pris;
	$validerer=valider($valider);
	if($rute && $fly && $avgangdatofrapost && $avgangklokkeslett && $flytid && $pris)
	{
		if($validerer===true){
			$sql="INSERT INTO `christensen2`.`flight` (`avgang_tid`, `ankomst_tid`, `avgang_dato`, `ankomst_dato`, `pris`, `fly_id`, `rute_id`) VALUES ('$avgangtid', '$ankomsttid', '$avgangdato', '$ankomstdato', '$pris', '$fly', '$rute');";
			mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
			echo registrert("<strong>Flighten ble registrert.</strong>");					
		}
		else{
			echo feilet("$validerer");
		}
	}
	else{
		echo feilet("Alle felt må fylles ut.");
	}
}
if(@$leggtilflightja){
	$teller=0;
	@$antalluker=$_POST["antall"];
	for($r=1;$r<=$antalluker;$r++){
		$antall=$_POST["antallperuke"];
		for($r1=1;$r1<=$antall;$r1++){
			@$rute=$_POST["rute"];
			@$fly=$_POST["fly"];
			@$flytid=$_POST["flytid$r1"];
			@$pris=$_POST["billettpris$r1"];
			@$dag=$_POST["dag$r1"];
			@$avgang=$_POST["avgang$r1"];
			if($rute && $fly && $flytid && $pris && $dag && $avgang){
				$teller=$teller +1;
				$dato=strtotime('+ '. $r .' weeks '. $dag. ' ' .  $avgang);
				$avgangtidforsplit = date('H:i d.m.Y',$dato);
				$ankomstforsplit = date('H:i d.m.Y',strtotime('+'. $flytid.' minutes',strtotime($avgangtidforsplit)));
				$avngangtidsplit=explode(" ", $avgangtidforsplit);
				$ankomsttidsplit=explode(" ", $ankomstforsplit);
				$avgangtid=$avngangtidsplit[0] . ":00";;
				$avgangdato=date('Y-m-d',strtotime($avngangtidsplit[1]));
				$ankomsttid=$ankomsttidsplit[0] . ":00";
				$ankomstdato=date('Y-m-d',strtotime($ankomsttidsplit[1]));
				$sql="INSERT INTO `christensen2`.`flight` (`avgang_tid`, `ankomst_tid`, `avgang_dato`, `ankomst_dato`, `pris`, `fly_id`, `rute_id`) VALUES
				('$avgangtid', '$ankomsttid', '$avgangdato', '$ankomstdato', '$pris', '$fly', '$rute');";
				mysqli_query($db,$sql) or die("Feil");
				$registrert=true;
			}
			else{
				$registrert=false;
			}
		}
	}
	if(@$registrert===true){
		echo registrert("$teller flights ble registrert på valgt rute.");
	}
	else{
		echo feilet("Alle felt må fylles ut.");
	}
}
?>
	</form>
</div>
