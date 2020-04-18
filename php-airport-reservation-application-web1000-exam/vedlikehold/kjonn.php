<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Her kan du legge til, endre, eller slette kjønn</h3>
			<p>Du tenker kanskje at kjønn ikke bør være dynamisk?</br>
			Grunnen til at det er dynamisk er fordi flyselskap oppererer med Fr. og Ms., med Herr og Fru mens andre bruker Mann og Kvinne.</br>
			Skal vi tenke fremtidig vil det kanskje på sikt være nødvendig for "annet"?
			</p>
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
include 'script/legg-til-kjonn.php';
include 'script/endre-kjonn.php';
Include 'slutt.php';
 ?>
