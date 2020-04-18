<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Her kan du legge til, endre, eller slette nasjonaliteter</h3>
			<p>Valget av nasjon er bla. med på å bestemme landskoden(retningsnummer), som i Norge er +47.</p>
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
include 'script/legg-til-nasjonalitet.php';
include 'script/endre-nasjonalitet.php';
Include 'slutt.php';
 ?>
