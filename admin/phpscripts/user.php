<?php

	function createUser($fname, $username, $password, $email, $userlvl) {
		include('connect.php');
		$userString = "INSERT INTO tbl_user VALUES(NULL,'{$fname}', '{$username}', '{$password}', '{$email}', NULL, '{$userlvl}', 'no')";
		//echo $userString;
		$userQuery = mysqli_query($link, $userString);
		if($userQuery) {
			redirect_to("admin_index.php");
		}else{
			$message = "This user cannot be created.";
			return $message;
		}

		mysqli_close($link);
	}

	function editUser($id, $fname, $username, $password, $email){
		include('connect.php');
		$updateString = "UPDATE tbl_user SET user_fname='{$fname}', user_name='{$username}', user_pass='{$password}', user_email='{$email}' WHERE user_id={$id}";

		$updatequery = mysqli_query($link, $updateString);
		if($updateString){
			redirect_to("admin_index.php");
			$updatelogin = "UPDATE tbl_user SET login_count =  $_SESSION['login_count']+1 WHERE user_id={$id}";
			$updatequery = mysqli_query($link, $updatelogin); // The login count only increases once the account has been edited in some fashion
		} else {
			$message = "This ain't workin' right, ya rube.";
			return $message;
		}

		mysqli_close($link);
	}

	function deleteUser($id){
		include('connect.php');
		$delstring = "DELETE FROM tbl_user WHERE user_id={$id}";

		$delquery = mysqli_query($link, $delstring);
		if($delquery){
			redirect_to("../admin_index.php");
		} else {
			$message = "This asset cannot be retired.";
			return $message;
		}

		mysqli_close($link);
	}


?>
