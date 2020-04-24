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
					<a href="#">
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
						<li><a href="project">New Project</a></li>
						<li><a href="workshop">New Workshop</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<div class="container p-4">
				<div class="col-md-4"> <!-- Left Column -->
					<form>
						<div class="row">
							<div class="col-md-12 form-group">
    							<label for="CardText">Add Card</label>
								<textarea class="form-control" id="cardText" rows="10"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12 form-group">
								<select class="form-control" id="exampleFormControlSelect1">
									<option value="" disabled selected>Choose project</option>
									<option>1</option>
									<option>2</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-12 form-group">
								<button type="submit" class="form-control btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div> <!-- Left Column end -->

				<div class="col-md-4"> <!-- Middle Column -->
					
				</div> <!-- Middle Column end -->

				<div class="col-md-4"> <!-- Right Column -->
					<div class="row">
						<label>Active Projects</label>
						<div class="list-group w-85">
							<a href="board" class="list-group-item list-group-item-action">
								<label>Project 1</label>
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</a>
							<a href="#" class="list-group-item list-group-item-action">
								<label>Project 2</label>
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</a>
							<a href="#" class="list-group-item list-group-item-action">
								<label>Project 2</label>
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</a>
						</div>
					</div>
					<br />
					<div class="row">
						<label>Recent Activity</label>
						<div class="list-group">
  							<a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
								<div class="d-flex w-100 justify-content-between">
									<h6 class="mb-1">List group item heading</h6>
									<small>3 days ago</small>
								</div>
								<p class="mb-1">this box is used to display recent activity</p>
								<small>the person who made the change</small>
							</a>
							<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
								<div class="d-flex w-100 justify-content-between">
									<h6 class="mb-1">List group item heading</h6>
									<small class="text-muted">3 days ago</small>
								</div>
								<p class="mb-1">this box is also used to display recent activity</p>
								<small>the person who made the change</small>
							</a>
						</div>
					</div>
				</div> <!-- Right Column end -->
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	</body>
</html>