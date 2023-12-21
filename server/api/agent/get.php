<?php
	/**
	 * API code to get or fetch existing Agent either by id or email,
	 * Where id or email refers to supplied value or parameter
	*/

	// def headers
	header("Access-Control-Allow-Origin: *"); // enable CORS
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Agent.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// GET (Existing Agent by id)
	if($requestMethod == 'GET') {
		$GET = $_GET;
		if(isset($GET['id'])) {
			$id = filterParam($GET['id']);
			$agent = Agent::findByID($id);
			$response = $agent;
			echo json_encode($response);
		}
	}

	// GET (Existing Agent by email)
	if($requestMethod == 'GET') {
		$GET = $_GET;
		if(isset($GET['email'])) {
			$email = filter_var(trim($GET['email']), FILTER_SANITIZE_EMAIL);
			$connection->real_escape_string($email);
			$agent = Agent::findByEmail($email);
			$response = $agent;
			echo json_encode($response);
		}
	}

	// GET (No Parameter Supplied)
	if($requestMethod == 'GET') {
		$GET = $_GET;
		if(!(isset($GET['id']) || isset($GET['email']))) {
			$response = "No Parameter Supplied";
			echo json_encode($response);
		}
	}

	// NOT GET
	if($requestMethod != 'GET') {
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

	// exit
?>