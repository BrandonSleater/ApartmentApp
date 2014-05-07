<!DOCTYPE html>
<html>
	<?php include 'php/head.php'; ?>
	<body>
		<?php include 'php/nav.php'; nav(3); ?>
		<div class="container apt-form">
			<div class="text-center col-md-12">
				<h2>Pay Your Bill</h2>
				<hr class="hr-style1">
			</div>
			
			<div class="row">
				<form class="form-horizontal col-md-5 col-md-offset-3" style="padding-left: 60px" role="form" name="create-form" id="create-form" action="php/post.php" method="POST">
					<input type="hidden" name="page" id="page" value="pay" />

					<div class="form-group frm-inp-sm" style="margin-top: 5px">
					  	<label class="col-md-6 control-label" for="payname">First Name:</label>

					  	<div class="col-md-5">
						    <input type="TEXT" name="payname" id="payname" class="form-control input-large" required>
					  	</div>
					</div>

					<div class="form-group frm-inp-sm" style="margin-top: 40px">
					  	<label class="col-md-6 control-label" for="lastname">Last Name:</label>

					  	<div class="col-md-5">
						    <input type="TEXT" name="lastname" id="lastname" class="form-control input-large" required>
					  	</div>
					</div>

					<div class="form-group frm-inp-sm">
					  	<label class="col-md-6 control-label" for="amount">Amount $:</label>
					  	
					  	<div class="col-md-3">
						    <input type="text" id="amount" name="amount" placeholder="500" class="form-control input-medium" required>
					  	</div>
					</div>

					<div class="form-group frm-inp-sm">
					  	<label class="col-md-6 control-label" for="paytype">Pay Type:</label>
					  	
					  	<div class="col-md-4">
						    <select id="paytype" name="paytype" class="form-control input-large" required>
						      <option value="amex">Amex</option>
						      <option value="visa">Visa</option>
						      <option value="master">Mastercard</option>
						    </select>
					  	</div>
					</div>

					<div class="form-group">
			 			<div class="col-md-6 col-md-offset-5 text-center">
			    			<button id="create-apt" class="btn btn-primary btn-block" style="margin-top: 0; margin-left: -45px">Pay Bill</button>
			  			</div>
					</div>
				</form>

				<div class="col-md-5 pull-right" id="new-apt" style="margin-right: 80px"></div>
			</div>
		</div>

		<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
	</body>
</html>
