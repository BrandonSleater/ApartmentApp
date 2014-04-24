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

    <?php 
      //For testing purposes
      //$obj = new model();
      //$obj->test_query();
      if (isset($_POST['name'])) {
        $obj = new model();
        //echo "content";
      }
    ?>
    
		<!-- Search Form -->
		<div class="container" id="top-search">
		  <div class="row">
				<form role="form" class="go-right" name="apt-search" id="apt-search" action="" method="POST">
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
					<button class="btn btn-lg btn-default">Submit</button>
				</form>
		  </div>
		</div>

		<!-- Search Results -->
		<div class="container-fluid" style="padding-bottom: 20px">
	        <div class="container container-pad" id="property-listings">
	            
	            <div class="row">
	            	<div class="col-md-12">
	                	<h1>Search Results:</h1><hr style="border-color: #7F8C8D">
	              	</div>
	            </div>
	            
	            <div class="row">
	                <div class="col-sm-6"> 

	                    <!-- Begin Listing: 609 W GRAVERS LN-->
	                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
	                        <div class="media">
	                            <a class="pull-left" href="#" target="_parent">
	                            <img alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/Yu59d899Ocpyr_RnF0-8qNJX1oYibjwp9TiLy-bZvU9vRJ2iC1zSQgFwW-fTCs6tVkKrj99s7FFm5Ygwl88xIA.jpg"></a>

	                            <div class="clearfix visible-sm"></div>

	                            <div class="media-body fnt-smaller">
	                                <a href="#" target="_parent"></a>

	                                <h4 class="media-heading">
	                                  <a href="#" target="_parent">$1,975,000 <small class="pull-right">609 W Gravers Ln</small></a></h4>


	                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
	                                    <li>4,820 SqFt</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>5 Beds</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>5 Baths</li>
	                                </ul>

	                                <p class="hidden-xs">Situated between fairmount
	                                park and the prestigious philadelphia cricket
	                                club, this beautiful 2+ acre property is truly
	                                ...</p><span class="fnt-smaller fnt-lighter fnt-arial">Courtesy of HS Fox & Roach-Chestnut Hill
	                                Evergreen</span>
	                            </div>
	                        </div>
	                    </div><!-- End Listing-->

	                    <!-- Begin Listing: 218 LYNNEBROOK LN-->
	                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
	                        <div class="media">
	                            <a class="pull-left" href="#" target="_parent">
	                            <img alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/zMjCkcFeFDXDAP8xDhbD9ZmrVL7oGkBvSnh2bDBZ6UB5UHXa3_g8c6XYhRY_OxgGaMBMehiTWXDSLzBMaIzRhA.jpg"></a>

	                            <div class="clearfix visible-sm"></div>

	                            <div class="media-body fnt-smaller">
	                                <a href="#" target="_parent"></a>

	                                <h4 class="media-heading">
	                                  <a href="#" target="_parent">$1,975,000 <small class="pull-right">218 Lynnebrook Ln</small></a></h4>


	                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
	                                    <li>6,959 SqFt</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>6 Beds</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>5 Baths</li>
	                                </ul>

	                                <p class="hidden-xs">Impressively positioned
	                                overlooking 3.5 captivating acres, designated
	                                as "significant" by the chestnut hill
	                                historical s...</p><span class="fnt-smaller fnt-lighter fnt-arial">Courtesy of HS Fox & Roach-Blue Bell</span>
	                            </div>
	                        </div>
	                    </div><!-- End Listing-->

	                    <!-- Begin Listing: 209 CHESTNUT HILL AVE-->
	                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
	                        <div class="media">
	                            <a class="pull-left" href="#" target="_parent">
	                            <img alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/iwn7qH9r9OPnqTaTTxxb8PBzQHk2EiHU2PBBntt041AZsVsGY-SeUexTMLgRcYSJukrKOwHaYnTVXAsk6RdSmA.jpg"></a>

	                            <div class="clearfix visible-sm"></div>

	                            <div class="media-body fnt-smaller">
	                                <a href="#" target="_parent"></a>

	                                <h4 class="media-heading">
	                                  <a href="#" target="_parent">$1,599,999 <small class="pull-right">209 Chestnut Hill ve</small></a></h4>


	                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
	                                    <li>16,581 SqFt</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>8 Beds</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>4 Baths</li>
	                                </ul>

	                                <p class="hidden-xs">Built in 1909 by
	                                pittsburgh steel magnate henry a. laughlin,
	                                greylock is a classic chestnut hill stone
	                                mansion once cons...</p><span class="fnt-smaller fnt-lighter fnt-arial">Courtesy of ng and Foster-Devon</span>
	                            </div>
	                        </div>
	                    </div><!-- End Listing-->
	                </div>

	                <div class="col-sm-6">  

	                    <!-- Begin Listing: 1220-32 N HOWARD ST-->
	                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
	                        <div class="media">
	                            <a class="pull-left" href="#" target="_parent">
	                            <img alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/vGoNjc2jHGb87GlnnDQlf6LxeOUgIOn0bL6Wvn1nEnig2Ntq6W7xN5cOQBZZeNxl9O42DOkHUw0LNnj1ZB2KHA.jpg"></a>

	                            <div class="clearfix visible-sm"></div>

	                            <div class="media-body fnt-smaller">
	                                <a href="#" target="_parent"></a>

	                                <h4 class="media-heading">
	                                  <a href="#" target="_parent">$1,500,000 <small class="pull-right">1220-32 N Howard St</small></a></h4>


	                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
	                                    <li>4,900 SqFt</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>1 Beds</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>1 Baths</li>
	                                </ul>

	                                <p class="hidden-xs">A once in a lifetime
	                                opportunity to own a unique live / work space
	                                in one of philadelphia's most popular
	                                neighborhoods. ...</p><span class="fnt-smaller fnt-lighter fnt-arial">Courtesy of ll Banker Preferred-Philadelphia</span>
	                            </div>
	                        </div>
	                    </div><!-- End Listing-->

	                    <!-- Begin Listing: 9006 CREFELD ST-->
	                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
	                        <div class="media">
	                            <a class="pull-left" href="#" target="_parent">
	                            <img alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/uLp58OH37CTPHxXcgJXYw8zT2u3xg_2XIbFndB6J0WTSAStGBaEV6YsdAseSZTKAdthm0OzG-Ca_EIkoXIEBxw.jpg"></a>

	                            <div class="clearfix visible-sm"></div>

	                            <div class="media-body fnt-smaller">
	                                <a href="#" target="_parent"></a>

	                                <h4 class="media-heading">
	                                  <a href="#" target="_parent">$1,295,000 <small class="pull-right">9006 Crefeld St</small></a></h4>


	                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
	                                    <li>7,672 SqFt</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>7 Beds</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>5 Baths</li>
	                                </ul>

	                                <p class="hidden-xs">Located in chestnut hill,
	                                recently named by the american planning
	                                association as one of america's top 10 great
	                                neighborh...</p><span class="fnt-smaller fnt-lighter fnt-arial">Courtesy of RE/MAX Services</span>
	                            </div>
	                        </div>
	                    </div><!-- End Listing-->

	                    <!-- Begin Listing: 701 W ALLENS LN-->
	                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
	                        <div class="media">
	                            <a class="pull-left" href="#" target="_parent">
	                            <img alt="image" class="img-responsive" src="http://images.prd.mris.com/image/V2/1/K12MLs4i-e2rsQ-rA6DoCwlysXSrEXZyHtCFkrOLsvK1y2mvbUrlmw5pMXX1laXlnY9_0VU82YeS3EucwIchtg.jpg"></a>

	                            <div class="clearfix visible-sm"></div>

	                            <div class="media-body fnt-smaller">
	                                <a href="#" target="_parent"></a>

	                                <h4 class="media-heading">
	                                  <a href="#" target="_parent">$1,175,000 <small class="pull-right">701 W Allens Ln</small></a></h4>


	                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
	                                    <li>9,824 SqFt</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>8 Beds</li>

	                                    <li style="list-style: none">|</li>

	                                    <li>5 Baths</li>
	                                </ul>

	                                <p class="hidden-xs">A once in a lifetime
	                                opportunity! live in this grand home with its
	                                stunning entry and staircase, bedroom suites,
	                                firepla...</p><span class="fnt-smaller fnt-lighter fnt-arial">Courtesy of HS Fox & Roach-Chestnut Hill
	                                Evergreen</span>
	                            </div>
	                        </div>
	                    </div><!-- End Listing-->
	                </div><!-- End Col -->
	            </div><!-- End row -->
	        </div><!-- End container -->
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
