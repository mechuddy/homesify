<?php
	/**
	 * API code to get or fetch existing Property either by id,
	 * Where id refers to supplied value or parameter
	*/

	// def headers
	header("Access-Control-Allow-Origin: *"); // enable CORS
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Property.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// GET (Existing Property by id)
	if($requestMethod == 'GET') {
		$GET = $_GET;
		if(isset($GET['id'])) {
			$id = filterParam($GET['id']);
			$property = Property::findByID($id);
			$response = $property;
			echo json_encode($response);
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

	// exit
?>