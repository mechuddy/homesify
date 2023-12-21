<?php
    /**
     * Class
    */
    class Authenticator {
        // props
        public string $email, $password;
        // constructor
        function __construct($email, $password) {
            $this->email = $email;
            $this->password = $password;
        }
        // methods
        function verifyUser() {
            $all = "*";
            global $connection;
            global $table;
            $sql = "SELECT $all FROM $table WHERE email = '$this->email'";
            $result = $connection->query($sql);
            if($result->num_rows) {
                return true;
            } else {
                return false;
            }
        }
        function verifyPassword() {
            $all = "*";
            global $connection;
            global $table;
            $sql = "SELECT $all FROM $table WHERE email = '$this->email'";
            $result = $connection->query($sql);
            if($result->num_rows) {
                $user = $result->fetch_array(MYSQLI_ASSOC);
                if($this->password == $user['password']) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
?>