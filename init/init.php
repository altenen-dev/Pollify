<?php

	// if (($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {exit("NOT ALLOWED");}

	// // define('DIRECT', TRUE);

	require_once 'func.php';	

	$user = new user;



	$siteinfo = $db -> query("SELECT * FROM `settings` LIMIT 1");

	while ($show = $siteinfo -> fetch(PDO::FETCH_ASSOC)){

		$sitename = $show['sitename'];

	$maintaince = $show['maintaince'];





	}





?>

