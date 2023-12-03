<?php
	class user {
			function availableuser($odb, $user){

			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = ?");

			$SQL -> execute(array($user));

			$count = $SQL -> fetchColumn(0);

			if ($count == 1){

				return true;

			} else{

				return false;

			}

		}

		function LoggedIn(){

			@session_start();

			if (isset($_SESSION['user_id'], $_SESSION['user_name'])){

				return true;

			} else {

				return false;

			}

		}

	}


?>

