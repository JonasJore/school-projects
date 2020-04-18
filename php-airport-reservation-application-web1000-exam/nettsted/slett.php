<?php
include '../vedlikehold/script/funksjoner.php';
include 'script/dbtilkobling.php';
@$fra=$_GET["fra"];
@$passasjerID=$_GET["passasjerID"];
@$billett=$_GET["billett"];
if($fra === "min-booking" && $passasjerID && $billett)
{
	@$id=hentid("select booking_id as id from billett WHERE `billettnummer`='$billett';");
	@$antall=antall("select * from billett where booking_id=$id;");
	if($antall===1)
	{
		kjor("DELETE FROM `christensen2`.`billett` WHERE `billettnummer`='$billett';");
		kjor("DELETE FROM `christensen2`.`passasjer` WHERE `id`='$passasjerID';");
		kjor("DELETE FROM `christensen2`.`booking` WHERE `id`='$id';");
		snu();
		
	}
	else if($antall>1){
		kjor("DELETE FROM `christensen2`.`billett` WHERE `billettnummer`='$billett';");
		kjor("DELETE FROM `christensen2`.`passasjer` WHERE `id`='$passasjerID';");
		snu();
	}
}
else{
	snu();
}

?>