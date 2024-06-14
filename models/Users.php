<?php
    class Users extends Connection{
        public function __construct(){
            parent::__construct();
        }

        public function getAdmin(){
            $result = $this->conn->query("select * from users where status = 'Admin'");
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }

        public function getUser(){
            $result = $this->conn->query("select * from users where status = 'User'");
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        
        public function deleteData($id){
            $this->conn->query("delete from users where id='$id'");
        }

        public function promote($id){
            $this->conn->query("update users set status='Admin' where id='$id'");
        }

        public function demote($id){
            $this->conn->query("update users set status='User' where id='$id'");
        }

        public function signup($name, $email, $pass){
            $this->conn->query("insert into users values('','$name','$email','$pass', 'User')");
        }

        public function signin($email, $pass){
            $result = $this->conn->query("select * from users where email='$email' AND password='$pass'");
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }
?>