<?php
	session_start();

	require_once('../../conn.php');
	require_once('../../db.php');
	require_once('../../util.php');
					
	if (empty($_SESSION['username'])){
		Util::alert('You are not logged in.', 'http://localhost/login/');
	}
	
	$username = $_SESSION['username'];
	
	$title = $_POST['title'];
	$info = $_POST['info'];
	$date = $_POST['date'];
	
	// get the inserted ID after it is inserted in the database
	$id = Db::insertEvent($mysqli, $username, $title, $info, $date);
	
	if ($id > 0){
		// event insertion success
		if (Db::insertAttendance($mysqli, $username, $id)){
			// attendance insertion success
			Util::alert('Event added to your calendar.', 'http://localhost/calendar/event/?id=' . $id);
		} else {
			// attendance insertion failed
			Util::alert('Event created, but not added to your calendar.', 'http://localhost/calendar/event/?id=' . $id);
		}
	} else {
		// event insertion failed
		Util::alert('Failed to create event.', 'http://localhost/calendar/');
	}
?>
