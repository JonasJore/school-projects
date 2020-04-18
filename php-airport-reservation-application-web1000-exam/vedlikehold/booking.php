<?php
include 'start.php'; ?>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<div class="well">
			<h3>Her kan du legge til og endre bookinger</h3>
			<p>Dersom du sletter en booking(referansenummer) slettes også alle tilhørende billetter og passasjerer.</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
	<?php if(isset($_GET["slettet"])){
		echo tilbakemelding("Sletting gjennomført!", "success");
	}?>
	<?php if(isset($_GET["endret"])){
		$endret=$_GET["endret"];
		echo tilbakemelding("Booking vellykket!</br>Referansenummer er <strong>$endret</strong>", "success");
	}?>
	</div>
</div>





<?php
include 'script/legg-til-booking.php';
include 'script/endre-booking.php';
Include 'slutt.php';
 ?>
