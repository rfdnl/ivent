
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Log In</title>
	</head>
	<body>
		<div>
		<?php
		session_start();
		
		require_once('../conn.php');
		require_once('../db.php');
		require_once('../util.php');
		
		// if user logged in
		if (!empty($_SESSION['username'])){
			// clear the session's username
			$_SESSION['username'] = null;
		}
		
		// if the method is POST
		if ($_POST){
			$username = $_POST['uid'];
			$password = $_POST['pwd'];
			
			// if database contains such username
			if (Db::hasUser($mysqli, $username)){
				// get the password of the user
				// check if they equal
				if ($password == Db::getPassword($mysqli, $username)){
					
					// set the session's username
					$_SESSION['username'] = $username;

					Util::alert('Welcome back, ' . $username . '!', 'http://localhost/calendar/');
				} else {
					// if the passwords are not equal
					Util::alert('Wrong username or password. Please try again.', 'http://localhost/login/');
				}
			} else {
				// if the user does not exist in database
				Util::alert('No such user exist. Maybe you want to sign up?', 'http://localhost/signup/');
			}
		}
		?>
		</div>
	</body>
	
</html>
