<?php
	/**
	 * API code to delete existing Property
	*/

	// def headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Property.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// DELETE (Existing Property)
	if($requestMethod == 'DELETE') {
		if(isset($_GET['id'])) {
			$id = filterParam($_GET['id']);
			Property::delete($id);
			if(true) {
				$response = "Property Deleted";
				echo json_encode($response);
			} else {
				$response = "Property Not Deleted";
				echo json_encode($response);
			}
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