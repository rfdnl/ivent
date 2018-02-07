<html>
	<head>
		<meta charset="utf-8">
		<title>Ivent</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			session_start();
			require_once('conn.php');
			require_once('util.php');
			
			// check if the user has logged in
			if (!empty($_SESSION['username'])){
				Util::redirect('http://localhost/calendar');
			}
		?>
		<div>
			<div>
				<a href="http://localhost/login/">Log In</a>
			</div>
			<div>
				<a href="http://localhost/signup/">Sign Up</a>
			</div>
			<div>
				<a href="http://localhost/about/">About Us</a>
			</div>
		</div>
		<hr/>
		<div class="center">
			<br>
			<img src="logo.png" alt="Ivent Logo" height="200"/>
			<br><br>
			<header>I V E N T</header>
			<p>Your favourite Event Management System</p>
		</div>
		<hr/>
	</body>
</html>
