<?php
    include_once '../config/Connection.php';
    include_once '../models/Users.php';

    $user = new Users();
    
    $act = $_GET['act']; 
    if ($act == 'signup'){
        $user->signup($_POST['name'], $_POST['email'], $_POST['pass']);
        $res = $user->signin($_POST['email'], $_POST['pass']);
        if (empty($res)) {
            header("location:../index.php");
        }
        else {
            session_start();
            $_SESSION["id"] = '';
            $_SESSION["name"] = '';
            $_SESSION["status"] = '';
            foreach ($res as $key => $r) {
                $_SESSION["id"] = $r['id'];
                $_SESSION["name"] = $r['nama'];
                $_SESSION["status"] = $r['status'];
            }
            $_SESSION["email"] = $_POST['email'];
            if($_SESSION["status"] == 'Admin' || $_SESSION["status"] == 'SuperAdmin'){
                header("location:../dashboard.php");
            }
            else{
                header("location:../index.php");
            }
        }
    }
    elseif ($act == 'signin'){
        $res = $user->signin($_POST['email'], $_POST['pass']);
        if (empty($res)) {
            header("location:../index.php");
        }
        else {
            session_start();
            $_SESSION["id"] = '';
            $_SESSION["name"] = '';
            $_SESSION["status"] = '';
            foreach ($res as $key => $r) {
                $_SESSION["id"] = $r['id'];
                $_SESSION["name"] = $r['nama'];
                $_SESSION["status"] = $r['status'];
            }
            $_SESSION["email"] = $_POST['email'];
            if($_SESSION["status"] == 'Admin' || $_SESSION["status"] == 'SuperAdmin'){
                header("location:../dashboard.php");
            }
            else{
                header("location:../index.php");
            }
        }
    }
    elseif ($act == 'promote'){
        $user->promote($_GET['id']);
        header("location:../dashboard.php");
    }
    elseif ($act == 'demote'){
        $user->demote($_GET['id']);
        header("location:../dashboard.php");
    }
    elseif ($act == 'logout'){
        session_start();
        session_destroy();
        header("location:../index.php");
    }
    elseif ($act == 'delete'){
        $user->deleteData($_GET['id']);
    }
    else{
        header("location:../dashboard.php");
    }
?>