<?php

    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = login($conn,$username,$password);

    closeCon($conn); 


?>