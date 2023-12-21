<?php
	/**
	 * API code to get or fetch all existing Properties
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

	// GET (All Existing Properties)
	if($requestMethod == 'GET') {
		$properties = Property::findAll();
		$response = $properties;
		echo json_encode($response);
	}

	// NOT GET
	if($requestMethod != 'GET') {
		$response = "Invalid Request";
		echo json_encode($response);
	}

	// close connection
	$connection->close();

	// exit
?>