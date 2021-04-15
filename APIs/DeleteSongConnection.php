<?php

    session_start();
    include 'connection.php';
    include 'logic.php';   
    $conn = connect();
    $song_id = $_POST['song_name'];
    $result = searchSong($conn, $song_id);
    if($result->num_rows > 0)
        deleteSong($conn, $song_id);
    header("Location: ../frontend/DeleteSong.php");
?>