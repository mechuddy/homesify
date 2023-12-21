<?php
	/**
	 * API code to create new Property
	*/

	// def headers
	header("Access-Control-Allow-Origin: *"); // enable CORS
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get required modules
	require_once "../../database/models/Property.php";
	require_once "../../database/config/connection.php";

	// set vars
	$empty = "";
	$response = $empty;
	$uploadsDir = "../../uploads/";
	$supportedFileFormat = array(
		"jpg" => "image/jpg",
		"jpeg" => "image/jpeg",
		"png" => "image/png"
	);

	// get request method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// POST (New Property)
	if($requestMethod == 'POST') {
		$name = $empty;
		$description = $empty;
		$type = $empty;
		$color = $empty;
		$numRooms = $empty;
		$numBathrooms = $empty;
		$numToilets = $empty;
		$numKitchens = $empty;
		$numPlots = $empty;
		$location = $empty;
		$price = $empty;
		$fileName = $empty;
		$POST = $_POST;
		if(empty($POST) && empty($_FILES['file']['name'])) {
			$response = "No Data Received";
			echo json_encode($response);
		} else {
			if(ucfirst(strtolower($POST['type'])) == 'House') {
				$name = sanitizeName($POST['name']);
				$description = sanitizeString($POST['description']);
				$type = sanitizeString($POST['type']);
				$color = sanitizeString($POST['color']);
				$numRooms = sanitizeNum($POST['num_rooms']);
				$numBathrooms = sanitizeNum($POST['num_bathrooms']);
				$numToilets = sanitizeNum($POST['num_toilets']);
				$numKitchens = sanitizeNum($POST['num_kitchens']);
				$numPlots = "NA";
				$location = sanitizeString($POST['location']);
				$price = sanitizeString($POST['price']);
				$fileName = sanitizeString($_FILES['file']['name']);
				$name = formatName($name);
				$location = formatStr($location);
				$house = new Property(
					$name,
					$description,
					$type,
					$color,
					$numRooms,
					$numBathrooms,
					$numToilets,
					$numKitchens,
					$numPlots,
					$location,
					$price,
					$fileName
				);
				$connection->real_escape_string($house->name);
				$connection->real_escape_string($house->description);
				$connection->real_escape_string($house->type);
				$connection->real_escape_string($house->color);
				$connection->real_escape_string($house->numRooms);
				$connection->real_escape_string($house->numBathrooms);
				$connection->real_escape_string($house->numToilets);
				$connection->real_escape_string($house->numKitchens);
				$connection->real_escape_string($house->location);
				$connection->real_escape_string($house->price);
				$connection->real_escape_string($house->fileName);
				uploadFile($house->fileName);
				$house->save();
				$response = "Success";
				echo json_encode($response);
			}
			if(ucfirst(strtolower($POST['type'])) == 'Apartment') {
				$name = sanitizeName($POST['name']);
				$description = sanitizeString($POST['description']);
				$type = sanitizeString($POST['type']);
				$color = sanitizeString($POST['color']);
				$numRooms = sanitizeNum($POST['num_rooms']);
				$numBathrooms = sanitizeNum($POST['num_bathrooms']);
				$numToilets = sanitizeNum($POST['num_toilets']);
				$numKitchens = sanitizeNum($POST['num_kitchens']);
				$numPlots = "NA";
				$location = sanitizeString($POST['location']);
				$price = sanitizeString($POST['price']);
				$fileName = sanitizeString($_FILES['file']['name']);
				$name = formatName($name);
				$location = formatStr($location);
				$apartment = new Property(
					$name,
					$description,
					$type,
					$color,
					$numRooms,
					$numBathrooms,
					$numToilets,
					$numKitchens,
					$numPlots,
					$location,
					$price,
					$fileName
				);
				$connection->real_escape_string($apartment->name);
				$connection->real_escape_string($apartment->description);
				$connection->real_escape_string($apartment->type);
				$connection->real_escape_string($apartment->color);
				$connection->real_escape_string($apartment->numRooms);
				$connection->real_escape_string($apartment->numBathrooms);
				$connection->real_escape_string($apartment->numToilets);
				$connection->real_escape_string($apartment->numKitchens);
				$connection->real_escape_string($apartment->location);
				$connection->real_escape_string($apartment->price);
				$connection->real_escape_string($apartment->fileName);
				uploadFile($apartment->fileName);
				$apartment->save();
				$response = "Success";
				echo json_encode($response);
			}
			if(ucfirst(strtolower($POST['type'])) == 'Shop') {
				$name = sanitizeName($POST['name']);
				$description = sanitizeString($POST['description']);
				$type = sanitizeString($POST['type']);
				$color = sanitizeString($POST['color']);
				$numRooms = sanitizeNum($POST['num_rooms']);
				$numBathrooms = sanitizeNum($POST['num_bathrooms']);
				$numToilets = sanitizeNum($POST['num_toilets']);
				$numKitchens = sanitizeNum($POST['num_kitchens']);
				$numPlots = "NA";
				$location = sanitizeString($POST['location']);
				$price = sanitizeString($POST['price']);
				$fileName = sanitizeString($_FILES['file']['name']);
				$name = formatName($name);
				$location = formatStr($location);
				$shop = new Property(
					$name,
					$description,
					$type,
					$color,
					$numRooms,
					$numBathrooms,
					$numToilets,
					$numKitchens,
					$numPlots,
					$location,
					$price,
					$fileName
				);
				$connection->real_escape_string($shop->name);
				$connection->real_escape_string($shop->description);
				$connection->real_escape_string($shop->type);
				$connection->real_escape_string($shop->color);
				$connection->real_escape_string($shop->numRooms);
				$connection->real_escape_string($shop->numBathrooms);
				$connection->real_escape_string($shop->numToilets);
				$connection->real_escape_string($shop->numKitchens);
				$connection->real_escape_string($shop->location);
				$connection->real_escape_string($shop->price);
				$connection->real_escape_string($shop->fileName);
				uploadFile($shop->fileName);
				$shop->save();
				$response = "Success";
				echo json_encode($response);
			}
			if(ucfirst(strtolower($POST['type'])) == 'Land') {
				$name = sanitizeName($POST['name']);
				$description = sanitizeString($POST['description']);
				$type = sanitizeString($POST['type']);
				$color = "NA";
				$numRooms = "NA";
				$numBathrooms = "NA";
				$numToilets = "NA";
				$numKitchens = "NA";
				$numPlots = sanitizeNum($POST['num_plots']);
				$location = sanitizeString($POST['location']);
				$price = sanitizeString($POST['price']);
				$fileName = sanitizeString($_FILES['file']['name']);
				$name = formatName($name);
				$location = formatStr($location);
				$land = new Property(
					$name,
					$description,
					$type,
					$color,
					$numRooms,
					$numBathrooms,
					$numToilets,
					$numKitchens,
					$numPlots,
					$location,
					$price,
					$fileName
				);
				$connection->real_escape_string($land->name);
				$connection->real_escape_string($land->description);
				$connection->real_escape_string($land->type);
				$connection->real_escape_string($land->numPlots);
				$connection->real_escape_string($land->location);
				$connection->real_escape_string($land->price);
				$connection->real_escape_string($land->fileName);
				uploadFile($land->fileName);
				$land->save();
				$response = "Success";
				echo json_encode($response);
			}
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

    function uploadFile($x) {
    	global $uploadsDir;
    	move_uploaded_file($_FILES['file']['tmp_name'], $uploadsDir.$x);
    }

	function sanitizeName($x) {
		$x = strip_tags($x);
		$x = htmlentities($x);
		$x = stripslashes($x);
		$x = preg_replace("/[^a-zA-Z ]/", '', $x);
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