<?php
$sql="select * from $fra where id=$id;";
$svar=mysqli_query($db,$sql) or die("får ikke hentet informasjon fra id $id");
$rad=mysqli_fetch_array($svar);
$avgangtid=$rad["avgang_tid"];
$ankomsttid=$rad["ankomst_tid"];
$avgangdato=$rad["avgang_dato"];
$ankomstdato=$rad["ankomst_dato"];
$avgangprint=date('d.m.Y',strtotime($avgangdato));
$avgangtidprint=date('H:i',strtotime($avgangtid));
$ankomst=date('d.m.Y H:i:s', strtotime($ankomstdato . " " . $ankomsttid));
$avgang=date('d.m.Y H:i:s', strtotime($avgangdato . " " . $avgangtid));
$avgangtimestamp=date($avgang);
$ankomsttimestamp=date($ankomst);
$forskjell=abs(strtotime($ankomsttimestamp) - strtotime($avgangtimestamp))/60;
$pris=$rad["pris"];
$fly=$rad["fly_id"];
$rute=$rad["rute_id"];
?>
<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Endre flight");?>
					<div class="col-md-6">
						<?php selectrute($rute);?>
					</div>
					<div class="col-md-6">
						<?php selectfly(null,$fly);?>
					</div>
					<div class="col-md-12">
						<div class="row">
							<fieldset class="form-group" id="datotimef">
								<div class="col-md-6">
									<label class="control-label">Avgang dato</label>
									<input class="form-control hentdatepicker" type="text" id="datoflight" name="avgangdato" value="<?php echo $avgangprint?>" onchange="valider(this.value,this.id)">
								</div>
								<div class="col-md-6">
									<label class="control-label">Avgang klokkeslett</label>
									<input class="form-control" type="time" id="klokkeslettflight" name="avgangklokkeslett" value="<?php echo $avgangtidprint?>" onchange="valider(this.value,this.id)">
								</div>
							</fieldset>
						</div>
					</div>
					<div class="col-md-6">
						<?php inputtext("flytid", "Flytid i minutter",$forskjell);?>
					</div>
					<div class="col-md-6">
						<?php inputtext("flybillettpris", "Pris",$pris);?>
					</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="endreflight" name="endreflight" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>	
			</div>
		</div>
		<?php
		@$endreflight=$_POST["endreflight"];
		if($endreflight){
			$sjekk=valider($_POST,4);
			if($sjekk===true){
				$rute=$_POST["rute"];
				$fly=$_POST["fly"];
				$avgangdato=$_POST["avgangdato"];
				$avgangklokkeslett=$_POST["avgangklokkeslett"];
				$flytid=$_POST["flytid"];
				$flybillettpris=$_POST["flybillettpris"];
				
				$avgangtidforsplit = date('H:i d.m.Y',strtotime($avgangdato . " " . $avgangklokkeslett));
				$ankomstforsplit = date('H:i d.m.Y',strtotime('+'. $flytid.' minutes',strtotime($avgangtidforsplit)));
				$avngangtidsplit=explode(" ", $avgangtidforsplit);
				$ankomsttidsplit=explode(" ", $ankomstforsplit);
				$avgangtid=$avngangtidsplit[0] . ":00";;
				$avgangdato=date('Y-m-d',strtotime($avngangtidsplit[1]));
				$ankomsttid=$ankomsttidsplit[0] . ":00";
				$ankomstdato=date('Y-m-d',strtotime($ankomsttidsplit[1]));
				
				echo $sql="UPDATE `christensen2`.`flight` SET `avgang_tid`='$avgangtid', `ankomst_tid`='$ankomsttid', `avgang_dato`='$avgangdato', 
				`ankomst_dato`='$ankomstdato', `pris`='$flybillettpris', `fly_id`='$fly', `rute_id`='$rute' WHERE `id`='$id';";
				mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
				echo sendmedjs("$fra.php?endret=1");
			}
			else{
				echo tilbakemelding($sjekk,"danger");
			}
		}
		?>
	</form>
</div>
