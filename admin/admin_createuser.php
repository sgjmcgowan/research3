<?php
	//ini_set('display_errors',1);
	//error_reporting(E_ALL);
	require_once('phpscripts/config.php');
	confirm_logged_in();
	if(isset($_POST['submit'])) {
		$fname = trim($_POST['fname']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$email = trim($_POST['email']);
		$userlvl = $_POST['userlvl'];
		if(empty($userlvl)){
			$message = "Please select a user level.";
		}else{
			$result = createUser($fname, $username, $password, $email, $userlvl);
			$message = $result;
		}
	}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS Portal</title>
</head>
<body>
	<h1>Welcome Company Name to your create user page</h1>
	<?php if(!empty($message)){echo $message;} ?>
	<form action="admin_createuser.php" method="post">
	<label>First Name:</label>
	<input type="text" name="fname" value="	<?php if(!empty($fname)){echo $fname;} ?>
"><br><br>
	
	<label>Username:</label>
	<input type="text" name="username" value="	<?php if(!empty($username)){echo $username;} ?>
"><br><br>

	<label>Password:</label>
	<input type="text" name="password" value="	<?php if(!empty($password)){echo $password;} ?>
"><br><br>

	<label>Email:</label>
	<input type="text" name="email" value="	<?php if(!empty($email)){echo $email;} ?>
"><br><br>

	<label>User Level:</label>
	<select name="userlvl">
		<option value="">Please select a user level</option>
		<option value="2">Web Admin</option>
		<option value="1">Web Master</option>
	</select><br><br>

	<input type="submit" name="submit" value="Create User">
	</form>
</body>
</html>