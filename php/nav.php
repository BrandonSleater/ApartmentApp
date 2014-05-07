<?php

	/**
	 * Used to build our navigation and 
	 * determine which page we currently are on
	 * 
	 * @param  [int] $page [the current active page]
	 */
	function nav($page = 0) {
		
		// Based off nav, we'll assign page indexes from left to right
		$list = [['home', 0], ['admin', 0], ['about', 0], ['pay', 0]];

		// Assign a value to the second element of the active page index
		$list[$page][1] = (! $page) ? 1 : $page;

		// Build our navigation
		$html = '
		<!-- Navigation -->
		<div class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px">
				<div class="container">
				<a href="#" class="navbar-brand">Selenium Apartments</a> 
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse"></button>

				<div class="collapse navbar-collapse navHeaderCollapse">
					<ul class="nav navbar-nav navbar-right">';

		// Start with our home page
		$counter = 0;

		foreach ($list as $key) {
			
			// Find which second element was set as active
			$active = ($list[$counter][1]) ? 'class="active"' : '';

			// Build our title for the navigation link
			$title  = (! $counter) ? 'Home' : ucfirst($key[0]);
			
			// Build the list element with the active page and title
			$html  .= '<li '.$active.'><a href="'.$key[0].'.php">'.$title.'</a></li>';
			
			// Go to the next page in the list
			$counter++;
		}

		// Close up the navigation
		$html .= '		    	
				  	</ul>
				</div>
			</div>
		</div>
		';

		// Send it off
		echo $html;
	}

?>
