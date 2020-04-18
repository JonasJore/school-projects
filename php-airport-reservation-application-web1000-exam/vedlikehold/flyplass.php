<?php
include("start.php");?>
<div class="row">
  <div class="col-md-6 col-md-offset-2">
    <div class="well">
      <h4>På denne siden kan du legge til, endre, eller slette flyplasser</h4>
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
echo "<div class='row'>";
include 'script/legg-til-flyplass.php';
include 'script/endre-flyplass.php';
echo "</div>";
include 'slutt.php';
?>
