<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    if(!empty($username) && !empty($password)){
        signup($conn,$username,$password,$account_type);
        header("Location: ../frontend/login.php")
        die;
    }

    closeCon($conn); 


?>