<?php
	/**
	 * API code to delete existing Agent
	*/

	// def headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Agent.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// DELETE (Existing Agent)
	if($requestMethod == 'DELETE') {
		if(isset($_GET['id'])) {
			$id = filterParam($_GET['id']);
			Agent::delete($id);
			if(true) {
				$response = "Agent Deleted";
				echo json_encode($response);
			} else {
				$response = "Agent Not Deleted";
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