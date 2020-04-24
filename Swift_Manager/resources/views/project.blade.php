<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous" />

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<!-- jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<title>Swift Manager</title>
		<!-- <link rel="stylesheet" href="main.css" type="text/css" /> -->

		<style>
			html,body,.full-height {
				height: 100%;
			}

			.height-90 {
				height: 100%;
			}

			.board {
				overflow: hidden;
				overflow-y: scroll;
			}

			.w-85 {
				width: 85%;
			}

			.navbar-fixed-left {
				width: 60px;
				position: fixed;
				border-radius: 0;
				height: 100%;
				z-index: 9;
			}

			.navbar-fixed-left .navbar-nav {
				float: none;
				width: 59px;
			}

			.navbar-fixed-left + .container {
				padding-left: 70px;
			}

			.navbar-fixed-left .navbar-nav > li > .dropdown-menu {
				margin-top: -50px;
				margin-left: 65px;
				z-index: 10;
			}
		</style>
	</head>
	<body>
		<nav class="navbar-inverse navbar-fixed-left">
			<ul class="nav navbar-nav">
				<li>
					<a href="profile">
						<span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="right" title="Profile page"></span> 
					</a>
				</li>
				<li>
					<a href="home">
						<span class="glyphicon glyphicon-home" data-toggle="tooltip" data-placement="right" title="Home page"></span> 
					</a>
				</li>
				<li>
					<a href="board">
						<span class="glyphicon glyphicon-tasks" data-toggle="tooltip" data-placement="right" title="Board page"></span> 
					</a>
				</li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-hashpopup="true" aria-expanded="false">New</span></a>
					<ul class="dropdown-menu">
						<li><a href="#">New Project</a></li>
						<li><a href="workshop">New Workshop</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<div class="container p-4">
			<div class="row justify-content-md-center">
				<h1>New Project</h1>
			</div>
		</div>

		<div class="container p-4">
			<form>
					<div class="col-md-4"> <!-- Left Column -->
						<div class="row">
							<div class="form-group">
    							<label for="projectName">Project Name</label>
								<input type="text" class="form-control" id="projectName">
							</div>
						</div>
						<div class="row">
							<div class="form-group">
    							<label for="customer">Customer Name</label>
								<input type="text" class="form-control" id="customer">
							</div>
						</div>
						<div class="row">
							<div class="form-group">
    							<label for="members">Add Members</label>
								<select class="form-control" id="members">
									<option value="" disabled selected>Choose members</option>
									<option>Jonas Jore</option>
									<option>Marius Wetterlin</option>
								</select>
							</div>
						</div>
					</div> <!-- Left Column end -->



					<div class="col-md-4"> <!-- Middle Column -->
						<label for="description">Description</label>
						<textarea class="form-control" id="description" rows="15"></textarea>
					</div> <!-- Middle Column end -->



					<div class="col-md-4"> <!-- Right Column -->
						<div class="row">
							<label for="from">From Date</label>

						</div>
						<div class="row">
							<label for="to">From Date</label>

						</div>
						<div class="row">
							<button type="submit" class="form-control btn btn-primary">Submit</button>
						</div>
					</div> <!-- Right Column end -->
			</form>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	</body>
</html>