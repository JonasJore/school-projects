<?php
include 'start.php';
 ?>
<legend align="center">Hvordan syntes du det var å bestille flybilett hos oss? Gi gjerne ris eller ros.</legend>
 <div class="container-fluid">
<div class="row-fluid" >
  <div class="col-md-offset-4 col-md-4" id="box">
          <p>Hvem bilettholder sender tilbakemeldingen?</p>
         <hr>
             <form class="form-horizontal" action=" " method="" id="contact_form">
                 <fieldset>
                   <div class="form-group">
  <label class="col-md-4 control-label" for="radios">bilettholder:</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios-0">
      <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
      Navn1
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="2">
      Navn2
    </label>
	</div>
  </div>
</div>
 <div class="form-group">
     <div class="col-md-12">
         <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
             <input name="first_name" placeholder="Navnet til eier av refferanse kommer her" class="form-control" type="text">
         </div>
     </div>
 </div>
 <div class="form-group">
     <div class="col-md-12 inputGroupContainer">
         <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
             <textarea class="form-control" name="comment" placeholder="Din vurdering av oss (maks 130 tegn)"></textarea>
         </div>
     </div>
 </div>
 <div class="form-group">

     <div class="col-md-12">
       <p style="color:#C6C6C6"><i>*Tilbakemelding er valgfritt, men er til stor hjelp for oss som produktutviklere.</i></p>
         <button type="submit" class="btn btn-warning pull-right">Send <span class="glyphicon glyphicon-send"></span></button>
     </div>
 </div>

</fieldset>
</form>
</div>
</div>

<?php
include 'slutt.php';
?>
