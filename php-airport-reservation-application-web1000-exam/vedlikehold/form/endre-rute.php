<?php
  $sql="SELECT * FROM rute WHERE id=$ruteID;";
  $res=mysqli_query($db,$sql) or die("Her skjedde det noe feil (endre rute)");
  $hent=hentarray($sql);
  $beskrivelse=$hent["beskrivelse"];
  $navn=$hent["navn"];
?>
<div class="col-md-6">
	<div class="panel panel-default">
	<?php panelheader("Du endrer nå rute: $navn");?>
          <form method="post">
            <div class='form-group'>
              <?php inputtext('beskrivelse', NULL, $beskrivelse);?>
            </div>
            <div class='form-group'>
             <input type="submit" value="Fortsett" name="endrerute" class="btn btn-success">
             <input type="reset" value="Tilbakestill" name="tilbakestill" class="btn btn-danger">
            </div>
           </form>
         </div>
     </div>
</div>
<?php

@$endrerute=$_POST["endrerute"];
if($endrerute){
  $beskrivelse=$_POST["beskrivelse"];
  if(!$beskrivelse)
  {
    echo feilet("Feltet kan ikke stå tomt. Da blir det fort full forvirring!");
  }
  else{
    $sql="UPDATE rute set beskrivelse='$beskrivelse' where id='$ruteID';";
    $res=mysqli_query($db,$sql) or die("kunne ikke endre rute (sql 2)");
    echo sendmedjs("flight.php?endret=1");
  }
}
