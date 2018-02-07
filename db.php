<?php

class Db {
	
	// check if username has been registered
	static function hasUser($mysqli, $username){
		if ($stmt = $mysqli->prepare('SELECT COUNT(*) AS Total FROM member WHERE username = ?')){
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			return $row['Total'] > 0;
		}
	}
	
	// signup
	static function insertUser($mysqli, $username, $password){
		if ($stmt = $mysqli->prepare('INSERT INTO member (username, password) values (?, ?)')){
			$stmt->bind_param('ss', $username, $password);
			if ($stmt->execute()){
				return true;
			} else {
				return false;
			}
		}
	}
	
	// signin
	static function getPassword($mysqli, $username){
		if ($stmt = $mysqli->prepare('SELECT password FROM member WHERE username = ?')){
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			return $row['password'];
		}
	}
	
	// view calendar
	static function getEvents($mysqli, $username){
		if ($stmt = $mysqli->prepare('SELECT * FROM event WHERE date >= CURDATE() AND id IN (SELECT event FROM attendance WHERE member = ?) ORDER BY date')){
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			return $rows;
		}
	}
	
	// view event	
	static function getEvent($mysqli, $id){
		if ($stmt = $mysqli->prepare('SELECT * FROM event WHERE id = ?')){
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			return $row;
		}
	}
	
	// add event
	static function insertEvent($mysqli, $username, $title, $info, $date){
		if ($stmt = $mysqli->prepare('INSERT INTO event (member, title, info, date) VALUES (?, ?, ?, ?)')){
			$stmt->bind_param('ssss', $username, $title, $info, $date);
			if ($stmt->execute()){
				return $mysqli->insert_id;
			} else {
				return 0;
			}
		}
	}
	
	// attending event
	static function insertAttendance($mysqli, $username, $event){
		if ($stmt = $mysqli->prepare('INSERT INTO attendance (event, member) VALUES (?, ?)')){
			$stmt->bind_param('is', $event, $username);
			if ($stmt->execute()){
				return true;
			} else {
				return false;
			}
		}
	}
	
	// view attendees
	static function getAttendance($mysqli, $event, $username){
		if ($stmt = $mysqli->prepare('SELECT member FROM attendance WHERE event = ? AND member != ?')){
			$stmt->bind_param('is', $event, $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			return $rows;
		}
	}
	
	static function notAttending($mysqli, $event, $username){
		if ($stmt = $mysqli->prepare('SELECT COUNT(member) AS Total FROM attendance WHERE event = ? AND member = ?')){
			$stmt->bind_param('is', $event, $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			return $row['Total'] < 1;
		}
	}
}

?>
