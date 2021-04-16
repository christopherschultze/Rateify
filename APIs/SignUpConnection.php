<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    if(!empty($username) && !empty($password)){
        $_SESSION['notify'] = signup($conn,$username,$password,$account_type);
        echo $_SESSION['notify'];
        header("Location: ../frontend/signup.php");
    }
    else
    {
        $_SESSION['notify'] = 2;
        echo $_SESSION['notify'];
        // header("Location: ../frontend/signup.php");
    }

    closeCon($conn); 


?>