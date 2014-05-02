<?php include 'php/model.php'; ?>

<!DOCTYPE html>
<html>
	<?php include 'php/head.php'; ?>

	<body>
    
		<?php 
			include 'php/nav.php'; 

			nav(1);
		?>

		<div class="container apt-form">
			<div class="text-center col-md-12">
				<h2>Create New Apartment</h2>
				<hr class="hr-style1">
			</div>
			<form class="form-horizontal col-md-10" style="" role="form" name="apt-search" id="apt-search" action="php/test.php" method="POST">
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
		 			<div class="col-md-5 col-md-offset-5 text-center">
		    			<button id="search" name="search" class="btn btn-primary btn-block" style="margin-top: -15px">Add Apartment</button>
		  			</div>
				</div>
			</form>

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
