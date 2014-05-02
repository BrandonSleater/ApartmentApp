<?php

	function nav($page = 0) {
		
		$list = [['index', 0], ['admin', 0], ['about', 0]];

		if (!$page) {
			$list[$page][1] = 1;
		} else {
			$list[$page][1] = $page;
		}

		$html = '
		<!-- Navigation -->
		<div class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px">
				<div class="container">
				<a href="#" class="navbar-brand">Selenium Apartments</a> 
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse"></button>

				<div class="collapse navbar-collapse navHeaderCollapse">
					<ul class="nav navbar-nav navbar-right">';

		$counter = 0;
		
		foreach ($list as $key) {
			
			$active = ($list[$counter][1]) ? 'class="active"' : '';
			$title = (!$counter) ? 'Home' : ucfirst($key[0]);
			
			$html .= '<li '.$active.'><a href="'.$key[0].'.php">'.$title.'</a></li>';
			
			$counter++;
		}

		$html .= '		    	
				  	</ul>
				</div>
			</div>
		</div>
		';

		echo $html;
	}

?>