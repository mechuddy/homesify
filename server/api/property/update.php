<?php
	/**
	 * API code to update existing Property
	*/

	// def headers
	header("Access-Control-Allow-Origin *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Property.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;
	$responses = array();

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// POST (Existing Property)
	if($requestMethod == 'POST') {
		$name = $empty;
		$description = $empty;
		$color = $empty;
		$numRooms = $empty;
		$numBathrooms = $empty;
		$numToilets = $empty;
		$numKitchens = $empty;
		$numPlots = $empty;
		$location = $empty;
		$price = $empty;
		$nameStatus = $empty;
		$descriptionStatus = $empty;
		$colorStatus = $empty;
		$numRoomsStatus = $empty;
		$numBathroomsStatus = $empty;
		$numToiletsStatus = $empty;
		$numKitchensStatus = $empty;
		$numPlotsStatus = $empty;
		$locationStatus = $empty;
		$priceStatus = $empty;
		$POST = $_POST;
		if(isset($_GET['id'])) {
			$id = filterParam($_GET['id']);
			if(isset($POST['name'])) {
				$name = sanitizeName($POST['name']);
				$name = formatName($name);
				$connection->real_escape_string($name);
				if($name != $empty) {
					$nameStatus = Property::update($id, "name", $name);
					if($nameStatus == true) {
						array_push($responses, "Name Updated");
					}
				}
			}
			if(isset($POST['description'])) {
				$description = sanitizeString($POST['description']);
				$connection->real_escape_string($description);
				if($description != $empty) {
					$descriptionStatus = Property::update($id, "description", $description);
					if($descriptionStatus == true) {
						array_push($responses, "Description Updated");
					}
				}
			}
			if(isset($POST['color'])) {
				$color = sanitizeString($POST['color']);
				$connection->real_escape_string($color);
				if($color != $empty) {
					$colorStatus = Property::update($id, "color", $color);
					if($colorStatus == true) {
						array_push($responses, "Color Updated");
					}
				}
			}
			if(isset($POST['num_rooms'])) {
				$numRooms = sanitizeNum($POST['num_rooms']);
				$connection->real_escape_string($numRooms);
				if($numRooms != $empty) {
					$numRoomsStatus = Property::update($id, "num_rooms", $numRooms);
					if($numRoomsStatus == true) {
						array_push($responses, "Number of Rooms Updated");
					}
				}
			}
			if(isset($POST['num_bathrooms'])) {
				$numBathrooms = sanitizeNum($POST['num_bathrooms']);
				$connection->real_escape_string($numBathrooms);
				if($numBathrooms != $empty) {
					$numBathroomsStatus = Property::update($id, "num_bathrooms", $numBathrooms);
					if($numBathroomsStatus == true) {
						array_push($responses, "Number of Bathrooms Updated");
					}
				}
			}
			if(isset($POST['num_toilets'])) {
				$numToilets = sanitizeNum($POST['num_toilets']);
				$connection->real_escape_string($numToilets);
				if($numToilets != $empty) {
					$numToiletsStatus = Property::update($id, "num_toilets", $numToilets);
					if($numToiletsStatus == true) {
						array_push($responses, "Number of Toilets Updated");
					}
				}
			}
			if(isset($POST['num_kitchens'])) {
				$numKitchens = sanitizeNum($POST['num_kitchens']);
				$connection->real_escape_string($numKitchens);
				if($numKitchens != $empty) {
					$numKitchensStatus = Property::update($id, "num_kitchens", $numKitchens);
					if($numKitchensStatus == true) {
						array_push($responses, "Number of Kitchens Updated");
					}
				}
			}
			if(isset($POST['num_plots'])) {
				$numPlots = sanitizeNum($POST['num_plots']);
				$connection->real_escape_string($numPlots);
				if($numPlots != $empty) {
					$numPlotsStatus = Property::update($id, "num_plots", $numPlots);
					if($numPlotsStatus == true) {
						array_push($responses, "Number of Plots Updated");
					}
				}
			}
			if(isset($POST['location'])) {
				$location = sanitizeString($POST['location']);
				$location = formatStr($location);
				$connection->real_escape_string($location);
				if($location != $empty) {
					$locationStatus = Property::update($id, "location", $location);
					if($locationStatus == true) {
						array_push($responses, "Location Updated");
					}
				}
			}
			if(isset($POST['price'])) {
				$price = sanitizeString($POST['price']);
				$connection->real_escape_string($price);
				if($price != $empty) {
					$priceStatus = Property::update($id, "price", $price);
					if($priceStatus == true) {
						array_push($responses, "Price Updated");
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

	function formatName($x) {
        $newNameArr = array();
        $oldNameArr = explode(" ", $x);
        if(count($oldNameArr) >= 2) {
            foreach($oldNameArr as $item) {
                $y = ucfirst($item);
                array_push($newNameArr, $y);
            }
            $newName = implode(" ", $newNameArr);
            return $newName;
        } else {
            $oldName = implode(" ", $oldNameArr);
            return ucfirst($oldName);
        }
    }

	function formatStr($x) {
        $newStrArr = array();
        $oldStrArr = explode(" ", $x);
        foreach($oldStrArr as $item) {
            $y = ucfirst(strtolower($item));
            array_push($newStrArr, $y);
        }
        $newStr = implode(" ", $newStrArr);
        return $newStr;
    }

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
		$x = preg_replace("/[^a-zA-Z ]/", '', $x);
		$x = ucfirst(strtolower($x));
		return $x;
	}

	function sanitizeNum($x) {
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