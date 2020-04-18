<?php
include 'start.php';
@$til=$_GET["av"];
@$fra=$_GET["an"];
@$fradato=$_GET["fra"];
@$antall=$_GET["ant"];
if(isset($fra)){
	$sql="select * from flyplass where id=$fra;";
	$svar=mysqli_query($db,$sql);
	$rad=mysqli_fetch_array($svar);
	$franavn=$rad["navn"];
	$fraby=$rad["by"];
	$fraland=$rad["land"];
	$fraforkortelse=$rad["forkortelse"];
	$frainfo="$franavn, $fraby ($fraforkortelse), $fraland";
}
if(isset($til)){
	$sql="select * from flyplass where id=$til;";
	$svar=mysqli_query($db,$sql);
	$rad=mysqli_fetch_array($svar);
	$tilnavn=$rad["navn"];
	$tilby=$rad["by"];
	$tilland=$rad["land"];
	$tilforkortelse=$rad["forkortelse"];
	$tilinfo="$tilnavn, $tilby ($tilforkortelse), $tilland";
}
$vis=false;
if($fra && $til && $fradato && $antall){
	$vis=true;
}
?>
<div class="row">
	<div class="col-md-6">
	<form method="post" onsubmit="return validerform()">
		<div class='panel panel-default'>
				<?php panelheader("Oppdater booking-informasjon",$vis);?>
					<div class="col-md-6">
							<?php selectfraflyplass1();?>
					</div>
					<div class="col-md-6">
						<div id="selecttilflyplass1">
							<?php selecttilflyplass1();?>
						</div>
					</div>
					<div class="col-md-6">
						<?php plussminusmax10("Antall billetter",null,"antallbilletter");?>
					</div>
					<div class="col-md-6">
							<fieldset class="form-group" id="dato1uavhengigf">
								<label class="control-label">Avreise</label>
								<input class="form-control hentdatepicker" type="text" name="fradato" id="dato1uavhengig" onchange="valider(this.value,this.id)" autocomplete="off">
							</fieldset>
						</div>
					<div class="col-md-12">
					<fieldset>
						<input type="submit" class="btn btn-success" id="dobooking" name="dobooking" value="Fortsett">
						<input type="reset" class="btn btn-danger" value="Tilbakestill">
					</fieldset>
					</div>
					
			</div>
		</div>
		<?php
		@$dobooking=$_POST["dobooking"];
		if($dobooking){
			$frapost=$_POST["fra"];
			$tilpost=$_POST["til"];
			$fradatopost=$_POST["fradato"];
			$antallpost=$_POST["antallbilletter"];
			if($frapost && $tilpost && $fradatopost && $antallpost){
				echo sendmedjs("booking2.php?av=$frapost&an=$tilpost&fra=$fradatopost&ant=$antallpost");
			}
			else{
				$tilbakemelding=true;
			}
		}
		if(@$tilbakemelding===true){
			echo"<script>window.open('booking2.php?tilbakemelding=1', '_self')</script>";
		}
		@$gettilbakemelding=$_GET["tilbakemelding"];
		if($gettilbakemelding){
			echo "<div class='col-md-12'>";
			echo  tilbakemelding("Ingen avgang valgt!","danger");
			echo "</div>";
		}
		?>
	</form>
</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-2">
	<?php if(isset($_GET["slettet"])){
		echo tilbakemelding("Sletting gjennomført!", "success");
	}?>
	</div>
</div>
<form method="post">
<?php
	
	if($fra && $til && $fradato && $antall){
		echo"<div id='fraavgang'>";
		listfligths($fra,$til,"til",$fradato);
		echo "</div>";
		?><input type="submit" class="btn btn-primary" id="fortsett" name="kjopbilletter" value="Fortsett"><?php
	}
	?>
</form>
<?php
@$kjopbilletter=$_POST["kjopbilletter"];
if($kjopbilletter){
	$link="";
	@$fra=$_POST["til"];
	if($antall){
		$link .="&a=$antall";
	}
	if($fra){
		$link .="&fra=$fra";
	}
	$variabler=substr($link,1);
	if($fra && $antall){
		echo"<script>window.open('booking3.php?$variabler', '_self')</script>";
	}
	else{
		tilbakemelding("Ingen avgang valgt!","danger");
	}
}
include 'slutt.php';
?>
<script>
$(document).ready(function () {
	$('table').DataTable( {
		"dom": '<"top"l>t<"bottom"ip><"clear">',
		"language": {
			"sEmptyTable": "Ingen data tilgjengelig i tabellen",
			"sInfo": "Viser _START_ til _END_ av _TOTAL_ linjer",
			"sInfoEmpty": "Viser 0 til 0 av 0 linjer",
			"sInfoFiltered": "(filtrert fra _MAX_ totalt antall linjer)",
			"sInfoPostFix": "",
			"sInfoThousands": " ",
			"sLoadingRecords": "Laster...",
			"sLengthMenu": "Vis _MENU_ linjer",
			"sLoadingRecords": "Laster...",
			"sProcessing": "Laster...",
			"sSearch": "S&oslash;k:",
			"sUrl": "",
			"sZeroRecords": "Ingen linjer matcher s&oslash;ket",
			"oPaginate": {
				"sFirst": "F&oslash;rste",
				"sPrevious": "Forrige",
				"sNext": "Neste",
				"sLast": "Siste"
			},
			"oAria": {
				"sSortAscending": ": aktiver for Ã¥ sortere kolonnen stigende",
				"sSortDescending": ": aktiver for Ã¥ sortere kolonnen synkende"
			}
		}
	} );
} );
</script>

