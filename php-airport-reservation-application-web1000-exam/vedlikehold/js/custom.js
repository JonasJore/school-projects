function erdusikker(){
	return confirm ('Er du sikker?');
}

function valider(verdi, id, antall){
	var span = document.getElementById(id + "s" + antall);
	var fieldset = document.getElementById(id + "f" + antall);
	if(antall === undefined || antall=='ingen'){
		var span = document.getElementById(id + "s");
		var fieldset = document.getElementById(id + "f");
	}
	var bokstaver =  /^[A-Z,ø,Ø,æ,Æ,å,Å, ,a-z]+$/;
	var tall =  /^[0-9]+$/;
	var retningsnummerinput =  /^[0-9+]+$/;
	var brukernavn = /^[A-Z,ø,Ø,æ,Æ,å,Å, ,a-z,0-9]+$/;
	var epost = /\S+@\S+\.\S+/;
	var inputid = document.getElementById(id);
	if(id === "retningsnummer"){
		if (verdi ==""){
			fieldset.className ="form-group";
			span.className ="";
		}
		else{
			if(retningsnummerinput.test(verdi) && verdi.length <6){
				fieldset.className ="form-group has-success has-feedback";
				span.className ="glyphicon glyphicon-ok form-control-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
				span.className ="glyphicon glyphicon-remove form-control-feedback";
			}
		}
	}
	if(id==="passord2" || id==="passord1"){
		var passord1 = document.getElementById("passord1");
		var passord2 = document.getElementById("passord2");
		var span1 = document.getElementById(passord1.id + "s");
		var fieldset1 = document.getElementById(passord1.id + "f");
		var span2 = document.getElementById(passord2.id + "s");
		var fieldset2 = document.getElementById(passord2.id + "f");
		if(!(passord1.value == "" || passord2.value == "")){
			if(passord1.value === passord2.value){

				span1.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset1.className ="form-group has-success has-feedback";
				span2.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset2.className ="form-group has-success has-feedback";
				var tilbakemelding = document.getElementById("bekreftpassord");
				tilbakemelding.innerHTML = "Passord bekreftet";
			}
			else{
				span1.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset1.className ="form-group has-error has-feedback";
				span2.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset2.className ="form-group has-error has-feedback";
				var tilbakemelding = document.getElementById("bekreftpassord");
				tilbakemelding.innerHTML = "Passord stemmer ikke";
			}
		}
		else{
			span1.className ="";
			fieldset1.className ="form-group ";
			span2.className ="";
			fieldset2.className ="form-group ";
			var tilbakemelding = document.getElementById("bekreftpassord");
			tilbakemelding.innerHTML = "Bekreft passord";
		}

	}

	if(id === "datoflight" || id === "klokkeslettflight"){
		var dato = document.getElementById("datoflight");
		var klokkeslett = document.getElementById("klokkeslettflight");
		if(!(dato.value == "" || klokkeslett.value == "")){
			var fieldset = document.getElementById("datotimef");
			fieldset.className ="form-group has-success has-feedback";
		}
		else{
			var fieldset = document.getElementById("datotimef");
			fieldset.className ="form-group";
		}
	}
	if(id === "klokkeslett"){
		if (verdi ==""){
			fieldset.className ="form-group";
			span.className ="";
		}
		else{
			if(verdi.length == 5){
				fieldset.className ="form-group has-success has-feedback";
				span.className ="glyphicon glyphicon-ok form-control-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
				span.className ="glyphicon glyphicon-remove form-control-feedback";
			}
		}
	}
	if(id==="avgangflyplass" || id==="ankomstflyplass"){
		var avgangflyplass = document.getElementById("avgangflyplass");
		var ankomstflyplass = document.getElementById("ankomstflyplass");
		if(!(avgangflyplass.value == "" || ankomstflyplass.value == "")){
			if(!(avgangflyplass.value === ankomstflyplass.value)){
				var fieldset = document.getElementById(avgangflyplass.id + "f");
				fieldset.className ="form-group has-success has-feedback";
				var fieldset = document.getElementById(ankomstflyplass.id + "f");
				fieldset.className ="form-group has-success has-feedback";

			}
			else{
				var fieldset = document.getElementById(avgangflyplass.id + "f");
				fieldset.className ="form-group has-error has-feedback";
				var fieldset = document.getElementById(ankomstflyplass.id + "f");
				fieldset.className ="form-group has-error has-feedback";
			}
		}
		else{
			var fieldset = document.getElementById(avgangflyplass.id + "f");
			fieldset.className ="form-group";
			var fieldset = document.getElementById(ankomstflyplass.id + "f");
			fieldset.className ="form-group";
		}

	}
	if(id === "flyplass1" || id === "flyplass2"){
		var flyplass1 = document.getElementById("flyplass1");
		var flyplass2 = document.getElementById("flyplass2");
		if(!(flyplass1.value == "" || flyplass2.value == "")){
			if(!(flyplass1.value === flyplass2.value)){
				var fieldset = document.getElementById(flyplass1.id + "f");
				fieldset.className ="form-group has-success has-feedback";
				var fieldset = document.getElementById(flyplass2.id + "f");
				fieldset.className ="form-group has-success has-feedback";

			}
			else{
				var fieldset = document.getElementById(flyplass1.id + "f");
				fieldset.className ="form-group has-error has-feedback";
				var fieldset = document.getElementById(flyplass2.id + "f");
				fieldset.className ="form-group has-error has-feedback";
			}
		}
		else{
			var fieldset = document.getElementById(flyplass1.id + "f");
			fieldset.className ="form-group";
			var fieldset = document.getElementById(flyplass2.id + "f");
			fieldset.className ="form-group";
		}
	
	}
	if(id=== "beskrivelse"){
		if (verdi ==""){
			fieldset.className ="form-group";
		}
		else{
			if(verdi.length >= 1){
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id=== "kjonninput"){
		if (verdi ==""){
			fieldset.className ="form-group";
		}
		else{
			if(bokstaver.test(verdi)){
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id === "pris"){
		if (verdi ==""){
			fieldset.className ="form-group";
		}
		else{
			if(verdi.length <= 3 && verdi.length > 0 && tall.test(verdi) && verdi <= 100&& !isNaN(verdi)){
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id === "billettpris"){
		if (verdi ==""){
			fieldset.className ="form-group";
			span.className ="";
		}
		else{
			if(verdi.length <= 5 && verdi.length > 0 && tall.test(verdi) && !isNaN(verdi)){
				fieldset.className ="form-group has-success has-feedback";
				span.className ="glyphicon glyphicon-ok form-control-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
				span.className ="glyphicon glyphicon-remove form-control-feedback";
			}
		}
	}
	if(id === "brukernavn"){
		if (verdi ==""){
			span.className ="";
			fieldset.className ="form-group ";
		}
		else{
			if(brukernavn.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id === "flynummer"){
		if (verdi ==""){
			span.className ="";
			fieldset.className ="form-group ";
		}
		else{
			if(verdi.length < 10 && brukernavn.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id === "kapasitet"){
		if (verdi ==""){
			span.className ="";
			fieldset.className ="form-group ";
		}
		else{
			if(tall.test(verdi) && verdi.length <= 3){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id === "modell"){
		if (verdi ==""){
			span.className ="";
			fieldset.className ="form-group ";
		}
		else{
			if(brukernavn.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id === "forkortelse"){
		var forkortelse = verdi.toUpperCase();
		inputid.value = forkortelse;
		if (verdi ==""){
			span.className ="";
			fieldset.className ="form-group ";
		}
		else{
			if(bokstaver.test(verdi) && verdi.length ===3){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}
	}
	if(id === "navn" || id === "land" || id === "by"){
		var ord = inputid.value.split(" ");
		for(var r=0; r < ord.length; r++){
			var alt = ord[r].toLowerCase();
			var deler = ord[r].charAt(0).toUpperCase();
			ord[r] = deler + alt.substr(1);
		}
		var ferdigord = ord.join(" ");
		inputid.value = ferdigord;

		if (verdi ==""){
			span.className ="";
			fieldset.className ="form-group";
		}
		else{
			if(verdi.length >=2 && bokstaver.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
	if(id === "fornavn"){
		var ord = inputid.value.split(" ");
		for(var r=0; r < ord.length; r++){
			var alt = ord[r].toLowerCase();
			var deler = ord[r].charAt(0).toUpperCase();
			ord[r] = deler + alt.substr(1);
		}
		var ferdigord = ord.join(" ");
		inputid.value = ferdigord;

		if (verdi ==""){
			span.className ="form-group";
			fieldset.className ="form-group";
		}
		else{
			if(verdi.length >=2 && bokstaver.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
	if(id === "etternavn"){
		var ord = inputid.value.split(" ");
		for(var r=0; r < ord.length; r++){
			var alt = ord[r].toLowerCase();
			var deler = ord[r].charAt(0).toUpperCase();
			ord[r] = deler + alt.substr(1);
		}
		var ferdigord = ord.join(" ");
		inputid.value = ferdigord;

		if (verdi ==""){
			span.className ="form-group";
			fieldset.className ="form-group";
		}
		else{
			if(verdi.length >= 2 && bokstaver.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
	if(id === "epost"){
		if (verdi ==""){
			span.className ="form-group";
			fieldset.className ="form-group";
		}
		else{
			if(epost.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
	if(id === "pass"){
		if (verdi ==""){
			span.className ="form-group";
			fieldset.className ="form-group";
		}
		else{
			if(verdi.length >= 8 && tall.test(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
	if(id === "tlf"){
		if (verdi =="")
		{
			span.className ="form-group";
			fieldset.className ="form-group";
		}
		else{
			if(verdi.length >= 8 && !isNaN(verdi)){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
	if(id === "flytid"){
		if (verdi =="")
		{
			span.className ="form-group";
			fieldset.className ="form-group";
		}
		else{
			if(tall.test(verdi) && verdi.length < 6){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
		if(id === "flybillettpris"){
		if (verdi =="")
		{
			span.className ="form-group";
			fieldset.className ="form-group";
		}
		else{
			if(tall.test(verdi) && verdi.length < 8){
				span.className ="glyphicon glyphicon-ok form-control-feedback";
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				span.className ="glyphicon glyphicon-remove form-control-feedback";
				fieldset.className ="form-group has-error has-feedback";
			}
		}

	}
	if(id === "nasjonalitet" || id === "kjonn" || id === "prisgruppe" || id === "flytype" || id === "flyselskap"){
		if (verdi ==""){
			fieldset.className ="form-group";
		}
		else{
			fieldset.className ="form-group has-success has-feedback";
		}

	}

	if(id === "rute"|| id === "fly"){
		if (verdi ==""){
			fieldset.className ="form-group";
		}
		else{
			fieldset.className ="form-group has-success has-feedback";
		}

	}
	
	
	if(id === "dato1uavhengig"){
		if(verdi ===""){
			fieldset.className ="form-group";
		}
		else{
			var datostr = verdi.split(".",3);
			var dag = datostr[0];
			var mnd = datostr[1];
			var aar = datostr[2];
			var dato = Date.parse(mnd +"."+ dag+"." + aar);
			var dagensdato = new Date();
			dagensdato.setHours(0,0,0,0);
			if(dato >= dagensdato){
				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
			}
			
		}
	}
	
	if(id === "dato1"){
		if(verdi ===""){
			fieldset.className ="form-group";
		}
		else{
			var datostr = verdi.split(".",3);
			var dag = datostr[0];
			var mnd = datostr[1];
			var aar = datostr[2];
			var dato = Date.parse(mnd +"."+ dag+"." + aar);
			var dagensdato = new Date();
			dagensdato.setHours(0,0,0,0);
			if(dato >= dagensdato){

				fieldset.className ="form-group has-success has-feedback";
				var dato2 = document.getElementById("dato2");
				var dato2fieldset = document.getElementById("dato2f");
				if(dato2.value !==""){
					var dato2str = dato2.value.split(".",3);
					var dag = dato2str[0];
					var mnd = dato2str[1];
					var aar = dato2str[2];
					var dato2dato = Date.parse(mnd +"."+ dag+"." + aar)
					if(dato2dato){
						if(dato2dato >= dato){
							dato2fieldset.className ="form-group has-success has-feedback";
						}
						else{
							dato2fieldset.className ="form-group has-error has-feedback";
						}
						
				
					}
				}
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
			}
			
		}

	}
	if(id === "dato2"){
		if(verdi ===""){
			fieldset.className ="form-group";
		}
		else{
			var dato1 = document.getElementById("dato1");
			var dato1str = dato1.value.split(".",3);
			var dag = dato1str[0];
			var mnd = dato1str[1];
			var aar = dato1str[2];
			var dato1 = Date.parse(mnd +"."+ dag+"." + aar);
			var dato2str = verdi.split(".",3);
			var dag = dato2str[0];
			var mnd = dato2str[1];
			var aar = dato2str[2];
			var dato2 = Date.parse(mnd +"."+ dag+"." + aar)
			if(dato2 >= dato1){

				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
			}
			
		}
	}
	if(id === "dato"){
		if(verdi ===""){
			fieldset.className ="form-group";
		}
		else{
			var dato = document.getElementById(id);
			var dato1str = dato.value.split(".",3);
			var dag = dato1str[0];
			var mnd = dato1str[1];
			var aar = dato1str[2];
			var dato = Date.parse(mnd +"."+ dag+"." + aar);
			if(dato){

				fieldset.className ="form-group has-success has-feedback";
			}
			else{
				fieldset.className ="form-group has-error has-feedback";
			}
			
		}
	}
}

function slett()
{
	return confirm("Er du sikker på at du sletter riktig?");
}
function flyavgangerajax(filtrer){
	var foresporsel=new XMLHttpRequest();
	foresporsel.onreadystatechange=function(){
		if (foresporsel.readyState==4 && foresporsel.status==200){
			document.getElementById("flyavgangerajaxsvar").innerHTML=foresporsel.responseText;
		}
	}
	foresporsel.open("GET","flyavgangerajax.php?filtrer="+filtrer);
	foresporsel.send();
}
function visruteinfo(id){
	var visrutediv = document.getElementById("visruteinfo");
	if(id==""){
		visrutediv.className="";
		visrutediv.innerHTML="";
	}
	else{
		var foresporsel=new XMLHttpRequest();
		foresporsel.onreadystatechange=function(){
		if (foresporsel.readyState==4 && foresporsel.status==200){
			visrutediv.innerHTML=foresporsel.responseText;
		}
		}
		foresporsel.open("GET","script/ruteinfoajax.php?id="+id);
		foresporsel.send();
		visrutediv.className="well";
	}
}
function visflyinfo(id){
	var visflydiv = document.getElementById("visflyinfo");
	if(id==""){
		visflydiv.className="";
		visflydiv.innerHTML="";
	}
	else{
		var foresporsel=new XMLHttpRequest();
		foresporsel.onreadystatechange=function(){
		if (foresporsel.readyState==4 && foresporsel.status==200){
			visflydiv.innerHTML=foresporsel.responseText;
		}
		}
		foresporsel.open("GET","script/flyinfoajax.php?id="+id);
		foresporsel.send();
		visflydiv.className="well";
	}
}

function minbookingajax(referansenummer){
	var foresporsel=new XMLHttpRequest();
	foresporsel.onreadystatechange=function(){
		if (foresporsel.readyState==4 && foresporsel.status==200){
			document.getElementById("referansenummerajax").innerHTML=foresporsel.responseText;
		}
	}
	foresporsel.open("GET","minbookingajax.php?referansenummer="+referansenummer);
	foresporsel.send();
}


function hentgetfraurl() {
		var get = {};
		var deler = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			get[key] = value;
		});
		return get;
}
function leggtilflightajax(value){
 $.ajax({
   type:'GET',
   url:'script/legg-til-flightajax.php',
   data:'gjentagende='+value,
   success:function(html){
	   $('#leggtilflightajaxsvar').html(html);
	   refreshdatepicker();
   }
});
}
function antallajax(id){
	var input = document.getElementById(id).value;
	if(input == 10){
		var foresporsel=new XMLHttpRequest();
		foresporsel.onreadystatechange=function(){
			if (foresporsel.readyState==4 && foresporsel.status==200){
				document.getElementById("antallajax").innerHTML=foresporsel.responseText;
			}
		}
		foresporsel.open("GET","script/ajax/antallajax.php?antall="+input);
		foresporsel.send();
	}
	else{
		$('#antallajax').html("");
	}

}	

function antallflyvningerajax(value){

	var antall = document.getElementById(value);
	var verdi = antall.value;
	var foresporsel=new XMLHttpRequest();
	foresporsel.onreadystatechange=function(){
		if (foresporsel.readyState==4 && foresporsel.status==200){
			document.getElementById("antallflyvningerajax").innerHTML=foresporsel.responseText;
		}
	}
	foresporsel.open("GET","script/ajax/antallflyvningerajax.php?antallperuke="+verdi);
	foresporsel.send();
}



function validerform(){
	var feil = document.getElementsByClassName("has-error").length;
	if(feil>0){
		return false;
	}
	else{
		return true;
	}
}
function togglemeg(id,toggle)
{
	var toggleid = document.getElementById(toggle);
	var pil = document.getElementById("i-" + id);
	var opp = "pull-right glyphicon glyphicon-chevron-right";
	var ned = "pull-right glyphicon glyphicon-chevron-down";
	if (toggleid.style.display !== 'none'){
		toggleid.style.display = 'none';
		pil.className = opp;
    }
    else{
		toggleid.style.display = 'block';
		pil.className = ned;
    }

}
function hentforms(value){
	var r;
	var verdier="";
	var inkluder = value.split(";");
	for (r=0; r < inkluder.length; r++){
		var verdier = verdier + inkluder[r] + "=true&";
	}
	var foresporsel=new XMLHttpRequest();
	foresporsel.onreadystatechange=function(){
	if (foresporsel.readyState==4 && foresporsel.status==200){
		document.getElementById("hovedinnhold").innerHTML=foresporsel.responseText;
		}
	}
	foresporsel.open("GET","script/forms.php?"+verdier);
	foresporsel.send();
}

function plussminus(id,felt)
{
	var antall = document.getElementById(felt);
	var verdi = antall.parseInt(value);
	if (verdi < 0)
	{
		verdi = 0;
	}
	if(id=="pluss"){
		var sum = verdi + 1;
		antall.value = sum;
	}
	if(id=="minus"){
		if(verdi >1)
		{
			var sum = verdi - 1;
			antall.value = sum;
		}
	}
}
function plussminusmax10(id,felt)
{
	var antall = document.getElementById(felt);
	var verdi = parseInt(document.getElementById(felt).value);
	if (verdi < 0 || verdi > 10)
	{
		verdi = 0;
	}
	if(id=="pluss"){
		if(verdi < 10){
			var sum = verdi + 1;
			antall.value = sum;	
		}
	}
	if(id=="minus"){
		if(verdi >1){
			var sum = verdi - 1;
			antall.value = sum;
		}
	}
}
function velgmegffs(type,id){
	var knapp = document.getElementById(type);
	knapp.checked = true;
}
function flyplassavhengighet(value, fra){
	if(fra ==="avgang"){
		var id = "tilflyplassdependant";
		var avgang = document.getElementById("avgangflyplass").value;
		if(avgang !=="%"){
			$.ajax({
			   type:'GET',
			   url:'script/flyplassavhengighet.php',
			   data:'fra='+fra + '&til='+value,
			   success:function(html){
				   $('#' + id).html(html);
			   }
			});
		}
	}
	if(fra === "ankomst"){
		var id = "fraflyplassdependant";
		var avgang = document.getElementById("avgangflyplass").value;
		if(avgang !=="%"){
			$.ajax({
			   type:'GET',
			   url:'script/flyplassavhengighet.php',
			   data:'fra='+fra + '&til='+value,
			   success:function(html){
				   $('#' + id).html(avgang);
			   }
			});
		}
	}
	
	
}
$('#fraavgang .trykkbartabell').on('click', '.trykkbar', function(event) {
$(this).addClass('success').siblings().removeClass('success');
});

$('#tilavgang .trykkbartabell').on('click', '.trykkbar', function(event) {
$(this).addClass('success').siblings().removeClass('success');
});

$(document).ready(function(){
  $("#enkeltreise").click(function(){
    $("#dato").hide(100);
  });
  $("#tur-retur").click(function(){
    $("#dato").show(100);
  });
});
$(document).ready(function(){
   $('#avreisested').on('change',function(){
       var avreisested = $(this).val();
       if(avreisested)
       {
           $.ajax({
               type:'POST',
               url:'avreisested.php',
               data:'avreisested='+avreisested,
               success:function(html){
                   $('#ankomststed').html(html);
               }
           });
       }
       else
       {
           $("#ankomststed").html("<option value=''>Velg avgang først</option>");
       }
   });
});;
function dependantflyplass(fra){
	if(fra ==""){
		$.ajax({
               type:'POST',
               url:'script/ajax/selecttilflyplassajax.php',
               success:function(html){
                   $('#selecttilflyplass1').html(html);
               }
           });
	}
	else{
		 $.ajax({
               type:'POST',
               url:'script/ajax/selecttilflyplassajax.php?fra=' + fra,
               success:function(html){
                   $('#selecttilflyplass1').html(html);
               }
           });
	}
}
function refreshdatepicker() {
    jQuery('#ui-datepicker-div').remove();
	$( ".hentdatepicker" ).datepicker({dateFormat: "dd.mm.yy"});
}
 $(function() {
    $( ".hentdatepicker" ).datepicker({dateFormat: "dd.mm.yy"});
  });

function avgangajax(kommerfra, timestamp){
	var av = hentgetfraurl()["av"];
	var an = hentgetfraurl()["an"];
	var turretur = hentgetfraurl()["turretur"];
	var ant = hentgetfraurl()["ant"];
	var fra = hentgetfraurl()["fra"];
	var til = hentgetfraurl()["til"];
	var verdier="av=" + av + "&an=" + an + "&turretur=" + turretur + "&ant=" + ant + "&til=" + til + "&tid=" + timestamp + "&fra=" + fra + "&kommerfra=" + kommerfra;
	if(kommerfra === "fra"){
		if($('input[name=til]:checked').length === 0){
			 $.ajax({
			   type:'GET',
			   url:'script/flyavgangeravhengigeavhverandreajax.php?' + verdier,
			   success:function(html){
					$('#fraavgang').html(html);
			   }
			});
		}
	}
	if(kommerfra === "til"){
			 $.ajax({
			   type:'GET',
			   url:'script/flyavgangeravhengigeavhverandreajax.php?' + verdier,
			   success:function(html){
					$('#tilavgang').html(html);
			   }
			});
	}
	
}
var element_to_scroll_to = document.getElementById('finnbilett');
