<?php

	include 'view.php';

	// Based off the page, determine the type of query
	$type = ($_POST['page'] == 'admin') ? 'create' : 'search';

	$type = ($_POST['page'] == 'pay') ? 'pay' : $type;

	// Initiate the views for returning our data in html
	$view = new view(array('post' => $_POST, 'type' => $type));

?>
