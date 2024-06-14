<?php
    include_once '../config/Connection.php';
    include_once '../models/Sewa.php';

    $sewa = new Sewa();
    
    $act = $_GET['act']; 
    if ($act == 'buy'){
        $sewa->buy($_POST['userID'], $_POST['filmID']);
        header("location:../index.php");
    }
    elseif($act == 'update'){
        $sewa->update($_GET['id'], $_GET['status']);
        header("location:../dashboard.php");
    }
    elseif($act == 'delete'){
        $sewa->deleteData($_GET['id']);
    }
?>