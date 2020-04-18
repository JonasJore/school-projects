<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Her kan du legge til, endre, eller slette administrator-kontoer</h3>
			<p>Siden alle passord er hashet så har du ikke muligheten til å se gammelt passord, men derimot heller kun sette ett nytt.</p>
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
include 'script/legg-til-user.php';
include 'script/endre-user.php';
Include 'slutt.php';
 ?>
