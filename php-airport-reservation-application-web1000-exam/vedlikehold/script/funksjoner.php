<?php
// Haser passord
function pwhash ($passord){
	$passordhash=password_hash($passord, PASSWORD_BCRYPT);
	return $passordhash;
}
function sendmedjs($link)
{
	return"<script>window.open('$link', '_self')</script>";
}
function nestemandag(){
	$dato=strtotime('next week Monday');
	$maaned=array("","Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember");
	$mndnr=date("n", $dato);
	$dag=date("d", $dato);
	$mndnavn=$maaned[$mndnr];
	return $dag . ". " . $mndnavn;
}
//Printer brukernavn fra $_SESSION, med stor forbokstav
function printbrukernavn(){
	$brukernavn=$_SESSION["brukernavn"];
	$print=ucfirst(strtolower($brukernavn));
	return $print;
}
// Printer "duvar sist logget inn" via session
function sidensist(){
	@$login=$_SESSION["sidensist"];
	if($login)
	{
		$aar=substr($login,0,4);
		$dag=substr($login,8,2);
		$mnd=substr($login,5,2);
		$time=substr($login,11,2);
		$minutt=substr($login,14,2);
		$sekund=substr($login,17,2);
		$sidensist=mktime($time,$minutt,$sekund,$mnd,$dag,$aar);
		$ukedag=array("","Mandag","Tirsdag","Onsdag","Torsdag","Fredag","Lørdag","Søndag");
		$maaned=array("","Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember");
		$mndnr=date("n", $sidensist);
		$mndnavn=$maaned[$mndnr];
		$ukedagnr=date("N", $sidensist);
		$ukedagnavn=$ukedag[$ukedagnr];
		$klokka=date("H:i:s", $sidensist);
		$dag=date("d", $sidensist);
		echo "Du var sist logget inn: <b>".$ukedagnavn . " " . $dag . " " . $mndnavn . ", klokken " .$klokka ."</b>";
	}
}
//Formaterer dato $date fra databasen
function datoformat($date,$valg=null){
	if($date)
	{
		$aar=substr($date,0,4);
		$dag=substr($date,8,2);
		$mnd=substr($date,5,2);
		$maaned=array("","Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember");
		if($mnd > 9)
		{
			$mndnavn=$maaned[$mnd];
		}
		else{
			$mndnavn=$maaned[str_replace("0","",$mnd)];
		}
		if($valg)
		{
			return "$dag $mndnavn";
		}
		else{
			return "$dag $mndnavn $aar";
		}
	}
}
//Formaterer dato $date fra databasen
function datoformat2($date){
	if($date)
	{
		$dag=substr($date,0,2);
		$mnd=substr($date,3,2);
		$maaned=array("","Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember");
		$mndnavn=$maaned[str_replace("0","",$mnd)];
		return "$dag. $mndnavn";
	}
}
//Genererer randomnummer, brukes til Referansenummer
function genererrandomnummer($lengde = NULL){
	if(!$lengde)
	{
		$lengde=4;
	}
	$referansenummer="";
	for($r=1;$r<=$lengde;$r++)
	{
		$referansenummer.=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);
	}
	return $referansenummer;
}
//Teller antall rows i en sql.
function antall($sql)
{
	global $db;
	$svar=mysqli_query($db,$sql);
	@$antall=mysqli_num_rows($svar);
	return $antall;
}
//Teller antall rows i en sql.
function kjor($sql)
{
	global $db;
	mysqli_query($db,$sql) or die("feil");
}
//Henter array fra db
function hentarray($sql)
{
	global $db;
	$svar=mysqli_query($db,$sql) or die("feil");
	$row=mysqli_fetch_array($svar);
	return $row;
}
//lager og sjekker at referansenummeret er unikt. Bruker randomnummer-funksjonen
function refnr($antall = NULL){
	$refnr=genererrandomnummer($antall);
	$finnes=false;
	do{
		$sql="SELECT * FROM christensen2.booking where binary referansenummer='$refnr';";
		$antall=antall($sql);
		if($antall==0){
			$finnes=true;
		}
		else{
			$refnr=genererrandomnummer($antall);
		}
	} while($finnes==false);
	return $refnr;
}
//Sjekker om referansenummer finnes
function refsjekk($refnr)
{
	$id=hentid("SELECT id FROM christensen2.booking where binary referansenummer='$refnr';");
	$sql="SELECT * FROM christensen2.billett where booking_id=$id;";
	$antall=antall($sql);
	if($antall>0){
		return true;
	}
	else{
		if($id)
		{
			kjor("DELETE FROM `christensen2`.`booking` WHERE `id`='$id';");

		}
		return false;
	}
}
//henter ID fra en row i SQLEN - SQLen KAN KUN SVARE MED 1 ROW
function hentid($sql, $rad=null)
{
	global $db;
	if(!@$rad)
	{
		$rad="id";
	}
	$svar=mysqli_query($db,$sql);
	$row=mysqli_fetch_assoc($svar);
	$id=$row["$rad"];
	return $id;
}
//Henter referansenummer med $get
function getreferansenummer()
{
	@$referansenummer=$_GET["referansenummer"];
	if($referansenummer)
	{
		echo $referansenummer;
	}
}
function klokkeslett($tid)
{
	return substr($tid,0,5);
}
//Genererer billetnummer
function genbillettnummer($antall = null){
	if(!$antall)
	{
		$antall=7;
	}
	$billettnummer="";
	for($r=1;$r<=$antall;$r++)
	{
		$billettnummer.=substr('0123456789',mt_rand(0,8),1);
	}
	return $billettnummer;
}
function genid($antall = null){
	if(!$antall)
	{
		$antall=7;
	}
	$billettnummer="";
	for($r=1;$r<=$antall;$r++)
	{
		$billettnummer.=substr('123456789',mt_rand(0,8),1);
	}
	return $billettnummer;
}
//genererer og sjekker billetnummer. bruker genbilletnummer funksjonen
function billettnummer($tegn = null){
	$finnes=false;
	$billettnummer=genbillettnummer($tegn);
	do{
		$sql="SELECT * FROM billett where billettnummer=$billettnummer;";
		$antall=antall($sql);
		if($antall<1){
			$finnes=true;

		}
		else{
			$billettnummer=genbillettnummer($tegn);
		}
	}while($finnes==false);
	return $billettnummer;
}
//genererer og sjekker billetnummer. bruker genbilletnummer funksjonen
function genpassasjerid($tegn = null){
	$finnes=false;
	$passasjerid=genbillettnummer($tegn);
	do{
		$sql="SELECT * FROM passasjer where id=$passasjerid;";
		$antall=antall($sql);
		if($antall<1){
			$finnes=true;

		}
		else{
			$passasjerid=genbillettnummer($tegn);
		}
	}while($finnes==false);
	return $passasjerid;
}
//Sender deg tilbake til siden du kom fra, eller til index1.php om den ikke finner forrige side. Brukes der man må oppgi en $_GET variabel
function snu($tid=null){
	@$ref = $_SERVER['HTTP_REFERER'];
	$sec="4";
	if($tid){
		$sec="0";
	}
	if($ref){
		header('refresh:'. $sec .'.; url='.$ref);
		echo("<div class='alert alert-warning'>Her har det skjedd noe feil, så vi sender deg tilbake til der du kom ifra.</div>");
	}
	else{
		header('refresh: 4; url="index.php"');
		echo("<div class='alert alert-warning'>Her har det skjedd noe feil, men vi finner ikke ut hvor du kom fra så vi sender deg til startsiden.</div>");
	}
}
function slettFulfort($tid=null){
	@$ref = $_SERVER['HTTP_REFERER'];
	$sec="4";
	if($tid){
		$sec="0";
	}
	if($ref){
		header('refresh:'. $sec .'.; url='.$ref);
		echo("<div class='alert alert-warning'>Sletting fulført. Du blir nå sendt tilbake til din booking.</div>");
	}
	else{
		header('refresh: 4; url="index.php"');
		echo("<div class='alert alert-warning'>Her har det skjedd noe feil, men vi finner ikke ut hvor du kom fra så vi sender deg til startsiden.</div>");
	}
}
//Select-boxer med js validering og bootstrap-classes
function selectprisgruppe($valgt=null,$array=null,$r=null)
{
	global $db;
	$rjs=$r;
	$a="[]";
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='prisgruppef$r'>
	<label class='control-label'>Prisgruppe</label>
		<select class='form-control' id='prisgruppe' onchange='valider(this.value, this.id, $rjs)' name='prisgruppe$a'>";
	if(!is_null($valgt)){
		$sql="select * from prisgruppe;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{

			for($r=1;$r<=$antall;$r++)
			{
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				if($id==$valgt)
				{
					$id=$rad["id"];
					$navn=$rad["navn"];
					$pris=$rad["pris"];
					$beskrivelse=$rad["beskrivelse"];
					echo "<option value='$id'>$navn ($beskrivelse)</option>";
					$første=true;
				}
			}
		}while($første=false);
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$pris=$rad["pris"];
			$beskrivelse=$rad["beskrivelse"];
			if($id !== $valgt){
				echo "<option value='$id'>$navn ($beskrivelse)</option>";
			}
		}


	}
	else{
		echo "<option value=''>- Velg prisgruppe -</option>";
		$sql="select * from prisgruppe;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$pris=$rad["pris"];
			$beskrivelse=$rad["beskrivelse"];
			echo "<option value='$id'>$navn ($beskrivelse)</option>";
		}
	}
	echo "</select></fieldset>";
}
//Select-boxer med js validering og bootstrap-classes
function selectnasjonalitet($valgt=null,$array=null, $r=null,$navn=null)
{
	if(!$navn){
		$navn="Nasjonalitet";
	}
	global $db;
	$rjs=$r;
	$a="[]";
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='nasjonalitetf$r'>
	<label class='control-label'>$navn</label>
		<select class='form-control' name='nasjonalitet$a' id='nasjonalitet' onchange='valider(this.value, this.id,$rjs)'>";
	if(!is_null($valgt)){
		$sql="select * from nasjonalitet;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{

			for($r=1;$r<=$antall;$r++)
			{
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				if($id==$valgt)
				{
					$id=$rad["id"];
					$land=$rad["land"];
					$forkortelse=$rad["forkortelse"];
					echo "<option value='$id'>$land ($forkortelse)</option>";
					$første=true;
				}
			}
		}while($første=false);
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if($id !== $valgt){
				echo "<option value='$id'>$land ($forkortelse)</option>";
			}
		}


	}
	else{
		echo "<option value=''>- Velg nasjonalitet -</option>";
		$sql="select * from nasjonalitet;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			echo "<option value='$id'>$land ($forkortelse)</option>";
		}
	}
	echo "
	</select></fieldset>";
}
//Radio-boxer med js validering og bootstrap-classes
function radiokjonn($valgt=null,$array=null,$r=null)
{
	global $db;
	$rjs=$r;
	$a="[]";
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "<fieldset class='form-group' id='kjonnf$r'><label class='control-label'>Kjønn</label></br>";
	if(!is_null($valgt)){
		$sql="select * from kjonn;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{

			for($teller=1;$teller<=$antall;$teller++)
			{
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				if($id==$valgt)
				{
					$id=$rad["id"];
					$kjonn=$rad["kjonn"];
					echo "<label class='control-label radio-inline'><input type='radio' name='kjonn$r' id='kjonn' onchange='valider(this.value, this.id,$rjs)' value='$id' checked>$kjonn</label>";
					$første=true;
				}
			}
		}while($første=false);
		$svar=mysqli_query($db,$sql);
		for($teller=1;$teller<=$antall;$teller++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$kjonn=$rad["kjonn"];
			if($id !== $valgt){
				echo "<label class='control-label radio-inline'><input type='radio' name='kjonn$r' id='kjonn' onchange='valider(this.value, this.id,$rjs)' value='$id'>$kjonn</label>";
			}
		}


	}
	else{
		$sql="select * from kjonn;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($teller=1;$teller<=$antall;$teller++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$kjonn=$rad["kjonn"];
			echo "<label class='control-label radio-inline'><input type='radio' name='kjonn$r' id='kjonn' onchange='valider(this.value, this.id,$rjs)' value='$id'>$kjonn</label>";
		}
	}
	echo "</select></fieldset>";
}
//Input-text med js validering og bootstrap-classes
function inputfornavn($valgt=null,$array=null,$r=null)
{
	$a="[]";
	$rjs=$r;
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='fornavnf$r'>
	<label class='control-label'>Fornavn</label>
		<input type='text' class='form-control' id='fornavn' name='fornavn$a' value='$valgt' onkeyup='valider(this.value, this.id, $rjs)' >
		<span id='fornavns$r' aria-hidden='true'></span>
	</label>
</fieldset>";
}
//Input-text med js validering og bootstrap-classes
function inputetternavn($valgt=null,$array=null,$r=null)
{
	$a="[]";
	$rjs=$r;
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='etternavnf$r'>
	<label class='control-label'>Etternavn</label>
		<input type='text' class='form-control' id='etternavn' name='etternavn$a' value='$valgt' onkeyup='valider(this.value, this.id, $rjs)' >
		<span id='etternavns$r' aria-hidden='true'></span>
	</label>
</fieldset>";
}
//Input-text med js validering og bootstrap-classes
function inputtlf($valgt=null,$array=null,$r=null)
{
	$a="[]";
	$rjs=$r;
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='tlff$r'>
	<label class='control-label'>Telefonnummer</label>
		<input type='text' class='form-control' id='tlf' name='tlf$a' value='$valgt' onkeyup='valider(this.value, this.id, $rjs)' >
		<span id='tlfs$r' aria-hidden='true'></span>
	</label>
</fieldset>";
}
//Input-text med js validering og bootstrap-classes
function inputpass($valgt=null,$array=null,$r=null)
{
	$a="[]";
	$rjs=$r;
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='passf$r'>
	<label class='control-label'>Passnummer</label>
		<input type='text' class='form-control' id='pass' name='pass$a' value='$valgt' onkeyup='valider(this.value, this.id, $rjs)' >
		<span id='passs$r' aria-hidden='true'></span>
	</label>
</fieldset>";
}
//Input-text med js validering og bootstrap-classes
function inputepost($valgt=null,$array=null,$r=null)
{
	$a="[]";
	$rjs=$r;
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='epostf$r'>
	<label class='control-label'>E-post</label>
		<input type='text' class='form-control' id='epost' name='epost$a' value='$valgt' onkeyup='valider(this.value, this.id, $rjs)' >
		<span id='eposts$r' aria-hidden='true'></span>
	</label>
</fieldset>";
}
function selectfraflyplass($valgt=null,$array=null, $r=null, $ikkevis=null)
{
	global $db;
	$rjs=$r;
	$a="[]";
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='avgangflyplassf$r'>
	<label class='control-label' id='avgangflyplasslabel'>Fly fra</label>
		<select class='form-control' name='avgangflyplass$a' id='avgangflyplass' onchange='valider(this.value, this.id,$rjs)'>";
	if(!is_null($valgt)){
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{
			for($r=0;$r<$antall;$r++){
			if($valgt == "%"){
					echo "<option value='%'>Alle</option>";
					$første=true;
					$alleredeprintet=true;
					break(1);
				}
				else{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					if($id == $valgt)
					{
						$navn=$rad["navn"];
						$by=$rad["by"];
						$land=$rad["land"];
						$forkortelse=$rad["forkortelse"];
						echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
						$første=true;
					}
				}

			}
		}while($første=false);
		if(!@$alleredeprintet)
		{
			echo "<option value='%'>Alle</option>";
		}
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if($id !== $valgt){
				echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
			}
		}


	}
	else{
		echo "<option value=''>- Velg flyplass -</option>";
		echo "<option value='%'>Alle</option>";
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if(!$ikkevis){
				echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
			}
			else{
				if(!($id==$ikkevis)){
					echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
				}

			}

		}
	}
	echo "
	</select></fieldset>";
}

