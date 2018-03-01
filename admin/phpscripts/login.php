<?php

	function logIn($username, $password, $ip) {
		require_once('connect.php');

$username = mysqli_real_escape_string($link, $username);
$password = mysqli_real_escape_string($link, $password);

$loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";
		$user_set = mysqli_query($link, $loginstring);
		if(mysqli_num_rows($user_set)){
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $found_user['user_id'];
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name'] = $found_user['user_fname'];
			if(mysqli_query($link, $loginstring)){
				$updatestring = "UPDATE tbl_user SET user_ip = '$ip' WHERE user_id={$id}";
				$updatequery = mysqli_query($link, $updatestring);
			}

			$since_create = $_SESSION['last_login']-$_SESSION['user_create'];

			if($_SESSION['login_count'] === '0' && $since_create >= 24:00:00){ // If not quick enough, and if never edited their account.
				// This could be a little dangerous, but it would be important
				// to make sure that the user had edited there system-generated
				// password and fixed any incorrect info in their account.
				$message = "You did not log into and edit your account quickly enough. Contact your System Administrator to renew your account."
				return $message; // Returns a message letting them know they done messed up.
			}

			if($_SESSION['login_count'] === '0'){ // checks to see if the user has ever logged in before
				redirect_to('admin_edituser.php'); // if not, redirects to the edituser page to change any info they wish

			} elseif($_SESSION['login_count'] >= '1') { // if they have previously logged in
			redirect_to("admin_index.php"); // redirect to the admin index

		}else{
			$message = "Username and or password is incorrect.<br>Please make sure your cap lock key is turned off.";
			return $message;
		}
		mysqli_close($link);
	}

?>
