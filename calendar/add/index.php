<!DOCTYPE html>
<html>
	<head>
	
		<meta charset="utf-8">
		<title>Add Event</title>
		<link rel="stylesheet" type="text/css" href="../../style.css">
	</head>
	
	<body>
	<div>
		<a href="http://localhost/calendar/">My Calendar</a>
	</div>
	<div>
		<a href="http://localhost/logout/">Logout</a>
	</div>
	<br>
		<?php
			// to use the $_SESSION array
			session_start();
			
			require_once('../../util.php');
			
			// redirect the user to login page if user is not logged in
			if (empty($_SESSION['username'])){
				Util::alert('You are not logged in.', 'http://localhost/login/');
			}
		?>
		<header>Add an Event</header>
		<div class="center">
			<form method="post" action="go.php">
				<p>
					<label>Event Title: 
						<input type="text" name="title" />
					</label>
				</p>
				<p>
					<label>Event Description: 
						<br><textarea type="text" name="info" rows="6" cols="70" placeholder="Event's description here"></textarea>
					</label>
				</p>
				<p>
					<label>Start Date: 
						<input type="datetime-local" name="date"/>
					</label>
				</p>
				<p>
					<input type="submit" value="Add"/>
					<input type="reset" value="Reset" />
				</p>
			</form>
		</div>
	</body>
</html>