function selecttilflyplass($valgt=null,$array=null, $r=null, $ikkevis=null)
{
	global $db;
	$rjs=$r;
	$a="[]";
	if(!$array)
	{
		$a="";
		$rjs=htmlspecialchars("'ingen'",ENT_QUOTES);
	}
	echo "
<fieldset class='form-group' id='ankomstflyplassf$r'>
	<label class='control-label' id='ankomstflyplasslabel'>Fly til</label>
		<select class='form-control' name='ankomstflyplass$a' id='ankomstflyplass' onchange='valider(this.value, this.id,$rjs)'>";
	if(!is_null($valgt)){
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{
			for($r=0;$r<$antall;$r++){
			if($valgt == "%"){
					echo "<option value='%'>Alle</option>";
					$første=true;
					$alleredeprintet=true;
					break(1);
				}
				else{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					if($id == $valgt)
					{
						$navn=$rad["navn"];
						$by=$rad["by"];
						$land=$rad["land"];
						$forkortelse=$rad["forkortelse"];
						echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
						$første=true;
					}
				}

			}
		}while($første=false);
		if(!@$alleredeprintet){
			echo "<option value='%'>Alle</option>";
		}
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if(!($id === $valgt)){
				echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
			}
		}
	}
	else{
		echo "<option value=''>- Velg flyplass -</option>";
		echo "<option value='%'>Alle</option>";
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if(!$ikkevis){
				echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
			}
			else{
				if(!($id==$ikkevis)){
					echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
				}

			}

		}
	}
	echo "
	</select></fieldset>";
}
function selectflyplass($nr=null,$valgt=null){
	global $db;
	echo "
<fieldset class='form-group' id='flyplass".$nr ."f'>
	<label class='control-label'>Flyplass</label>
		<select class='form-control' name='flyplass$nr' id='flyplass$nr' onchange='valider(this.value, this.id)'>";
	if(!is_null($valgt)){
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{

			for($r=1;$r<=$antall;$r++)
			{
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				if($id==$valgt)
				{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					$navn=$rad["navn"];
					$by=$rad["by"];
					$land=$rad["land"];
					$forkortelse=$rad["forkortelse"];
					echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
					$første=true;
				}
			}
		}while($første=false);
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if($id !== $valgt){
				echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
			}
		}


	}
	else{
		echo "<option value=''>- Velg flyplass -</option>";
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
		}
	}
	echo "
	</select></fieldset>";
}
function selectruteflyplass($nr=null,$valgt=null){
	global $db;
	echo "
<fieldset class='form-group' id='flyplass".$nr ."f'>
	<label class='control-label'>Flyplass</label>
		<select class='form-control' name='ruteflyplass$nr' id='flyplass$nr' onchange='valider(this.value, this.id)'>";
	if(!is_null($valgt)){
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{

			for($r=1;$r<=$antall;$r++)
			{
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				if($id==$valgt)
				{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					$navn=$rad["navn"];
					$by=$rad["by"];
					$land=$rad["land"];
					$forkortelse=$rad["forkortelse"];
					echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
					$første=true;
				}
			}
		}while($første=false);
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if($id !== $valgt){
				echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
			}
		}


	}
	else{
		echo "<option value=''>- Velg flyplass -</option>";
		$sql="select * from flyplass;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			echo "<option value='$id;$navn'>$navn, $by ($forkortelse), $land</option>";
		}
	}
	echo "
	</select></fieldset>";
}
/*
  _____ _        _   _     _      _                   _
 / ____| |      | | (_)   | |    (_)                 | |
| (___ | |_ __ _| |_ _ ___| | __  _ _ __  _ __  _   _| |_
 \___ \| __/ _` | __| / __| |/ / | | '_ \| '_ \| | | | __|
 ____) | || (_| | |_| \__ \   <  | | | | | |_) | |_| | |_
|_____/ \__\__,_|\__|_|___/_|\_\ |_|_| |_| .__/ \__,_|\__|
                                         | |
                                         |_|
*/
function textareabeskrivelse($valgt=null)
{
	echo"
		<fieldset class='form-group' id='beskrivelsef'>
			<label class='control-label' id='beskrivelse'>Beskrivelse</label>
			<textarea id='beskrivelse' class='form-control' name='beskrivelse' autocomplete='off' onkeyup='valider(this.value, this.id)'>$valgt</textarea>
		</fieldset>
		";
}
function inputpassord($id)
{
	if($id==1){
		echo"
	  <fieldset class='form-group' id='passord1f'>
	   <label class='control-label' >Passord</label>
	   <input id='passord1' name='passord1' type='password' placeholder='Minimum 8 tegn' class='form-control input-md' onkeyup='valider(this.value, this.id)' required>
	   <span id='passord1s' aria-hidden='true'></span>
	   </fieldset>";
	}
	else if($id==2){
		echo"
		  <fieldset class='form-group' id='passord2f'>
		   <label class='control-label' id='bekreftpassord'>Bekreft passord</label>
		   <input id='passord2' name='passord2' type='password' placeholder='Gjenta passord' class='form-control' onkeyup='valider(this.value, this.id)' required>
		   <span id='passord2s' aria-hidden='true'></span>
		   </fieldset>
		 ";
	}



}
function selectflytype($valgt=null){
	global $db;
	echo "
<fieldset class='form-group' id='flytypef'>
	<label class='control-label'>Flytype</label>
		<select class='form-control' name='flytype' id='flytype' onchange='valider(this.value, this.id)'>";
		if(!isset($valgt)){
			echo "<option value=''>- Velg flytype -</option>";
			$sql="SELECT * FROM flytype;";
			$svar=mysqli_query($db,$sql);
			$antall=mysqli_num_rows($svar);
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$kapasitet=$rad["kapasitet"];
				$modell=$rad["modell"];
				$land=$rad["land"];
				$forkortelse=$rad["forkortelse"];
				echo "<option value='$id'>$modell (Seter: $kapasitet)</option>";
			}
		}
		else{
			$sql="select * from flytype;";
			$svar=mysqli_query($db,$sql);
			$antall=mysqli_num_rows($svar);
			$første=false;
			do{

				for($r=1;$r<=$antall;$r++)
				{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					if($id==$valgt){
						$id=$rad["id"];
						$kapasitet=$rad["kapasitet"];
						$modell=$rad["modell"];
						$land=$rad["land"];
						$forkortelse=$rad["forkortelse"];
						echo "<option value='$id'>$modell (Seter: $kapasitet)</option>";
						$første=true;
					}
				}
			}while($første=false);
			$svar=mysqli_query($db,$sql);
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$kapasitet=$rad["kapasitet"];
				$modell=$rad["modell"];
				$land=$rad["land"];
				$forkortelse=$rad["forkortelse"];
				if($id !== $valgt){
					echo "<option value='$id'>$modell (Seter: $kapasitet)</option>";
				}
			}
		}
		echo "</select></fieldset>";
		
}
function selectflyselskap($valgt=null){
	global $db;
	$idliten="flyselskap";
	$idstor="Flyselskap";
	echo "
<fieldset class='form-group' id='".$idliten."f'>
	<label class='control-label'>$idstor</label>
		<select class='form-control' name='$idliten' id='$idliten' onchange='valider(this.value, this.id)'>";
		if(!isset($valgt)){
			echo "<option value=''>- Velg $idstor -</option>";
			$sql="SELECT * FROM $idliten;";
			$svar=mysqli_query($db,$sql);
			$antall=mysqli_num_rows($svar);
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$navn=$rad["navn"];
				echo "<option value='$id'>$navn</option>";
			}
		}
		else{
			$sql="select * from $idliten;";
			$svar=mysqli_query($db,$sql);
			$antall=mysqli_num_rows($svar);
			$første=false;
			do{

				for($r=1;$r<=$antall;$r++)
				{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					if($id==$valgt){
						$id=$rad["id"];
						$navn=$rad["navn"];
						echo "<option value='$id'>$navn</option>";
						$første=true;
					}
				}
			}while($første=false);
			$svar=mysqli_query($db,$sql);
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$navn=$rad["navn"];
				if($id !== $valgt){
					echo "<option value='$id'>$navn</option>";
				}
			}
		}
		echo "</select></fieldset>";
}
function inputtext($navn, $label=null,$valgt=null,$readonly=null){
	$idliten=strtolower($navn);
	if(!$label){
		$label=ucfirst($idliten);
	}
	echo "
<fieldset class='form-group' id='".$idliten."f'>
	<label class='control-label'>$label</label>
		<input type='text' class='form-control' id='$idliten' name='$idliten' onkeyup='valider(this.value, this.id)' value='$valgt' $readonly>
		<span id='".$idliten."s' aria-hidden='true'></span>
	</label>
</fieldset>";
}
function plussminus($label, $id=null,$name, $gitt=null,$jsajax=null){
	if(!$id)
	{
		$id=genid(13);
	}
	if(!$gitt)
	{
		$gitt=1;
	}
	$changefunksjon="";
	if($jsajax)
	{
		$changefunksjon=";antallflyvningerajax($id)";
	}
	echo"
		<fieldset class='form-group' id='" . $id . "f'>
			<label class='control-label'>$label</label>
		<div class='input-group'>
			<span class='input-group-btn' id='span1$id'>
				<button class='btn btn-default' id='minus' type='button' onclick='plussminusmax10(this.id,$id)$changefunksjon'><i class='glyphicon glyphicon-minus'></i></button>
			</span>
			<input type='number' name='$name' id='$id' class='form-control' value='$gitt'>
			<span class='input-group-btn' id='span2$id'>
				<button class='btn btn-default' id='pluss' type='button' onclick='plussminusmax10(this.id,$id)$changefunksjon'><i class='glyphicon glyphicon-plus'></i></button>
			</span>
		</div>
		</fieldset>";
}
function plussminusmax10($label, $id=null,$name, $gitt=null,$jsajax=null){
	if(!$id)
	{
		$id=genid(13);
	}
	if(!$gitt)
	{
		$gitt=1;
	}
	$changefunksjon="";
	if($jsajax)
	{
		$changefunksjon=";antallflyvningerajax($id)";
	}
	echo"
		<fieldset class='form-group' id='" . $id . "f'>
			<label class='control-label'>$label</label>
		<div class='input-group'>
			<span class='input-group-btn' id='span1$id'>
				<button class='btn btn-default' id='minus' type='button' onclick='plussminusmax10(this.id,$id)$changefunksjon;antallajax($id)'><i class='glyphicon glyphicon-minus'></i></button>
			</span>
			<input type='number' name='$name' id='$id' class='form-control' value='$gitt' readonly>
			<span class='input-group-btn' id='span2$id'>
				<button class='btn btn-default' id='pluss' type='button' onclick='plussminusmax10(this.id,$id)$changefunksjon;antallajax($id)'><i class='glyphicon glyphicon-plus'></i></button>
			</span>
		</div>
		</fieldset>";
}
function selectrute($valgt=null){
	global $db;
	$idliten="rute";
	$idstor="Rute";
	echo "
<fieldset class='form-group' id='".$idliten."f'>
	<label class='control-label'>$idstor</label>
		<select class='form-control' name='$idliten' id='$idliten' onchange='valider(this.value, this.id); visruteinfo(this.value)'>";
		if(!isset($valgt)){
			echo "<option value=''>- Velg $idstor -</option>";
			$sql="SELECT * FROM $idliten order by navn asc;";
			$svar=mysqli_query($db,$sql);
			$antall=mysqli_num_rows($svar);
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$navn=$rad["navn"];
				echo "<option value='$id'>$navn</option>";
			}
		}
		else{
			$sql="SELECT * FROM $idliten order by navn asc;";
			$svar=mysqli_query($db,$sql);
			$antall=mysqli_num_rows($svar);
			$første=false;
			do{

				for($r=1;$r<=$antall;$r++)
				{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					if($id==$valgt){
						$id=$rad["id"];
						$navn=$rad["navn"];
						echo "<option value='$id'>$navn</option>";
						$første=true;
					}
				}
			}while($første=false);
			$svar=mysqli_query($db,$sql);
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$navn=$rad["navn"];
				if($id !== $valgt){
					echo "<option value='$id'>$navn</option>";
				}
			}
		}
			echo "</select></fieldset><div id='visruteinfo'></div>";
}
function selectrutesorter($name=null, $label=null, $valgt=null){
	global $db;
	$idliten="rute";
	$idstor="Rute";
	if($name && $label){
		$idliten="$name";
		$idstor="$label";
	}
	echo "
<fieldset class='form-group' id='".$idliten."f'>
	<label class='control-label'>$idstor</label>
		<select class='form-control' name='$idliten' id='$idliten' onchange='valider(this.value, this.id)'>";
		echo "<option value=''>Alle ruter</option>";
		$sql="select distinct r.navn, r.id from flight join rute r on r.id=flight.rute_id order by r.navn";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			echo "<option value='$id'>$navn</option>";
		}
		echo "</select></fieldset>";
}
function selectfly($label=null, $valgt=null){
	global $db;
	$idliten="fly";
	if(!$label){
		$label=ucfirst($idliten);
	}
	echo "
<fieldset class='form-group' id='".$idliten."f'>
	<label class='control-label'>$label</label>
		<select class='form-control' name='$idliten' id='$idliten' onchange='valider(this.value, this.id); visflyinfo(this.value)'>";
		
		if(!isset($valgt)){
			echo "<option value=\"\">- Velg $label -</option>";
			$sql="select fly.id, fly.flynummer, t.modell, t.kapasitet from fly join flytype t on t.id=fly.flytype_id group by flynummer order by fly.flynummer;";
			$svar=mysqli_query($db,$sql)or die("feil");
			$antall=mysqli_num_rows($svar);
			echo $antall;
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$flynummer=$rad["flynummer"];
				$modell=$rad["modell"];
				$kapasitet=$rad["kapasitet"];
				echo "<option value='$id'>$flynummer</option>";
			}
		}
		else{
		$sql="select fly.id, fly.flynummer, t.modell, t.kapasitet from fly join flytype t on t.id=fly.flytype_id group by flynummer order by fly.flynummer;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{

			for($r=1;$r<=$antall;$r++)
			{
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				if($id==$valgt){
					$id=$rad["id"];
					$flynummer=$rad["flynummer"];
					$modell=$rad["modell"];
					$kapasitet=$rad["kapasitet"];
					echo "<option value='$id'>$flynummer</option>";
					$første=true;
				}
			}
		}while($første=false);
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$flynummer=$rad["flynummer"];
			$modell=$rad["modell"];
			$kapasitet=$rad["kapasitet"];
			if($id !== $valgt){
				echo "<option value='$id'>$flynummer</option>";
			}
		}
		}
		echo "</select></fieldset><div id='visflyinfo'></div>";
}
/**
#############################  Validering kommer herunder
#############################  Disse valideringene vil blablabla



#############################  Kriteriene er som følger:
#############################  Fornavn: 2 bokstaver, kun a-z, A-Z
#############################  Etternavn samme som fornavn
#############################  Telefonnummer 8+ kun tall
#############################  Epost må inneholde tekst@tekst.tekst (må inneholde både @ og .)
#############################
#############################
#############################
#############################
#############################
#############################
**/

