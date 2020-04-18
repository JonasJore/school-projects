<?php
include 'start.php';
?>
<div class="jumbotron">
  <h1>Flyruter</h1>
  <p>Her ser du en oversikt over våre flyruter. Hver flyrute kan ha flere flyavganger. Trykk på ønsket rute for å se flyavganger!</p>
</div>
<div class="row">
	<div class="col-md-12">
	<div class="row">
		<div class="col-sm-4">
			<form class="input-group" method="get">
				<input type="text" class="form-control" id="filtrer" name="filtrer" placeholder="Filtrer" value="<?php echo @$filtrer;?>" onkeyup="flyavgangerajax(this.value)">
			</form>
		</div>
	</div></br>
  <div>
    <div>
    	<p>*Trykk på ønsket flyreise for å gå videre til bestilling</p>
    </div>
	<div id="flyavgangerajaxsvar"><?php include 'flyavgangerajax.php'?></div>
	</div>
</div>
<?php
include 'slutt.php';
?>
