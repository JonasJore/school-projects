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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

		<!-- Angular Material requires Angular.js Libraries -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script>
	  
		<!-- Angular Material Library -->
		<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>

		
		
		<script>
			var app = angular.module("showTodos", [], function($interpolateProvider) { $interpolateProvider.startSymbol('<%'); $interpolateProvider.endSymbol('%>'); });
			app.controller("todoController", function($scope) {
				$scope.todosList = ["todo1","todo2","todo3"];
			});
		</script>


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
						<li><a href="project">New Project</a></li>
						<li><a href="#">New Workshop</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<div class="container p-4">
				<div class="col-md-3"> <!-- Left Column -->
					<h3>New Workshop</h3>
					<form>
						<div class="row">
							<div class="col-md-12 col-sm-12 form-group">
								<select class="form-control" id="exampleFormControlSelect1">
									<option value="" disabled selected>Choose project</option>
									<option>1</option>
									<option>2</option>
								</select>
							</div>
						</div>
						
						
						
						<div class="row">
							<div class="col-md-12 col-sm-12 form-group">
									<h3>Project deadline</h3>
								<input type="date" name="datepicker" id="datepicker" /> 
							</div>
						</div>





						<div class="row">
							<div class="col-md-6 col-sm-12 form-group">
								<button type="submit" class="form-control btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div> <!-- Left Column end -->
		
			<div class="col-md-3 offset-md-1"> <!-- Middle Column -->
				<form>
					<div class="row">
						<div class="col-md-12 form-group">
    						<h3 for="CardText">Add Card</h3>
							<textarea class="form-control" id="cardText" rows="15"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12 form-group">
							<button type="submit" class="form-control btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div> <!-- Middle Column end -->
			
			<div class="col-md-4 offset-md-1"> <!-- Right Column -->
				<h3>Backlog</h3>
				<div class="row w-100 h-75">
					<div class="border border-primary w-100 h-75 rounded board"> <!-- Board -->
						<div ng-app="showTodos" ng-controller="todoController" class="row justify-content-md-center p-1"> <!-- Card element -->
							<div ng-repeat="todo in todosList" class="border rounded w-85 p-1">
								<h6><% todo %></h6>
								<small><% todo %> angular is doing this</small>
							</div>
						</div> <!-- Card element stop -->
					</div> <!-- Board end -->
			</div> <!-- Right Column end -->
		
		</div>

		

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	</body>
</html>