function valider($valider,$antall=null){
	@$fornavn=$valider["fornavn"];
	@$etternavn=$valider["etternavn"];
	@$tlf=$valider["tlf"];
	@$epost=$valider["epost"];
	@$pass=$valider["pass"];
	@$passord=$valider["passord"];
	@$brukernavn=$valider["brukernavn"];
	@$navn=$valider["navn"];
	@$avgangdatofrapost=$valider["avgangdato"];
	@$avgangklokkeslett=$valider["avgangklokkeslett"];
	@$flytid=$valider["flytid"];
	@$pris=$valider["pris"];
	@$land=$valider["land"];
	@$forkortelse=$valider["forkortelse"];
	@$retningsnummer=$valider["retningsnummer"];
	@$kjonn=$valider["kjonninput"];
	@$beskrivelse=$valider["beskrivelse"];
	@$kapasitet=$valider["kapasitet"];
	@$modell=$valider["modell"];
	@$flynummer=$valider["flynummer"];
	@$flytid=$valider["flytid"];
	@$flybillettpris=$valider["flybillettpris"];
	@$by=$valider["by"];
	$gyldig=true;
	$antallsjekk=0;
	$feilmelding="";
	$bokstaver = "/^[A-Z,ø,Ø,æ,Æ,å,Å, ,a-z]+$/";
	$tegn = "/^[A-Z,ø,Ø,æ,Æ,å,Å, ,a-z,0-9]+$/";
	if($retningsnummer){
		$antallsjekk=$antallsjekk+1;
		if(strlen($retningsnummer)>6){
			$gyldig=false;
			$feilmelding.="Retningsnummeret er for langt.</br>";
		}	
	}
	if($avgangdatofrapost){
		$antallsjekk=$antallsjekk+1;
		$m=substr($avgangdatofrapost,3,2);
		$d=substr($avgangdatofrapost,0,2);
		$a=substr($avgangdatofrapost,6,4);
		if(!checkdate ($m, $d, $a)){
			$gyldig=false;
			$feilmelding.="Ugyldig dato.</br>";
		}
	}
	if($flybillettpris){
		$antallsjekk=$antallsjekk+1;
		if(strlen($flybillettpris)>8 && is_Nan($flybillettpris)){
			$gyldig=false;
			$feilmelding.="Flytiden er for ugyldig.</br>";
		}	
	}
	if($flytid){
		$antallsjekk=$antallsjekk+1;
		if(strlen($flytid)>10 && is_Nan($flytid)){
			$gyldig=false;
			$feilmelding.="Flytiden er for ugyldig.</br>";
		}	
	}
	if($flynummer){
		$antallsjekk=$antallsjekk+1;
		if(strlen($flynummer)>10){
			$gyldig=false;
			$feilmelding.="Flynummeret er for langt.</br>";
		}	
	}
	if($modell){
		$antallsjekk=$antallsjekk+1;
		if(strlen($beskrivelse)>=10){
			$gyldig=false;
			$feilmelding.="Modellnavnet er for langt.</br>";
		}
	}
	if($kapasitet){
		$antallsjekk=$antallsjekk+1;
		if($kapasitet > 1000){
			$gyldig=false;
			$feilmelding.="Kapasiteten er for stor.</br>";
		}
	}
	if($beskrivelse){
		$antallsjekk=$antallsjekk+1;
		if(strlen($beskrivelse)>=254){
			$gyldig=false;
			$feilmelding.="Beskrivelsen er for lang.</br>";
		}
	}
	if($brukernavn){
		$antallsjekk=$antallsjekk+1;
		if(strlen($brukernavn)<=2){
			$gyldig=false;
			$feilmelding.="Brukernavnet må være minst 2 tegn.</br>";
		}
	}
	if($forkortelse){
		$antallsjekk=$antallsjekk+1;
		if(strlen($forkortelse)<=2){
			$gyldig=false;
			$feilmelding.="Forkortelsen må være 3 bokstaver.</br>";
		}
		if(!preg_match($bokstaver, $forkortelse)){
			$gyldig=false;
			$feilmelding.="Forkortelsen inneholder tall</br>";
		}
	}
	if($navn){
		$antallsjekk=$antallsjekk+1;
		if(strlen($navn)<2){
			$gyldig=false;
			$feilmelding.="Navnet er for kort</br>";
		}
		if(!preg_match($bokstaver, str_replace(" ", "", $navn))){
			$gyldig=false;
			$feilmelding.="Navnet inneholder tall</br>";
		}
	}
	if($by){
		$antallsjekk=$antallsjekk+1;
		if(strlen($by)<2){
			$gyldig=false;
			$feilmelding.="Navnet er for kort</br>";
		}
		if(!preg_match($bokstaver, str_replace(" ", "", $by))){
			$gyldig=false;
			$feilmelding.="Navnet inneholder tall</br>";
		}
	}
	if($kjonn){
		$antallsjekk=$antallsjekk+1;
		if(strlen($kjonn)<2){
			$gyldig=false;
			$feilmelding.="Navnet på kjønnet er for kort</br>";
		}
		if(!preg_match($bokstaver, str_replace(" ", "", $kjonn))){
			$gyldig=false;
			$feilmelding.="Navnet på kjønnet inneholder tall</br>";
		}
	}
	if($land){
		$antallsjekk=$antallsjekk+1;
		if(strlen($land)<2){
			$gyldig=false;
			$feilmelding.="Landet er for kort</br>";
		}
		if(!preg_match($bokstaver, str_replace(" ", "", $land))){
			$gyldig=false;
			$feilmelding.="Landet inneholder tall</br>";
		}
	}
	if($fornavn){
		$antallsjekk=$antallsjekk+1;
		if(!strlen($fornavn)>=2){
			$gyldig=false;
			$feilmelding.="Fornavnet er for kort</br>";
		}
		if(!preg_match($bokstaver, str_replace(" ", "", $fornavn))){
			$gyldig=false;
			$feilmelding.="Fornavnet inneholder tall</br>";
		}
	}
	
	if($etternavn){
		$antallsjekk=$antallsjekk+1;
		if(!strlen($etternavn)>=2){
			$gyldig=false;
			$feilmelding.="Etternavnet er for kort</br>";
		}
		if(!preg_match($bokstaver, str_replace(" ", "", $etternavn))){
			$gyldig=false;
			$feilmelding.="Etternavnet inneholder tall</br>";
		}
	}

	if($tlf){
		$antallsjekk=$antallsjekk+1;
		if(!is_numeric($tlf)) {
			$gyldig=false;
			$feilmelding.="Telefonnummeret ikke kun tall</br>";
		}
		 if(!strlen($tlf)>=8){
			$gyldig=false;
			$feilmelding.="Telefonnummeret må inneholde 8 eller flere siffer</br>";
		 }
	}

	if($epost){
		$antallsjekk=$antallsjekk+1;
		if(!filter_var($epost, FILTER_VALIDATE_EMAIL)){
			$gyldig=false;
			$feilmelding.="Ugyldig epost</br>";
		}
	}
	if($pass){
		$antallsjekk=$antallsjekk+1;
		if(!is_numeric($pass)){
			$gyldig=false;
			$feilmelding.="Passnummeret må bestå av kunn tall</br>";
		}
		if(!strlen($pass) >=8){
			$gyldig=false;
			$feilmelding.="Passnummeret er for kort</br>";
		}
	}
	if($pris){
		$antallsjekk=$antallsjekk+1;
		if(!is_numeric($pris)){
			$gyldig=false;
			$feilmelding.="Pris må være kun tall.</br>";
		}
	}
	if($flytid){
		$antallsjekk=$antallsjekk+1;
		if(!is_numeric($flytid)){
			$gyldig=false;
			$feilmelding.="Flytid må oppgis i kun minutter (kun tall).</br>";
		}
		if(strlen($flytid)>5){
			$gyldig=false;
			$feilmelding.="Oppgitt flytid er urealistisk. Maks 5 tall.</br>";
		}
	}
	if(isset($antall)){
		if($antall !== $antallsjekk){
			$gyldig=false;
			$inputmanger = $antall - $antallsjekk;
			$feilmelding.="<b>$inputmanger ble ikke fylt ut!</b></br>";
		}
	}
	if($gyldig===true){
		return $gyldig;
	}
	else{
		return $feilmelding;
	}
}
function registrert($tekst){
	return "<div class='alert alert-success alert-clickable' role='alert'>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	$tekst</div>";
}
function feilet($tekst){
	return "<div class='alert alert-danger alert-clickable' role='alert'>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$tekst</div>";
}

