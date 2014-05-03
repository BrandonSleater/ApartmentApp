<?php include 'php/model.php'; ?>
<!DOCTYPE html>
<html>
	<?php include 'php/head.php'; ?>
	<body>
		<?php 
			include 'php/nav.php'; 

			nav();
		?>
		<div class="container apt-form">
			<div class="text-center col-md-12">
				<h2>Search for Apartments</h2>
				<hr class="hr-style1">
			</div>
			<form class="form-horizontal col-md-5" style="" role="form" name="apt-search" id="apt-search" action="php/post.php" method="POST">

				<input type="hidden" name="page" id="page" value="home" />

				<div class="form-group frm-inp-tight" style="margin-top: 0">
				  	<label class="col-md-6 control-label" for="floorplan">Floor Plan:</label>
				  	<div class="col-md-4">
					    <select id="floorplan" name="floorplan" class="form-control input-large">
					      <option value="1Bed">1 Bedroom</option>
					      <option value="2Bed">2 Bedroom</option>
					      <option value="studio">Studio</option>
					    </select>
				  	</div>
				</div>

				<div class="form-group" style="margin-bottom: -50px">
				  	<label class="col-md-6 control-label" for="p_range">Price:</label>
					<div class="radio-inline">
					  <label>
					    <input type="radio" style="margin-left: 0" name="p_range" id="p-lt" value="lt" checked> <= 700		
					  </label>
					  <label>
					    <input type="radio" style="margin-left: 10px" name="p_range" id="p-gt" value="gt"> > 700
					  </label>
					</div>
				</div>

				<div class="form-group frm-inp-tight">
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
				<div class="form-group frm-inp-tight">
				  	<label class="col-md-6 control-label" for="util">Utilities:</label>
				  	<div class="col-md-4">
					  	<div class="checkbox">
					    	<label for="has_washdry">
					      		<input type="checkbox" name="has_washdry" id="has_washdry" value="1"> Washer/Dryer
					    	</label>
						</div>
					  	<div class="checkbox">
					    	<label for="has_patio">
					      		<input type="checkbox" name="has_patio" id="has_patio" value="1"> Patio/Balcony
					    	</label>
						</div>
						<div class="checkbox">
					    	<label for="has_internet">
					      		<input type="checkbox" name="has_internet" id="has_internet" value="1"> Internet
					    	</label>
						</div>
				  	</div>
				</div>

				<!-- Multiple Checkboxes -->
				<div class="form-group">
		  			<label class="col-md-6 control-label" for="kitchen">Kitchen:</label>
		  			<div class="col-md-4">
		  				<div class="checkbox">
			    			<label for="has_microwave">
			      				<input type="checkbox" name="has_microwave" id="has_microwave" value="1"> Microwave
			   				</label>
						</div>
		  				<div class="checkbox">
			    			<label for="has_dishwasher">
			      				<input type="checkbox" name="has_dishwasher" id="has_dishwasher" value="1"> Dishwasher
			    			</label>
						</div>
		  			</div>
				</div>

				<!-- Button -->
				<div class="form-group">
		 			<div class="col-md-8 col-md-offset-3 text-center">
		    			<button id="search-apt" name="search-apt" class="btn btn-primary btn-block" style="margin: -25px 0 0 5px">Search</button>
		  			</div>
				</div>
			</form>

			<div class="col-md-6 pull-right">
				<div class="flexslider" style="box-shadow: 0 0 20px #000">
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
		</div>

        <div class="container apt-form" id="reslt" style="display: none; height: 100%; margin-bottom: 30px;">
			<div class="text-center col-md-12">
				<h2>Search Results</h2>
				<hr class="hr-style1">
			</div>

			<div class="row" id="search-results"></div>
		</div>

		<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
	</body>
</html>
