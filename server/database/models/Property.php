<?php
    /**
     * Class
    */
    class Property {
        // props
        public string $name, $description, $type, $color, $numRooms, $numBathrooms, $numToilets, $numKitchens, $numPlots, $location, $price, $fileName;
        // constructor
        function __construct($name, $description, $type, $color, $numRooms, $numBathrooms, $numToilets, $numKitchens, $numPlots, $location, $price, $fileName) {
            $this->name = $name;
            $this->description = $description;
            $this->type = $type;
            $this->color = $color;
            $this->numRooms = $numRooms;
            $this->numBathrooms = $numBathrooms;
            $this->numToilets = $numToilets;
            $this->numKitchens = $numKitchens;
            $this->numPlots = $numPlots;
            $this->location = $location;
            $this->price = $price;
            $this->fileName = $fileName;
        }
        // non-static methods
        function save() {
            $table = "properties";
            global $connection;
            $sql = "INSERT INTO $table (name, description, type, color, num_rooms, num_bathrooms, num_toilets, num_kitchens, num_plots, location, price, filename) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $prepSql = $connection->prepare($sql);
            $prepSql->bind_param('ssssssssssss', $this->name, $this->description, $this->type, $this->color, $this->numRooms, $this->numBathrooms, $this->numToilets, $this->numKitchens, $this->numPlots, $this->location, $this->price, $this->fileName);
            $prepSql->execute();
            $prepSql->close();
        }
        // static methods
        static function findByID($x) {
            $all = "*";
            $table = "properties";
            global $connection;
            $sql = "SELECT $all FROM $table WHERE id = '$x'";
            $res = $connection->query($sql);
            if($res->num_rows) {
                $property = $res->fetch_array(MYSQLI_ASSOC);
                return $property;
            } else {
                return "Property Not Found";
            }
        }
        static function findAll() {
            $all = "*";
            $table = "properties";
            global $connection;
            $sql = "SELECT $all FROM $table";
            $res = $connection->query($sql);
            if($res->num_rows) {
                $properties = $res->fetch_all(MYSQLI_ASSOC);
                return $properties;
            } else {
                return "Properties Not Found";
            }
        }
        static function update($x, $y, $z) {
            $table = "properties";
            global $connection;
            $sql = "UPDATE $table SET $y = '$z' WHERE id = '$x'";
            $res = $connection->query($sql);
            if($res == true) {
                return true;
            } else {
                return false;
            }
        }
        static function delete($x) {
            $table = "properties";
            global $connection;
            $sql = "DELETE FROM $table WHERE id = '$x'";
            $res = $connection->query($sql);
            if($res == true) {
                return true;
            } else {
                return false;
            }
        }
    }
?>