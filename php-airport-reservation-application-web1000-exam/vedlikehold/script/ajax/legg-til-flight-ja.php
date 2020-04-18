	<div class="col-md-6">
		<?php selectrute();?>
	</div>
	<div class="col-md-6">
		<?php selectfly();?>
	</div>
	<div class="col-md-12">
	<div class="row">
		<div class="col-md-6">
			<?php plussminus("Antall uker denne planen gjelder", null, "antall");?>
		</div>
		<div class="col-md-6">
			<?php plussminus("Antall flyvninger per uke", null, "antallperuke",0,1);?>
		</div>
	</div>
	</div>
	<div class="col-md-12">
		<?php $dag = nestemandag(); echo tilbakemelding("Flyvningene vil gjelde fra neste uke (Mandag $dag)","info");?>
	</div>
</div>
<div id="antallflyvningerajax"><?php include'antallflyvningerajax.php';?></div>
<div class="col-md-12">
<fieldset>
	<input type="submit" class="btn btn-success" id="leggtilflightja" name="leggtilflightja" value="Fortsett">
	<input type="reset" class="btn btn-danger" value="Tilbakestill">
</fieldset>
</div>


