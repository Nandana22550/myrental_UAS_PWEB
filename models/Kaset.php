<?php
    class Kaset extends Connection{
        public function __construct(){
            parent::__construct();
        }

        public function getData(){
            $result = $this->conn->query("select * from kaset");
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        public function addData($judul, $genre, $deskripsi, $kategori, $filename, $tempname){
            $newfilename= date('dmYHis').str_replace(" ", "", basename($filename));
            $folder = "../assets/img/upload/" . $newfilename;
            move_uploaded_file($tempname, $folder);
            $this->conn->query("insert into kaset values('','$judul', '$genre', '$deskripsi', '$kategori','$newfilename')");
        }

        public function updateData($id, $judul, $genre, $deskripsi, $kategori, $filename, $tempname, $oldfile){
            if($filename=="" || $tempname==""){
                $this->conn->query("update kaset set judul='$judul', genre='$genre', deskripsi='$deskripsi', kategori='$kategori', img='$oldfile' where id='$id'");
            }
            else{
                $newfilename= date('dmYHis').str_replace(" ", "", basename($filename));
                $folder = "../assets/img/upload/" . $newfilename;
                $oldfolder = "../assets/img/upload/" . $oldfile;
                unlink("$oldfolder");
                move_uploaded_file($tempname, $folder);
                $this->conn->query("update kaset set judul='$judul', genre='$genre', deskripsi='$deskripsi', kategori='$kategori', img='$newfilename' where id='$id'");
            }
        }
        
        public function deleteData($id){
            $result = $this->conn->query("select img from kaset where id='$id'");
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            foreach ($rows as $key => $r) {
                $fileloc = "../assets/img/upload/" .$r['img'];
                if(file_exists($fileloc)){
                    // header("location:../index.php");
                    unlink($fileloc);
                }
            }
            
            $this->conn->query("delete from kaset where id='$id'");
        }
    }
?>