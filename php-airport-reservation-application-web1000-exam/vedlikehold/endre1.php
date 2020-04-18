<?php
include 'start.php';
@$fra=$_GET["fra"];
@$id=$_GET["id"];
if(!$fra && !$id){
	snu();
}
else{
	if($fra==="user"){
		include 'form/endre-user.php';
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
	else if($fra==="flight"){
		include 'form/endre-flight.php';
	}
	
	else if($fra==="passasjer"){
		include 'form/endre-passasjer.php';
	}
}
include 'slutt.php';
?>