<?php
@$antallperuke=$_GET["antallperuke"];
if(!$antallperuke)
{
	$antallperuke=1;
}
for($r=1;$r<=$antallperuke;$r++)
{
	?>
<div class="col-md-12">
	<div class="well">
	<h4>Flyvning <?php echo $r?></h4>
		<div class="row">
			<div class="col-md-12">
			<fieldset class="form-group">
				<label class="control-label">Avreise dag</label></br>
				<div class="btn-group" data-toggle="buttons">
					<label id="enkeltreise" class="btn btn-default ">
						<input name="dag<?php echo $r?>"  type="radio" value="monday" >Mandag
					</label>
					<label id="tur-retur" class="btn btn-default ">
						<input name="dag<?php echo $r?>"  type="radio" value="tuesday" >Tirsdag
					</label>
					<label id="enkeltreise" class="btn btn-default ">
						<input name="dag<?php echo $r?>"  type="radio" value="wednesday" >Onsdag
					</label>
					<label id="tur-retur" class="btn btn-default ">
						<input name="dag<?php echo $r?>"  type="radio" value="thursday" >Torsdag
					</label>
					<label id="enkeltreise" class="btn btn-default ">
						<input name="dag<?php echo $r?>"  type="radio" value="friday" >Fredag
					</label>
					<label id="tur-retur" class="btn btn-default ">
						<input name="dag<?php echo $r?>"  type="radio" value="saturday" >Lørdag
						</label>
					<label id="enkeltreise" class="btn btn-default ">
						<input name="dag<?php echo $r?>"  type="radio" value="sunday" >Søndag
					</label>
				</div>
			</fieldset>
			</div>
			<div class="col-md-12">
				<fieldset class="form-group" id="klokkeslettf<?php echo $r?>">
					<label class="control-label">Avgang klokkeslett</label>
					<input class="form-control" type="time" name="avgang<?php echo $r?>" id="klokkeslett" onkeyup="valider(this.value,this.id,<?php echo $r?>)" required>
					<span id="klokkesletts<?php echo $r?>"></span>
				</fieldset>
				<fieldset class="form-group" id="flytidf<?php echo $r?>">
					<label class="control-label">Flytid i minutter</label>
					<input class="form-control" type="text" name="flytid<?php echo $r?>" id="flytid" onkeyup="valider(this.value,this.id,<?php echo $r?>)" required>
					<span id="flytids<?php echo $r?>"></span>
				</fieldset>
			</div>
			<div class="col-md-6">
				<fieldset class="form-group" id="billettprisf<?php echo $r?>">
					<label class="control-label">Pris</label>
					<input class="form-control" type="text" name="billettpris<?php echo $r?>" id="billettpris" onkeyup="valider(this.value,this.id,<?php echo $r?>)" required>
					<span id="billettpriss<?php echo $r?>"></span>
				</fieldset>
			</div>
		</div>
	</div>
</div>
<?php
}
?>