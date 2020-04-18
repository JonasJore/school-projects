<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Dette er billetter registrert på valgt referansenummer</h3>
			<p>Du kan endre passasjerinformasjon per billett.</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
	<?php if(isset($_GET["slettet"])){
		echo tilbakemelding("Sletting gjennomført!", "success");
	}?>
	<?php if(isset($_GET["endret"])){
		echo tilbakemelding("Endring gjennomført!", "success");
	}?>
	</div>
</div>


<?php
include 'script/endre-billett.php';
Include 'slutt.php';
 ?>
