<?php
	/**
	 * API code to create new Seller
	*/

	// def headers
	header("Access-Control-Allow-Origin: *"); // enable CORS
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Seller.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// POST (New Seller)
	if($requestMethod == 'POST') {
		$firstname = $empty;
		$lastname = $empty;
		$email = $empty;
		$phonenum = $empty;
		$password = $empty;
		$POST = $_POST;
		if(isset($POST['firstname']) && isset($POST['lastname']) && isset($POST['email']) && isset($POST['phonenum']) && isset($POST['password'])) {
			$firstname = sanitizeName($POST['firstname']);
			$lastname = sanitizeName($POST['lastname']);
			$email = sanitizeEmail($POST['email']);
			$phonenum = sanitizePhoneNum($POST['phonenum']);
			$password = sanitizeString($POST['password']);
			$seller = new Seller($firstname, $lastname, $email, $phonenum, $password);
			$connection->real_escape_string($seller->firstname);
			$connection->real_escape_string($seller->lastname);
			$connection->real_escape_string($seller->email);
			$connection->real_escape_string($seller->phonenum);
			$connection->real_escape_string($seller->password);
			if($seller->checkExistingEmail() == true) {
				$response = "Email Already Used";
				echo json_encode($response);
			} else {
				if($seller->checkExistingPhoneNum() == true) {
					$response = "Phone Number Already Used";
					echo json_encode($response);
				} else {
					$seller->save();
					$response = "Success";
					echo json_encode($response);
				}
			}
		} else {
			$response = "No Data Received";
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