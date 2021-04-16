<?php

    session_start();
    include 'connection.php';
    include 'logic.php';   
    $conn = connect();
    $username = $_POST['username'];
    $song_id = $_POST['song_id'];
    $result = searchSpecificRatings($conn, $song_id, $username);
    if($result->num_rows > 0) 
    {
        echo "found rating, now deleting rating...";
        $_SESSION['notify'] = deleteRating($conn, $username, $song_id);
        echo "rating deleted!";
    }
    else
    {
        $_SESSION['notify'] = 2;
        echo "rating not found";
    }
    header("Location: ../frontend/DeleteRating.php");
?>