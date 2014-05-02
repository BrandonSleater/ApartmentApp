<?php include 'php/model.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Headers -->
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="CST433 Final Project: Queries with the Selenium Apartment Database">
	    <meta name="author" content="Brandon Sleater, Joseph Stratton, Dominic Smith">
	    <title>Selenium Apartments</title>

		<!-- JQuery -->
		<script src="https://code.jquery.com/jquery-2.1.0.min.js" defer></script>

		<!-- A sexy slider -->
		<link rel="stylesheet" href="css/flexslider.css" type="text/css">
		<script src="js/flexslider.js" defer></script>

		<!-- Bootstrap -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" defer></script>

		<!-- Selenium Styling -->
		<link href="css/style.css" rel="stylesheet">
		<script src="js/script.js" defer></script>
	</head>

	<body>
    
		<!-- Navigation -->
		<div class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px">
 			<div class="container">
				<a href="#" class="navbar-brand">Selenium Apartments</a> 
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse"></button>

				<div class="collapse navbar-collapse navHeaderCollapse">
					<ul class="nav navbar-nav navbar-right">
				    	<li class="active"><a href="index.php">Home</a></li>
				      <li><a href="about.php">About</a></li>
				      <li><a href="contact.php">Contact</a></li>
				  </ul>
				</div>
			</div>
		</div>

		<div class="container apt-form">
			<div class="text-center col-md-12">
				<h2>Search for Apartments</h2>
				<hr class="hr-style1">
			</div>
			<form class="form-horizontal col-md-5" style="" role="form" name="apt-search" id="apt-search" action="php/test.php" method="POST">
				<!-- Select Basic -->
				<div class="form-group frm-inp-sm" style="margin-top: 20px">
				  	<label class="col-md-6 control-label" for="plan">Floor Plan:</label>
				  	<div class="col-md-4">
					    <select id="plan" name="plan" class="form-control input-large">
					      <option value="1">1 Bedroom</option>
					      <option value="2">2 Bedroom</option>
					      <option value="3">Studio</option>
					    </select>
				  	</div>
				</div>

				<div class="form-group frm-inp-sm">
				  	<label class="col-md-6 control-label" for="window">Window:</label>
				  	<div class="col-md-3">
					    <select id="window" name="window" class="form-control input-large">
					      <option value="1">North</option>
					      <option value="2">East</option>
					      <option value="3">West</option>
					    </select>
				  	</div>
				</div>

				<!-- Multiple Checkboxes -->
				<div class="form-group frm-inp-sm">
				  	<label class="col-md-6 control-label" for="util">Utilities:</label>
				  	<div class="col-md-4">
					  	<div class="checkbox">
					    	<label for="util-0">
					      		<input type="checkbox" name="util" id="util-0" value="1"> Washer/Dryer
					    	</label>
						</div>
					  	<div class="checkbox">
					    	<label for="util-1">
					      		<input type="checkbox" name="util" id="util-1" value="2"> Patio/Balcony
					    	</label>
						</div>
				  	</div>
				</div>

				<!-- Multiple Checkboxes -->
				<div class="form-group">
		  			<label class="col-md-6 control-label" for="kitchen">Kitchen:</label>
		  			<div class="col-md-4">
		  				<div class="checkbox">
			    			<label for="kitchen-0">
			      				<input type="checkbox" name="kitchen" id="kitchen-0" value="1"> Microwave
			   				</label>
						</div>
		  				<div class="checkbox">
			    			<label for="kitchen-1">
			      				<input type="checkbox" name="kitchen" id="kitchen-1" value="2"> Fridge
			    			</label>
						</div>
		  			</div>
				</div>

				<!-- Button -->
				<div class="form-group">
		 			<div class="col-md-8 col-md-offset-3 text-center">
		    			<button id="search" name="search" class="btn btn-primary btn-block" style="margin: -15px 0 0 5px">Search</button>
		  			</div>
				</div>
			</form>

			<div class="col-md-6 pull-right">
				<div class="flexslider">
				  	<ul class="slides">
				    	<li>
				    		<img src="images/1bed.png" />
					    </li>
					    <li>
				      		<img src="images/2bed.png" />
					    </li>
					    <li>
				      		<img src="images/studio.png" />
				    	</li>
				  	</ul>
				</div>
			</div>

			<!-- End Search Form-->
	       
	        <div class="container" id="srch-result" style="display: none">
		        <div class="row">
		        	<div class="col-md-12">
		            	<h1>Search Results:</h1><hr>
		          	</div>
		        </div>

				<div class="row" id="search-results"></div>
			</div>
		</div>

		<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
	</body>
</html>
