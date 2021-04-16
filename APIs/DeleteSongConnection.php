<?php

    session_start();
    include 'connection.php';
    include 'logic.php';   
    $conn = connect();
    $song_id = $_POST['song_name'];
    $result = searchSong($conn, $song_id);
    // $_SESSION['notify'] = 2;
    if($result->num_rows > 0)
        $_SESSION['notify'] = deleteSong($conn, $song_id);
    else
        $_SESSION['notify'] = 2;
    // echo $_SESSION['notify'];
    header("Location: ../frontend/DeleteSong.php");
?>