function tilbakemelding($tekst, $class = null){
	if(!$class){
		$class="alert";
	}
	return "<div class='alert alert-$class alert-clickable' role='alert'>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$tekst</div>";
}
function panelheader($innhold,$inn=null){
	$pil="down";
	if($inn){
		$inn="style=\"display:none;\"";
		$pil="right";
	}
	$id = genererrandomnummer(40);
	$idjs = htmlspecialchars("'t-$id'" ,ENT_QUOTES);
	echo "
			<div class='panel-heading' id='$id' onclick='togglemeg(this.id, $idjs)'>
				<h3 class='panel-title'>$innhold<i id='i-$id' class='pull-right glyphicon glyphicon-chevron-$pil'></i></h3>
			</div>
		<div class='panel-body' id='t-$id' $inn>";
}
function datotilsqlformat($date)
{
	$gammeldato=new DateTime($date);
	$nydato=date_format($gammeldato,'Y:m:d');
	return $nydato;

}
function selectdepfraflyplass($valgt=null, $til=null){
	global $db;
	$where="";
	if($til){
		$where = "where ankomst_fp = " . $til;
	}
	$rjs=htmlspecialchars("'avgang'",ENT_QUOTES);
	echo "
<fieldset class='form-group' id='avgangflyplassf'>
	<label class='control-label' id='avgangflyplasslabel'>Fly fra</label>
		<select class='form-control' name='avgangflyplass' id='avgangflyplass' onchange='valider(this.value, this.id);flyplassavhengighet(this.value,$rjs)'>";
	if(!is_null($valgt)){
		$sql="select flyplass.id, flyplass.navn, flyplass.forkortelse, flyplass.land, flyplass.by from flight f join rute r on r.id=f.rute_id join flyplass on flyplass.id=r.avgang_fp $where group by flyplass.navn;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{
			for($r=0;$r<$antall;$r++){
			if($valgt == "%"){
					echo "<option value='%'>Alle</option>";
					$første=true;
					$alleredeprintet=true;
					break(1);
				}
				else{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					if($id == $valgt)
					{
						$navn=$rad["navn"];
						$by=$rad["by"];
						$land=$rad["land"];
						$forkortelse=$rad["forkortelse"];
						echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
						$første=true;
					}
				}

			}
		}while($første=false);
		if(!@$alleredeprintet)
		{
			echo "<option value='%'>Alle</option>";
		}
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if($id !== $valgt){
				echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
			}
		}


	}
	else{
		$sql="select flyplass.id, flyplass.navn, flyplass.forkortelse, flyplass.land, flyplass.by from flight f join rute r on r.id=f.rute_id join flyplass on flyplass.id=r.avgang_fp $where group by flyplass.navn;";
		echo "<option value='%'>Alle</option>";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
		}
	}
	echo "
	</select></fieldset>";
}
function selectdeptilflyplass($valgt=null, $til=null){
	global $db;
	$where="";
	if($til){
		$where = "where avgang_fp = " . $til;
	}
	$rjs=htmlspecialchars("'ankomst'",ENT_QUOTES);
	echo "
<fieldset class='form-group' id='ankomstflyplassf'>
	<label class='control-label' id='ankomstflyplasslabel'>Fly fra</label>
		<select class='form-control' name='ankomstflyplass' id='ankomstflyplass' onchange='valider(this.value, this.id);flyplassavhengighet(this.value,$rjs)'>";
	if(!is_null($valgt)){
		$sql="select flyplass.id, flyplass.navn, flyplass.forkortelse, flyplass.land, flyplass.by from flight f join rute r on r.id=f.rute_id join flyplass on flyplass.id=r.ankomst_fp $where group by flyplass.navn;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		$første=false;
		do{
			for($r=0;$r<$antall;$r++){
			if($valgt == "%"){
					echo "<option value='%'>Alle</option>";
					$første=true;
					$alleredeprintet=true;
					break(1);
				}
				else{
					$rad=mysqli_fetch_array($svar);
					$id=$rad["id"];
					if($id == $valgt)
					{
						$navn=$rad["navn"];
						$by=$rad["by"];
						$land=$rad["land"];
						$forkortelse=$rad["forkortelse"];
						echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
						$første=true;
					}
				}

			}
		}while($første=false);
		if(!@$alleredeprintet)
		{
			echo "<option value='%'>Alle</option>";
		}
		$svar=mysqli_query($db,$sql);
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			if($id !== $valgt){
				echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
			}
		}


	}
	else{
		$sql="select flyplass.id, flyplass.navn, flyplass.forkortelse, flyplass.land, flyplass.by from flight f join rute r on r.id=f.rute_id join flyplass on flyplass.id=r.ankomst_fp $where group by flyplass.navn;";
		echo "<option value='%'>Alle</option>";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
		}
	}
	echo "
	</select></fieldset>";
}
function gensete($id){
	global $db;
	$sql="select t.kapasitet from flight f join fly on fly.id=f.fly_id join flytype t on t.id=fly.Flytype_id where f.id=$id";
	$svar=mysqli_query($db,$sql) or die("får ikke hentet kapasitet");
	$rad=mysqli_fetch_array($svar);
	$kapasitet=$rad["kapasitet"];
	$tatt=false;
	do{
		for($r=1;$r<=$kapasitet;$r++){
			$sql="select sete from billett where flight_id=$id and sete = $r";
			$svar=mysqli_query($db,$sql) or die("får ikke hentet seter");
			$antall=mysqli_num_rows($svar);
			if($antall === 0){
				$sete=$r;
				break;
			}
		}
	}while($tatt=false);
	if($sete){
		return $sete;
	}
	else{
		return false;
	}
	
}
function listfligths($id1, $id2, $type, $dato = null, $etterdennetimestampen=null,$idfordatatable=null){
	global $db;
	$datewhere="";
	$dateand="";
	$datoinfo="";
	if(isset($dato)){
		$nydato=datotilsqlformat($dato);
		$dateinfodate=datoformat2($dato);
		$datewhere="where avgang_dato >='$nydato'";
		$dateand="and avgang_dato >='$nydato'";
		$datoinfo=" etter <b>$dateinfodate</b>";
	}
	$navn=ucfirst(strtolower($type));
	$navnl=strtolower($type);
	if($type=="til"){                      // FRA 1 TIL 2
		$where1="r.avgang_fp='$id1'";
		$where2="r.ankomst_fp='$id2'";
		 if($id1=="%"  && $id2 !=="%"){
			$where="where " . $where2 . $dateand;
			$ruteinfo="Alle flyplasser";
		}
		else if($id1 !=="%"  && $id2 =="%"){
			$where="where " . $where1 . $dateand;
		}
		else if($id1 !=="%"  && $id2 !=="%"){
			$where="where " . $where1 . " and " . $where2 . $dateand;
		}
		else if($id1 =="%" && $id2=="%"){
			$ruteinfo="Alle flyplasser";
			$where="$datewhere";
		}
		$tur="Avreise";
	}
	if($type=="fra"){  		                // FRA 2 TIL 1
		$where1="r.avgang_fp='$id1'";
		$where2="r.ankomst_fp='$id2'";
		 if($id1=="%"  && $id2 !=="%"){
			$where="where " . $where2 . $dateand;
			$ruteinfo="Alle flyplasser";
		}
		else if($id1 !=="%" && $id2 =="%"){
			$where="where " . $where1 . $dateand;
		}
		else if($id1 !=="%"  && $id2 !=="%"){
			$where="where " . $where1 . " and " . $where2 . $dateand;
		}
		else if($id1 =="%" && $id2=="%"){
			$ruteinfo="Alle flyplasser";
			$where="$datewhere";
		}
		$tur="Hjemreise";
	}
	if(!@$ruteinfo){
		$sql="select distinct f.id, f.navn, f.land, f.by, f.forkortelse from rute r join flyplass f on f.id=r.avgang_fp where avgang_fp=$id1;";
		$svar=mysqli_query($db,$sql);
		$rad=mysqli_fetch_array($svar);
		$ruteinfo=$rad["navn"] . " (" . $rad["forkortelse"] . ") " . $rad["by"] . ", " . $rad["land"];
	}
	$sql="select f.avgang_tid, f.id, f.ankomst_tid, f.avgang_dato, f.ankomst_dato, f.pris, fly.flynummer, fra.navn as franavn, fra.forkortelse as fraforkortelse, til.navn as tilnavn, til.forkortelse as tilforkortelse, flytype.kapasitet - count(b.billettnummer)  as ledigebilletter from flight f left join billett b on b.flight_id=f.id join rute r on r.id=f.rute_id join fly on fly.id=f.fly_id join flytype on flytype.id=fly.Flytype_id join flyplass fra on fra.id=r.avgang_fp join flyplass til on til.id=r.ankomst_fp $where group by f.id order by  f.avgang_dato asc;";
	$svar=mysqli_query($db,$sql);
	@$antall=mysqli_num_rows($svar);
	if($antall > 0){
		$printdette="";
		for($r=0;$r<$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$franavn=$rad["franavn"];
			$fraforkortelse=$rad["fraforkortelse"];
			$tilnavn=$rad["tilnavn"];
			$tilforkortelse=$rad["tilforkortelse"];
			$ledigebilletter=$rad["ledigebilletter"];
			$avgangdatofradb=$rad["avgang_dato"];
			$ankomstdatofradb=$rad["ankomst_dato"];
			$avgangtid=klokkeslett($rad["avgang_tid"]);
			$ankomsttid=klokkeslett($rad["ankomst_tid"]);
			$avgangdato=datoformat($avgangdatofradb,1);
			$ankomstdato=datoformat($ankomstdatofradb);
			$pris=$rad["pris"];
			$flynummer=$rad["flynummer"];
			@$antallfraget=$_GET["ant"];
			if(!$antallfraget){
				$antallfraget=1;
			}
			if($ledigebilletter < 1 || $ledigebilletter < $antallfraget)
			{
				$class="trykkbar danger";
				$script="";
			}
			else if($ledigebilletter <10)
			{
				$class="trykkbar warning";
				$script=";velgmegffs('$type$r',this.id)";
			}
			else{
				$class="trykkbar";
				$script=";velgmegffs('$type$r',this.id)";
			}
			$dagensdato = time();
			$time = substr($avgangtid, 0, 2);
			$minutt = substr($avgangtid, 3, 2);
			$mnd = substr($avgangdatofradb, 5, 2);
			$dag = substr($avgangdatofradb, 8, 2);
			$aar = substr($avgangdatofradb, 0, 4);
			$gittdato = mktime($time, $minutt, "0", $mnd, $dag, $aar);
			$time = substr($ankomsttid, 0, 2);
			$minutt = substr($ankomsttid, 3, 2);
			$mnd = substr($ankomstdatofradb, 5, 2);
			$dag = substr($ankomstdatofradb, 8, 2);
			$aar = substr($ankomstdatofradb, 0, 4);
			$avgangtimestamp = mktime($time, $minutt, "0", $mnd, $dag, $aar);
			if($dagensdato < $gittdato){
				if($etterdennetimestampen){
					if($type==="fra"){
						if($etterdennetimestampen < $gittdato && $etterdennetimestampen !== $gittdato){
							$send=true;
						}
					}
					if($type==="til"){
						if($etterdennetimestampen > $avgangtimestamp && $etterdennetimestampen !== $avgangtimestamp){
							$send=true;
						}
					}
				}
				else{
					$send=true;
				}
			}
			if(@$send===true){
				$printdette.= "
					<tr class='$class' id='$type$id$r' onclick=\"avgangajax('$type', $gittdato)$script\">
						<td class='text-center'><input type='radio' name='$type' id='$type$r' value='$id' class='form-input'></td>
						<td class='text-center'>$franavn ($fraforkortelse)</td>
						<td class='text-center'>$tilnavn ($tilforkortelse)</td>
						<td class='text-center'>$avgangtid - $avgangdato</td>
						<td class='text-center'>$ankomsttid - $ankomstdato</td>
						<td class='text-center'>$pris</td>
						<td class='text-center'>$ledigebilletter</td>
						<td class='text-center'>$flynummer</td>
					</tr>
				";
			}
			$send=false;
			
		}
		if($printdette === ""){
			if($type==="fra"){
				echo tilbakemelding("Ingen flyavganger etter valgt avreise.","danger");
			}
			else{
				echo tilbakemelding("Ingen flyavganger før valgt hjemreise.","danger");
			}
			
		}
		if($printdette !== ""){
			echo "
				<div class='panel panel-default'>
					<div class='panel-heading'><h4>$tur fra <b>$ruteinfo</b>$datoinfo</h4></div>
					<div class='panel-body'>
						<div class='table-responsive'>
							<table class='table table-hover trykkbartabell' id='$idfordatatable'>
								<thead>
									<tr>
										<th class='text-center'>Velg</th>
										<th class='text-center'>Fra</th>
										<th class='text-center'>Til</th>
										<th class='text-center'>Avgang</th>
										<th class='text-center'>Ankomst</th>
										<th class='text-center'>Pris</th>
										<th class='text-center'>Ledige billetter</th>
										<th class='text-center'>Flynummer</th>
									</tr>
								</thead>
							<tbody>
							$printdette
							</tbody>
							</table>
							<hr>
						</div>
					</div>
				</div>";
		}
		
	}
	else{
		if($type=="fra"){
			if($id1 !=="%" || $id2 !=="%")
			{
				if($id1 !=="%" && $id2 !=="%"){
					$sql="SELECT * FROM christensen2.flyplass where id=$id1";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$fra=$rad["navn"];
					$sql="SELECT * FROM christensen2.flyplass where id=$id2";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$til=$rad["navn"];
					echo tilbakemelding("Ingen flyvninger fra <b>$fra</b> til <b>$til</b> i ønsket periode.", "info");
				}
				else if($id1 !=="%"){
					$sql="SELECT * FROM christensen2.flyplass where id=$id1";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$flyplass=$rad["navn"] . " (" . $rad["forkortelse"] . ") " . $rad["by"] . ", " . $rad["land"];
					echo tilbakemelding("Ingen flyvninger fra <b>$flyplass</b> i ønsket periode.", "info");
				}
				else{
					$sql="SELECT * FROM christensen2.flyplass where id=$id2";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$flyplass=$rad["navn"] . " (" . $rad["forkortelse"] . ") " . $rad["by"] . ", " . $rad["land"];
					echo tilbakemelding("Ingen flyvninger til <b>$flyplass</b> i ønsket periode.", "info");
				}
			}

		}
		if($type=="til"){
			if($id1 !=="%" || $id2 !=="%")
			{
				if($id1 !=="%" && $id2 !=="%"){
					$sql="SELECT * FROM christensen2.flyplass where id=$id1";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$fra=$rad["navn"];
					$sql="SELECT * FROM christensen2.flyplass where id=$id2";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$til=$rad["navn"];
					echo tilbakemelding("Ingen flyvninger fra <b>$fra</b> til <b>$til</b> i ønsket periode.", "info");
				}

				else if($id1 !=="%"){
					$sql="SELECT * FROM christensen2.flyplass where id=$id1";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$flyplass=$rad["navn"];
					echo tilbakemelding("Ingen flyvninger fra $flyplass i ønsket periode.", "info");
				}
				else{
					$sql="SELECT * FROM christensen2.flyplass where id=$id2";
					$svar=mysqli_query($db,$sql);
					$rad=mysqli_fetch_array($svar);
					$flyplass=$rad["navn"];
					echo tilbakemelding("Ingen flyvninger til $flyplass i ønsket periode.", "info");
				}
			}
		}
	}
}

