<?php
    include_once '../config/Connection.php';
    include_once '../models/Kaset.php';

    $kaset = new Kaset();
    
    $act = $_GET['act'];
    if ($act == 'add'){
        $filename = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];
        $kaset->addData($_POST['judul'], $_POST['genre'], $_POST['deskripsi'], $_POST['kategori'], $filename, $tempname);
        header("location:../dashboard.php");
    }
    elseif ($act == 'update'){
        if(empty($_FILES['img']['name']) || empty($_FILES['img']['tmp_name'])){
            $kaset->updateData($_POST['id'],  $_POST['judul'], $_POST['genre'], $_POST['deskripsi'], $_POST['kategori'], "", "", $_POST['oldfile']);
            header("location:../dashboard.php");
        }
        else{
            $filename = $_FILES["img"]["name"];
            $tempname = $_FILES["img"]["tmp_name"];
            $kaset->updateData($_POST['id'], $_POST['judul'], $_POST['genre'], $_POST['deskripsi'], $_POST['kategori'], $filename, $tempname, $_POST['oldfile']);
            header("location:../dashboard.php");
        }
    }
    elseif ($act == 'delete'){
        $kaset->deleteData($_GET['id']);
    }
?>