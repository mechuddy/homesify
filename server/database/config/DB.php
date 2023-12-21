<?php
    /**
     * Class
    */
    class DB {
        // props
        public string $DBHost, $DBUser, $DBPassword, $DBName;
        // constructor
        function __construct($DBHost, $DBUser, $DBPassword, $DBName) {
            $this->DBHost = $DBHost;
            $this->DBUser = $DBUser;
            $this->DBPassword = $DBPassword;
            $this->DBName = $DBName;
        }
    }
?>