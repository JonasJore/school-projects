<div class="col-md-6">
	<?php selectrute();?>
</div>
<div class="col-md-6">
	<?php selectfly();?>
</div>
<div class="col-md-12">
	<div class="row">
		<fieldset>
			<div class="col-md-6">
				<fieldset class="form-group" id="datof">
					<label class="control-label">Avgang dato</label>
					<input class="form-control hentdatepicker" type="text" name="avgangdato" id="dato" onchange="valider(this.value,this.id)" required>
					<span id="datos"></span>
				</fieldset>
			</div>
			<div class="col-md-6">
				<fieldset class="form-group" id="klokkeslettf">
					<label class="control-label">Avgang klokkeslett</label>
					<input class="form-control" type="time" name="avgangklokkeslett" id="klokkeslett" onkeyup="valider(this.value,this.id)" required>
					<span id="klokkesletts"></span>
				</fieldset>
			</div>
		</fieldset>
	</div>
</div>
<div class="col-md-6">
	<?php inputtext("flytid", "Flytid i minutter");?>
</div>
<div class="col-md-6">
	<?php inputtext("flybillettpris", "Pris");?>
</div>
<div class="col-md-12">
<fieldset>
	<input type="submit" class="btn btn-success" id="leggtilflightnei" name="leggtilflightnei" value="Fortsett">
	<input type="reset" class="btn btn-danger" value="Tilbakestill">
</fieldset>
</div>