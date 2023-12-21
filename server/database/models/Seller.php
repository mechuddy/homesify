<?php
    /**
     * Class
    */
    class Seller {
        // props
        public string $firstname, $lastname, $email, $phonenum, $password;
        // constructor
        function __construct($firstname, $lastname, $email, $phonenum, $password) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->phonenum = $phonenum;
            $this->password = $password;
        }
        // non-static methods
        function checkExistingPhoneNum() {
            $all = "*";
            $table = "sellers";
            global $connection;
            $sql = "SELECT $all FROM $table WHERE phonenum = '$this->phonenum'";
            $res = $connection->query($sql);
            if($res->num_rows) {
                return true;
            } else {
                return false;
            }
        }
        function checkExistingEmail() {
            $all = "*";
            $table = "sellers";
            global $connection;
            $sql = "SELECT $all FROM $table WHERE email = '$this->email'";
            $res = $connection->query($sql);
            if($res->num_rows) {
                return true;
            } else {
                return false;
            }
        }
        function save() {
            $table = "sellers";
            global $connection;
            $sql = "INSERT INTO $table (firstname, lastname, email, phonenum, password) VALUES (?,?,?,?,?)";
            $prepSql = $connection->prepare($sql);
            $prepSql->bind_param('sssss', $this->firstname, $this->lastname, $this->email, $this->phonenum, $this->password);
            $prepSql->execute();
            $prepSql->close();
        }
        // static methods
        static function findByID($x) {
            $all = "*";
            $table = "sellers";
            global $connection;
            $sql = "SELECT $all FROM $table WHERE id = '$x'";
            $res = $connection->query($sql);
            if($res->num_rows) {
                $seller = $res->fetch_array(MYSQLI_ASSOC);
                return $seller;
            } else {
                return "Seller Not Found";
            }
        }
        static function findByEmail($x) {
            $all = "*";
            $table = "sellers";
            global $connection;
            $sql = "SELECT $all FROM $table WHERE email = '$x'";
            $res = $connection->query($sql);
            if($res->num_rows) {
                $seller = $res->fetch_array(MYSQLI_ASSOC);
                return $seller;
            } else {
                return "Seller Not Found";
            }
        }
        static function findAll() {
            $all = "*";
            $table = "sellers";
            global $connection;
            $sql = "SELECT $all FROM $table";
            $res = $connection->query($sql);
            if($res->num_rows) {
                $sellers = $res->fetch_all(MYSQLI_ASSOC);
                return $sellers;
            } else {
                return "Sellers Not Found";
            }
        }
        static function update($x, $y, $z) {
            $table = "sellers";
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
            $table = "sellers";
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