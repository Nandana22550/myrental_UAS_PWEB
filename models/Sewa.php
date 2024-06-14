<?php
    class Sewa extends Connection{
        public function __construct(){
            parent::__construct();
        }
        public function buy($userID, $kasetID){
            $this->conn->query("insert into sewa values('', '$userID', '$kasetID', 'Menunggu')");
        }
        public function getData($status){
            $result = $this->conn->query("select sewa.id as sewaID, users.nama, kaset.*, sewa.status from sewa join users on sewa.id_users=users.id join kaset on sewa.id_kaset=kaset.id where sewa.status='$status'");
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        public function update($id, $status){
            $this->conn->query("update sewa set status='$status' where id='$id'");
        }
        public function deleteData($id){
            $this->conn->query("delete from sewa where id='$id'");
        }
        public function getDatabyUser($id){
            $result = $this->conn->query("select kaset.*, sewa.status from sewa join users on sewa.id_users=users.id join kaset on sewa.id_kaset=kaset.id where id_users='$id'");
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }
?>