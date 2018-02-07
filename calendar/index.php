<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Calendar</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>
		<div>
			<a href="http://localhost/logout/">Logout</a>
		</div>
		<br>
		<?php
		session_start();
		
		require_once('../conn.php');
		require_once('../db.php');	
		require_once('../util.php');
		
		// redirect the user to login page if user is not logged in
		if (empty($_SESSION['username'])){
			Util::alert('You are not logged in.', 'http://localhost/login');
		}
		
		// get the session's username
		$username = $_SESSION['username'];
		
		echo '<header>' . $username . '\'s calendar</header>
		<br>
		<div class="center">
			<a href="http://localhost/calendar/add/">Add an event</a>
		</div>
		<hr>
		<div>';
		
		try{
			// get future events of this user
			$events = Db::getEvents($mysqli, $username);
			
			if (empty($events)){
				echo '<h3>You have no events in your calendar.</h3>';
			} else {
			
				foreach($events as $event){
					echo '<p><strong>Title: </strong>' . $event['title'] . '<br>' .
						    '<strong>Created by: </strong>' . $event['member'] . '<br>' . 
						'<strong>Description: </strong>' . $event['info'] . '<br><br>' . 
						    '<strong>Time: </strong>' . $event['date'] . 
								 '<br><a href="http://localhost/calendar/event/?id=' . $event['id'] . 
								 '">View Attendance</a></p><hr>';
				}
			}
		} catch (Exception $e){
			echo '<h1>No events to display</h1>';
		}
		?>
		</div>
	</body>
</html>
