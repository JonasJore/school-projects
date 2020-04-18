<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Her kan du legge til, endre, eller slette fly og flytyper</h3>
			<p>Når du legger til ett nytt fly er du nødt til å velge en flytype.</br>En flytype vil i bilværden være feks en Ford Focus, og ett fly vil være en Ford Focus med registreringsnummer XXXXX</p>
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
include 'script/legg-til-flytype.php';
include 'script/legg-til-fly.php';
echo"</div>";
echo"<div class='row'>";
include 'script/endre-flytype.php';
include 'script/endre-fly.php';
echo"</div>";
Include 'slutt.php';
 ?>
