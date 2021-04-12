<?php

    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    if(isset($_SESSION['username'] && isset($_SESSION['password']))){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
    
        $result = login($conn,$username,$password);
        $row = mysqli_fetch_assoc($result);
        if($row['account_type'] == "user"){
            header("Location: listener.php");
            die;
        }
        else if($row['account_type'] == "artist"){
            header("Location: artist.php");
            die;
        }
        else if($row['account_type'] == "admin"){
            header("Location: admin.php");
            die;
        }
        else if($row['account_type'] == "producer"){
            header("Location: producer.php");
            die;
        }
        return $row;
    }
    
    closeCon($conn); 


?>