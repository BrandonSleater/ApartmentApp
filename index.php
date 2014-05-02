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

		<!-- Bootstrap -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" defer></script>

		<!-- Selenium Styling -->
		<link href="css/style.css" rel="stylesheet">
		<script src="js/script.js" defer></script>
	</head>

	<body>
    
		<!-- Navigation -->
		<div class="navbar navbar-inverse navbar-static-top" style="margin-bottom: 0px">
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

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="plan">Floor Plan:</label>
		  <div class="col-md-6">
		    <select id="plan" name="plan" class="form-control input-large">
		      <option value="1">1 Bedroom</option>
		      <option value="2">2 Bedroom</option>
		      <option value="3">Studio</option>
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="window">Window:</label>
		  <div class="col-md-6">
		    <select id="window" name="window" class="form-control input-large">
		      <option value="1">North</option>
		      <option value="2">East</option>
		      <option value="3">West</option>
		    </select>
		  </div>
		</div>

		<!-- Multiple Checkboxes -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="util">Utilities:</label>
		  <div class="col-md-4">
		  <div class="checkbox">
		    <label for="util-0">
		      <input type="checkbox" name="util" id="util-0" value="1">
		      Washer/Dryer
		    </label>
			</div>
		  <div class="checkbox">
		    <label for="util-1">
		      <input type="checkbox" name="util" id="util-1" value="2">
		      Patio/Balcony
		    </label>
			</div>
		  </div>
		</div>

		<!-- Multiple Checkboxes -->
		<div class="form-group">
  		<label class="col-md-4 control-label" for="kitchen">Kitchen:</label>
  			<div class="col-md-4">
  				<div class="checkbox">
    			<label for="kitchen-0">
      				<input type="checkbox" name="kitchen" id="kitchen-0" value="1">
      				Microwave
   				</label>
			</div>
  			<div class="checkbox">
    			<label for="kitchen-1">
      				<input type="checkbox" name="kitchen" id="kitchen-1" value="2">
     				 Fridge
    			</label>
			</div>
  		</div>
		</div>

		<!-- Button -->
		<div class="form-group">
  		<label class="col-md-4 control-label" for="search">Submit</label>
 			<div class="col-md-4">
    			<button id="search" name="search" class="btn btn-primary">Search</button>
  			</div>
		</div>

		<!-- End Search Form-->
       
        <div class="container">
	        <div class="row">
	        	<div class="col-md-12">
	            	<h1>Search Results:</h1><hr style="border-color: #7F8C8D">
	          	</div>
	        </div>

			<div class="row" id="search-results"></div>
		</div>

		<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

  		<div class="navbar navbar-default navbar-fixed-bottom">
    		<div class="container">
    			<img class="redman" src="images/reddit-man.png" alt="Our little boy">
    			
      			<p class="navbar-text pull-left">CST433 - Brandon Sleater, Joseph Stratton & Dominic Smith - April 2014</p>
      
      			<a href="#" class="navbar-btn btn-danger btn pull-right">
      				<span class="glyphicon glyphicon-star"></span>  Rent Now!
      			</a>
    		</div>
		</div>
	</body>
</html>
