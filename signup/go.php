<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>Sign Up</title>
	</head>
	<body>
		<div>
			<h1>
			<?php
			require_once('../conn.php');
			require_once('../db.php');
			require_once('../util.php');

			// if the method is POST
			if ($_POST){
				$username = $_POST['uid'];
				$password = $_POST['pwd'];
	
				if(Db::hasUser($mysqli, $username)){
					Util::alert('This username has been taken!', 'http://localhost/signup');
				} else {
					if (Db::insertUser($mysqli, $username, $password)){
						
						Util::alert('Successfully signed up! Please log in.',"http://localhost/login");
					} else {
						Util::alert('Failed to signed up!', 'http://localhost/signup');
					}
				}
			}
			?>
			</h1>
		</div>
	</body>
</html>
