<?php
include 'start.php';
?>
<div class="jumbotron">
  <h1>Din reise</h1>
  <p>Skriv inn ditt referansenummer for å gjøre endringer eller avbestille din booking!</p>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form method="get">
					<input type="text" class="form-control" id="referansenummer" name="referansenummer" placeholder="Referansenummer" value="<?php getreferansenummer();?>" onkeyup="minbookingajax(this.value)">
				</form>
			</div>
      </div>
		</div></br>
	</div>
</div>
<?php
@$ref=$_GET["referansenummer"];
if($ref){
	?>
	<script>
	var foresporsel=new XMLHttpRequest();
	foresporsel.onreadystatechange=function(){
		if (foresporsel.readyState==4 && foresporsel.status==200){
			document.getElementById("referansenummerajax").innerHTML=foresporsel.responseText;
		}
	}
	foresporsel.open("GET","minbookingajax.php?referansenummer="+ "<?php echo $ref;?>");
	foresporsel.send();
	
	</script>
	<?php
}
?>

	<div id="referansenummerajax">
	</div>
<?php
include 'slutt.php';
?>
