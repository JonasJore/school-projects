<?php
session_start();
if(!isset($_SESSION["login"])){
	echo"<script>window.open('adminlogin.php', '_self')</script>";
}

include 'script/funksjoner.php';
include 'script/dbtilkobling.php';
$sql="delete from booking where id NOT IN (select booking_id from billett where booking_id is NOT NULL)";// sletter referanser uten tilhørende billetter
mysqli_query($db,$sql);
?><!DOCTYPE html>
<html lang="no">
	<head>
		<meta http-equiv="content-type" content="text/html" charset="utf-8">
		<title>Bjarum Airlines Kontrollpanel</title>
		<meta name="kontrollpanel" content="Bjarum Airlines" />
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
	</head>
<body>
<!-- header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <img class="navbar-brand" src="bilder/litenlogo.png" alt="logo">
            <a class="navbar-brand" href="index.php">Bjarum Airlines - Vedlikehold</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php echo printbrukernavn();?> <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="script/logut.php"><i class="glyphicon glyphicon-off"></i> Logg Ut</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid  maindiv">
    <div class="row">
        <div class="col-sm-2">
            <!-- Left column -->
            <ul class="nav nav-stacked">
              <li class="active"> <a href="index.php"><i class="glyphicon glyphicon-home"></i> Hjem</a></li>
              <hr>
                <li class="nav-header"> <a data-toggle="collapse" data-target="#userMenu1">Meny <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav nav-stacked collapse in" id="userMenu1">
						<!-- OLA TESTER -->
                        <li><a href="flight.php"><i class="glyphicon glyphicon-cog"></i> Flyruter og flyavganger</a></li>
                        <li><a href="booking.php"><i class="glyphicon glyphicon-cog"></i> Booking</a></li>
                        <li><a href="fly.php"><i class="glyphicon glyphicon-cog"></i> Fly</a></li>
                        <li><a href="flyplass.php"><i class="glyphicon glyphicon-cog"></i> Flyplass</a></li>
                        <li><a href="nasjonalitet.php"><i class="glyphicon glyphicon-cog"></i> Nasjonalitet</a></li>
                        <li><a href="prisgruppe.php"><i class="glyphicon glyphicon-cog"></i> Prisgruppe</a></li>
                        <li><a href="kjonn.php"><i class="glyphicon glyphicon-cog"></i> Kjønn</a></li>
                        <li><a href="user.php"><i class="glyphicon glyphicon-cog"></i> Brukere</a></li>
						<li><a href="flyselskap.php"><i class="glyphicon glyphicon-cog"></i> Flyselskap</a></li>
                        <hr>
                    </ul>
                </li>
			</ul>
        </div>


		<div class="col-sm-10" id="hovedinnhold">
