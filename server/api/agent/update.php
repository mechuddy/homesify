<?php
	/**
	 * API code to update existing Agent
	*/

	// def headers
	header("Access-Control-Allow-Origin *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Agent.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;
	$responses = array();

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// POST (Existing Agent)
	if($requestMethod == 'POST') {
		$firstname = $empty;
		$lastname = $empty;
		$email = $empty;
		$phonenum = $empty;
		$password = $empty;
		$firstnameStatus = $empty;
		$lastnameStatus = $empty;
		$emailStatus = $empty;
		$phonenumStatus = $empty;
		$passwordStatus = $empty;
		$POST = $_POST;
		if(isset($_GET['id'])) {
			$id = filterParam($_GET['id']);
			if(isset($POST['firstname'])) {
				$firstname = sanitizeName($POST['firstname']);
				$connection->real_escape_string($firstname);
				if($firstname != $empty) {
					$firstnameStatus = Agent::update($id, "firstname", $firstname);
					if($firstnameStatus == true) {
						array_push($responses, "Firstname Updated");
					}
				}
			}
			if(isset($POST['lastname'])) {
				$lastname = sanitizeName($POST['lastname']);
				$connection->real_escape_string($lastname);
				if($lastname != $empty) {
					$lastnameStatus = Agent::update($id, "lastname", $lastname);
					if($lastnameStatus == true) {
						array_push($responses, "Lastname Updated");
					}
				}
			}
			if(isset($POST['phonenum'])) {
				$phonenum = sanitizePhoneNum($POST['phonenum']);
				$connection->real_escape_string($phonenum);
				if($phonenum != $empty) {
					$phonenumStatus = Agent::update($id, "phonenum", $phonenum);
					if($phonenumStatus == true) {
						array_push($responses, "Phone Number Updated");
					}
				}
			}
			if(isset($POST['password'])) {
				$password = sanitizeString($POST['password']);
				$connection->real_escape_string($password);
				if($password != $empty) {
					$passwordStatus = Agent::update($id, "password", $password);
					if($passwordStatus == true) {
						array_push($responses, "Password Updated");
					}
				}
			}
			echo json_encode($responses);
		} else {
			$response = "No Parameter Supplied";
			echo json_encode($response);
		}
	} else {
		$response = "Invalid Request";
		echo json_encode($response);
	}

	// close connection
	$connection->close();

	/**
	 * API Useful Functions
	*/

	function filterParam($x) {
		$x = strip_tags($x);
		$x = htmlentities($x);
		$x = stripslashes($x);
		$x = preg_replace("/[^0-9]/", '', $x);
		return $x;
	}

	function sanitizeName($x) {
		$x = strip_tags($x);
		$x = htmlentities($x);
		$x = stripslashes($x);
		$x = preg_replace("/[^a-zA-Z]/", '', $x);
		$x = ucfirst(strtolower($x));
		return $x;
	}

	function sanitizeEmail($x) {
		$x = strip_tags($x);
		$x = htmlentities($x);
		$x = stripslashes($x);
		$x = preg_replace("/[^a-z0-9@.]/", '', $x);
		return $x;
	}

	function sanitizePhoneNum($x) {
		$x = strip_tags($x);
		$x = htmlentities($x);
		$x = stripslashes($x);
		$x = preg_replace("/[^0-9]/", '', $x);
		return $x;
	}

	function sanitizeString($x) {
		$x = strip_tags($x);
		$x = htmlentities($x);
		$x = stripslashes($x);
		return $x;
	}
	
	// exit
?>