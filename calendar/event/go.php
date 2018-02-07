<?php
	require_once('../../conn.php');
	require_once('../../db.php');
	require_once('../../util.php');
	
	if ($_POST){
		session_start();
		
		$username = $_SESSION['username'];
		
		if (empty($username)){
			Util::alert('You are not logged in!', 'http://localhost/login');
		}
		
		// event's id
		$id = $_POST['id'];
		
		if (Db::insertAttendance($mysqli, $username, $id)){
			Util::alert('Event added to your calendar.', 'http://localhost/calendar/event/?id=' . $id);
		} else {
			Util::alert('Failed to add event to your calendar.', 'http://localhost/calendar/event/?id=' . $id);
		}
	}
?>