function selectfraflyplass1()
{
	global $db;
	echo "
	<fieldset class='form-group' id='fraf'>
		<label class='control-label' id='avgangflyplasslabel'>Fly fra</label>
			<select class='form-control' name='fra' id='fra' onchange='dependantflyplass(this.value)'>";
		$sql="select flyplass.id, flyplass.navn, flyplass.forkortelse, flyplass.land, flyplass.by from flight f join rute r on r.id=f.rute_id join flyplass on flyplass.id=r.avgang_fp group by flyplass.navn;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		echo "<option value=''> - Velg flyplass - </option>";
		for($r=1;$r<=$antall;$r++){
			$rad=mysqli_fetch_array($svar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$by=$rad["by"];
			$land=$rad["land"];
			$forkortelse=$rad["forkortelse"];
			echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
		}
	echo "
	</select></fieldset>";
}

function selecttilflyplass1($fra=null)
{
	global $db;
	echo "
<fieldset class='form-group' id='tilf'>
	<label class='control-label' id='ankomstflyplasslabel'>Fly til</label>
		<select class='form-control' name='til' id='til' onchange='valider(this.value, this.id)'>";
	if(is_null($fra)){
		echo "<option value=''> - Velg avreise først - </option>";
	}
	else{
		
		$sql="select flyplass.id, flyplass.navn, flyplass.forkortelse, flyplass.land, flyplass.by from flight f join rute r on r.id=f.rute_id join flyplass on flyplass.id=r.ankomst_fp where r.avgang_fp=$fra group by flyplass.navn;";
		$svar=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($svar);
		if($antall>0){
			echo "<option value=''>- Velg flyplass -</option>";
			for($r=1;$r<=$antall;$r++){
				$rad=mysqli_fetch_array($svar);
				$id=$rad["id"];
				$navn=$rad["navn"];
				$by=$rad["by"];
				$land=$rad["land"];
				$forkortelse=$rad["forkortelse"];
				if(!$ikkevis){
					echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
				}
				else{
					if(!($id==$ikkevis)){
						echo "<option value='$id'>$navn, $by ($forkortelse), $land</option>";
					}

				}

			}
		}
		else{
			echo "<option value=''> - Ingen flyvninger fra valgt flyplass - </option>";
		}
		
	}
	echo "
	</select></fieldset>";
}
?>
