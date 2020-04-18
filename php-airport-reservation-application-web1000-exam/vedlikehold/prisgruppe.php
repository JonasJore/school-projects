<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Her kan du legge til, endre, eller prisgrupper</h3>
			<p>Dersom Bjarum Airlines noen gang vil kjøre kampanjer med prosentavslag i pris på alle billetter som en del av sin markedsføring i oppstartsfasen vil man kunne legge til en prisgruppe med prisavslag her.</br>
			Det er også mulig å legge til feks: Voksen, ungdom, student, spedbarn, barn osv.</br>
			Beskrivelsen vil være regler for gjeldende prisgruppe. Feks for ungdom er: Alder mellom 12 og 22 år.
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
include 'script/legg-til-prisgruppe.php';
include 'script/endre-prisgruppe.php';
Include 'slutt.php';
 ?>
