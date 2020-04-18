<?php
include("start.php");
@$fra=$_GET["fra"];
@$id=$_GET["id"];
@$nid=$_GET["id"];
@$ruteID=$_GET["id"];
if(!$fra && !$id){
  snu();
}
else{
  if($fra==="user"){
    include 'form/endre-user.php';
  }
  else if($fra==="nasjonalitet"){
    include("form/endre-nasjonalitet.php");
  }
  else if($fra==="rute"){
    include("form/endre-rute.php");
  }
  else if($fra==="kjonn"){
    include 'form/endre-kjonn.php';
  }
  else if($fra==="prisgruppe"){
    include 'form/endre-prisgruppe.php';
  }
  else if($fra==="flytype"){
    include 'form/endre-flytype.php';
  }
  else if($fra==="fly"){
    include 'form/endre-fly.php';
  }
  else if($fra==="passasjer"){
	include 'form/endre-passasjer.php';
	}
  else if($fra==="flyplass"){
  include 'form/endre-flyplass.php';
  }
  else if($fra==="flyselskap"){
  include 'form/endre-flyselskap.php';
  }
}
include 'slutt.php';
?>
