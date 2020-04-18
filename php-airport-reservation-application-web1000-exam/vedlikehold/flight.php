<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Her kan du legge til, endre, eller slette flyruter og flyavganger, eller "flights" som vi kaller det</h3>
			<p>Vi har også laget en funksjon som gjør det lett å legge inn en rekke med flyavganger i en valgt rute. Dette fordi vi så behovet for en slik løsning da en flyavgang svært sjeldent ikke er gjentagende.</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
	<?php if(isset($_GET["slettet"])){
		echo tilbakemelding("Sletting gjennomført!", "success");
	}?>
	<?php if(isset($_GET["endret"])){
		echo tilbakemelding("Endringen er gjennomført!", "success");
	}?>
	</div>
</div>



<?php
echo"<div class='row'>";
include 'script/legg-til-rute.php';
include 'script/legg-til-flight.php';
echo "</div>";
echo"<div class='row'>";
include 'script/endre-rute.php';
include 'script/endre-flight.php';
echo "</div>";
Include 'slutt.php';



 ?>
