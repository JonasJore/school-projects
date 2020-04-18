<?php
include 'start.php';?>
<div class="row">
  <div class="col-md-6 col-md-offset-2">
    <div class="well">
      <h4>Her kan du legge til, endre eller slette flyselskaper.</h4>
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
include 'script/legg-til-flyselskap.php';
echo '</div>';
echo "<div class='row'>";
include 'script/endre-flyselskap.php';
echo '</div>';
include 'slutt.php';
?>
