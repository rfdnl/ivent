<?php
// require_once('<path of this file>');

// params
$_host = 'localhost';

// PLEASE USE 'root' SO WE CAN CREATE THE NEEDED DATABASE
$_user = 'root';

// CHANGE THIS PASSWORD TO YOUR OWN root'S PASSWORD
$_pass = 'r';

// YOU CAN RENAME THE DATABASE NAME TO WHATEVER YOU LIKE
$_db = 'eventdb_chill';

// connect to database
$mysqli = new mysqli($_host, $_user, $_pass);

// check connection
if ($mysqli->connect_errno){
	die('Could not connect to MYSQL' . mysqli_connect_error());
}

// select database
if ($mysqli->select_db($_db)){
	// selection success (database exist)
} else {
	// database not exist
	// create the database
	$mysqli->query('CREATE DATABASE ' . $_db);
	
	// try selecting the database again
	if ($mysqli->select_db($_db)){
		// create table member
		$mysqli->query('CREATE TABLE `member` (`username` varchar(30) NOT NULL, `password` varchar(30) NOT NULL)');
	
		// create table event
		$mysqli->query('CREATE TABLE `event`(`id` int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT, `member` varchar(30) NOT NULL, `title` varchar(50) NOT NULL, `info` varchar(200) DEFAULT NULL, `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP)');
	
		// create table attendance
		$mysqli->query('CREATE TABLE `attendance`(`event` int(9) NOT NULL, `member` varchar(30) NOT NULL)');
	
		// populate table member
		$mysqli->query('INSERT INTO `member`(`username`, `password`) VALUES ("user1", "pass1")');
		$mysqli->query('INSERT INTO `member`(`username`, `password`) VALUES ("user2", "pass2")');
		$mysqli->query('INSERT INTO `member`(`username`, `password`) VALUES ("user3", "pass3")');
		$mysqli->query('INSERT INTO `member`(`username`, `password`) VALUES ("user4", "pass4")');
		$mysqli->query('INSERT INTO `member`(`username`, `password`) VALUES ("user5", "pass5")');	
		$mysqli->query('INSERT INTO `member`(`username`, `password`) VALUES ("user6", "pass6")');
		//$mysqli->query('INSERT INTO `member`(`username`, `password`) VALUES ("", "")');
	
		// populate table event
		$mysqli->query('INSERT INTO `event` (`member`, `title`, `info`, `date`) VALUES ("user1", "title1", "info1", "2018-01-01 01:00:00")');
		$mysqli->query('INSERT INTO `event` (`member`, `title`, `info`, `date`) VALUES ("user2", "title2", "info2", "2018-02-02 02:00:00")');
		$mysqli->query('INSERT INTO `event` (`member`, `title`, `info`, `date`) VALUES ("user3", "title3", "info3", "2018-03-03 03:00:00")');
		//$mysqli->query('INSERT INTO `event` (`member`, `title`, `info`, `date`) VALUES ("", "", "", "")');
	
		// populate table attendance
		$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES (1 , "user1")');
		$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES (2 , "user2")');
		$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES (3, "user3")');
		$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES (1 , "user2")');
		$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES (1 , "user3")');
		$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES (2 , "user4")');
		$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES (3 , "user5")');
		//$mysqli->query('INSERT INTO `attendance` (`event`, `member`) VALUES ( , "")');
	} else {
		die('Unable to create database (and its tables) and select it.');
	}
}

?>
