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
    
		<!-- Search Form -->
		<div class="container" id="top-search">
			<form class="form-horizontal" role="form" name="apt-search" id="apt-search" action="php/test.php" method="POST">
			<fieldset>
			<h1>Search Form:</h1>
			<div class="form-group">
				<input id="name" name="name" type="text" class="form-control" placeholder="Bob Dylan" required>
				<label for="name">Your Name</label>
			</div>

			<div class="form-group">
				<input id="phone" name="phone" type="tel" class="form-control" placeholder="480276842" required>
				<label for="phone">Primary Phone</label>
			</div>

			<div class="form-group">
				<textarea id="message" name="message" class="form-control" placeholder="Some message crap..." required></textarea>
				<label for="message">Message</label>
			</div>
				
					<div class="form-group">
				 	 	<label class="col-md-4 control-label" for="plan">Floor Plan:</label>
				  			<div class="col-md-4">
				   		 		<select id="plan" name="plan" class="form-control">
				     	 			<option value="1">1 Bedroom</option>
				      				<option value="2">2 Bedroom</option>
				      				<option value="3">Studio</option>
				    			</select>
				  			</div>
						</div>

					<div class="form-group">
				  		<label class="col-md-4 control-label" for="direction">Window:</label>
				 	 		<div class="col-md-4">
				   		 	<select id="direction" name="direction" class="form-control">
				     			 <option value="1">North</option>
				      			<option value="2">East</option>
				      			<option value="3">West</option>
				   		 	</select>
				 	 	</div>
					</div>

					<div class="form-group">
				  		<label class="col-md-4 control-label" for="utilities">Utilities:</label>
				 		 	<div class="col-md-4">
				  				<div class="checkbox">
				   			 		<label for="utilities-0">
				      					<input name="utilities" id="utilities-0" value="1" type="checkbox">
				     			 		Washer/Dryer
				    				</label>
								</div>
				 				 <div class="checkbox">
				    				<label for="utilities-1">
				      					<input name="utilities" id="utilities-1" value="2" type="checkbox">
				      					Patio/Balcony
				    				</label>
								</div>
				  			</div>
					</div>
				<div class="form-group">
				  <label class="col-md-4 control-label" for="cooking">Kitchen</label>
				  <div class="col-md-4">
				  <div class="checkbox">
				   		 <label for="cooking-0">
				      		<input name="cooking" id="cooking-0" value="1" type="checkbox">
				     		 Microwave
				    	</label>
					</div>
				  <div class="checkbox">
				    	<label for="cooking-1">
				      		<input name="cooking" id="cooking-1" value="2" type="checkbox">
				      		Fridge
				   		 </label>
					<div>
				  </div>
					<button class="btn btn-lg btn-default">Submit</button>
					</fieldset>
			</form>
		</div>
       
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
