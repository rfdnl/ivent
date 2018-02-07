<?php
	// LOGOUT
	require_once('../util.php');
	
	session_start();
	
	// check if user logged in
	if (!empty($_SESSION['username']))
		// clear the session's username
		$_SESSION['username'] = null;
	
	session_destroy();
	
	Util::alert('You are logged out! Bye bye :D', 'http://localhost/');
?>
