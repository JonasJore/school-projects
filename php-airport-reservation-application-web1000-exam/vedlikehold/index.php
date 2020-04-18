<?php
include 'start.php';
?>
<?php
@$leggtilrute=$_GET["leggtilrute"];
@$leggtilflytype=$_GET["leggtilflytype"];
@$leggtilfly=$_GET["leggtilfly"];
@$leggtilkjonn=$_GET["leggtilkjonn"];
@$leggtilflyplass=$_GET["leggtilflyplass"];
@$leggtilprisgruppe=$_GET["leggtilprisgruppe"];
@$leggtiluser=$_GET["leggtiluser"];
@$leggtilflight=$_GET["leggtilflight"];
@$leggtileier=$_GET["leggtileier"];
@$leggtilflyselskap=$_GET["leggtilflyselskap"];
@$leggtilnasjonalitet=$_GET["leggtilnasjonalitet"];
@$leggtilpassasjer=$_GET["leggtilpassasjer"];
@$endrepassasjer=$_GET["endrepassasjer"];
@$alt=$_GET["alt"];
if($alt)
{
	include 'script/legg-til-rute.php';
	include 'script/legg-til-flight.php';
	include 'script/legg-til-user.php';
	include 'script/legg-til-flytype.php';
	include 'script/legg-til-fly.php';
	include 'script/legg-til-kjonn.php';
	include 'script/legg-til-flyplass.php';
	include 'script/legg-til-prisgruppe.php';
}
if($endrepassasjer){
	include 'script/endre-passasjer.php';
}
if($leggtilpassasjer){
	include 'script/legg-til-passasjer.php';
}
if($leggtilnasjonalitet){
	include 'script/legg-til-nasjonalitet.php';
}
if($leggtilflyselskap){
	include 'script/legg-til-flyselskap.php';
}
if($leggtileier){
	include 'script/legg-til-eier.php';
}
if($leggtilrute){
	include 'script/legg-til-rute.php';
}
if($leggtilflight){
	include 'script/legg-til-flight.php';
}
if($leggtiluser){
	include 'script/legg-til-user.php';
}
if($leggtilflytype){
	include 'script/legg-til-flytype.php';
}
if($leggtilfly){
	include 'script/legg-til-fly.php';
}
if($leggtilkjonn){
	include 'script/legg-til-kjonn.php';
}
if($leggtilflyplass){
	include 'script/legg-til-flyplass.php';
}
if($leggtilprisgruppe){
	include 'script/legg-til-prisgruppe.php';
}
if(empty($_GET)){// INGEN ER VALGT
?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="well">
				<h3>Bjarum Airlines vedlikeholdsapplikasjon</h3>
				<p>
				I vedlikeholdsapplikasjonen kan du administrere databasen tilhørende nettsiden.</br>
				Du kan bla. legge til nye flyavganger, lage nye rabattgrupper eller legge til en ny rute.</br>
				<strong>Let i menyen til venstre etter hva du er på utkikk etter!</strong>
				</p>
			</div>
		</div>
	</div>
	<div class="row">
	<div class="col-md-2"></div>
		<div class="col-md-4">
			<div class='panel panel-default'>
				<?php panelheader("Velkommen " . printbrukernavn()."");?>
					<p><?php sidensist();?></p>
			</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class='panel panel-default'>
				<?php
				panelheader("Informasjon");
				$sql="select count(billettnummer) as id from billett;";
				$antallbilletter=hentid($sql);
				$sql="select count(id) as id from booking;";
				$antallbookinger=hentid($sql);
				$sql="select count(id) as id from flight;";
				$antallflyavganger=hentid($sql);
				$sql="select count(id) as id from flyplass;";
				$antallflyplasser=hentid($sql);
				$sql="select count(id) as id from rute;";
				$antallruter=hentid($sql);
				$sql="select count(id) as id from passasjer;";
				$antallpassasjerer=hentid($sql);
				$sql="select count(id) as id from passasjer where kjonn_id=2;"; // gutter
				$gutter=hentid($sql);
				$antallgutter = (100 / intval($antallpassasjerer)) * intval($gutter);
				$sql="select count(id) as id from passasjer where kjonn_id=3;"; // jenter
				$jenter=hentid($sql);
				$antalljenter = (100 / intval($antallpassasjerer)) * intval($jenter);
				?>
					<div class='table-responsive'>
					<table class='table table-hover table-condensed'>
						<thead>
							<tr>
								<th>Antall</th>
								<th>Sum</th>
							</tr>
						</thead>
					<tbody>
					</tbody>
						<tr><td>Billetter</td><td><?php echo $antallbilletter;?></td></tr>
						<tr><td>Bookinger</td><td><?php echo $antallbookinger;?></td></tr>
						<tr><td>Flyavganger</td><td><?php echo $antallflyavganger;?></td></tr>
						<tr><td>Flyplasser</td><td><?php echo $antallflyplasser;?></td></tr>
						<tr><td>Ruter</td><td><?php echo $antallruter;?></td></tr>
						<tr><td>Passasjerer</td><td><?php echo $antallpassasjerer;?></td></tr>
						<tr><td>Jentepassasjerer</td><td><?php echo $antallgutter;?>%</td></tr>
						<tr><td>Guttepassasjerer</td><td><?php echo $antalljenter;?>%</td></tr>
					</table>
					</div>
				</div>
			</div>
			</div>
			
	<div class="col-md-2"></div>
		</div>
	</div>
<?php
} //ENDER IF'EN
Include 'slutt.php';
 ?>
