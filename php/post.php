<?php

	include 'view.php';

	$type = ($_POST['page'] == 'admin') ? 'create' : 'search';

	$view = new view(array('post' => $_POST, 'type' => $type));
?>
