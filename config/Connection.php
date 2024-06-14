<?php
    class Connection{
        public $host = "localhost";
        public $uname = "root";
        public $pass = "";
        public $db = "db_rental";

        public $conn;

        public function __construct(){
            $this->conn = new mysqli($this->host, $this->uname, $this->pass, $this->db);
            if (!$this->conn) {
				echo 'Cannot connect to database server';
				exit;
			}
            return $this->conn;
        }
    }
?>