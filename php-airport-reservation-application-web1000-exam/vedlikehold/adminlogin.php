<?php
session_start();
if(@$_SESSION["login"])
{
	echo"<script>window.open('index.php', '_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="no">
  <head>
    <meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/loginn.css" rel="stylesheet">
  </head>
		<body>
    <div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<img class="img-responsive img-rounded" src="bilder/bjarumstorlogo.png" alt="bjarumlogo">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form method="post" class="form-signin">
					<h2 class="form-signin-heading text-center">Logg inn</h2>
					<label for="brukernavn" class="sr-only">Brukernavn</label>
						<input type="text" id="brukernavn" name="brukernavn" class="form-control" placeholder="Brukernavn" required autofocus>
					<label for="passord" class="sr-only">Passord</label>
						<input type="password" id="passord" name="passord" class="form-control" placeholder="Passord" required>
						<input type="submit" class="btn btn-lg btn-primary btn-block" value="Fortsett" name="adminlogin">
				</form>
			</div>
		</div>
    </div>
  </body>
</html>
<?php
@$adminlogin=$_POST["adminlogin"];
if($adminlogin)
{
	include 'script/dbtilkobling.php';
	$brukernavn=$_POST["brukernavn"];
	$passord=$_POST["passord"];
	$sql="select * from user where user='$brukernavn';";
	mysqli_real_escape_string($db,$sql);
	$svar=mysqli_query($db,$sql) or die("Her skjedde det noe feil!");
	$rad=mysqli_fetch_array($svar);
	$passordhashfradb=$rad["password"];
	if(password_verify($passord, $passordhashfradb))
	{
		$login=$rad["login"];
		$_SESSION["brukernavn"]=$brukernavn;
		$_SESSION["login"]=true;
		$_SESSION["sidensist"]=$login;
		echo"<meta http-equiv='refresh' content='0'>";
		$sql="UPDATE user SET `login`=now() WHERE `user`='$brukernavn';";
		mysqli_query($db,$sql) or die("Ikke mulig å sette login.");
	}
	else{
		echo"<script>alert('Email eller passord er feil, prøv igjen!')</script>";
	}
}
?>
