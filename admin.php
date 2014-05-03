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
			<div class="row">
				<form class="form-horizontal col-md-5 col-md-offset-3"  role="form" name="create-form" id="create-form" action="php/test2.php" method="POST">
					<!-- Select Basic -->
					<div class="form-group frm-inp-sm" style="margin-top: 5px">
					  	<label class="col-md-6 control-label" for="floorplan">Floor Plan:</label>
					  	<div class="col-md-4">
						    <select id="floorplan" name="floorplan" class="form-control input-large">
						      <option value="1Bed">1 Bedroom</option>
						      <option value="2Bed">2 Bedroom</option>
						      <option value="studio">Studio</option>
						    </select>
					  	</div>
					</div>

					<div class="form-group frm-inp-sm">
					  	<label class="col-md-6 control-label" for="price">Price:</label>
					  	<div class="col-md-3">
						    <input type="text" id="price" name="price" placeholder="500" class="form-control input-medium" required>
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
					<div class="form-group" style="margin-bottom: -40px">
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
			 			<div class="col-md-6 col-md-offset-5 text-center">
			    			<button id="create-apt" class="btn btn-primary btn-block" style="margin-top: -40px; margin-left: -45px">Add Apartment</button>
			  			</div>
					</div>
				</form>

				<!-- End Search Form-->
				<div class="col-md-5 pull-right" id="new-apt" style="margin-right: 80px"></div>
			</div>
		</div>

		<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
	</body>
</html>
