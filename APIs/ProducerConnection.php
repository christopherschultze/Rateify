<?php
    session_start();
    include 'logic.php';
    include 'connection.php';
    $conn = connect();
    $song_name = $_POST['song_name'];
    $producer_name = $_SESSION['username'];
    $duration = $_POST['track_duration'];
    $date = $_POST['date'];
    $result = getMaxSongID($conn);
    $row = $result->fetch_assoc();
    $id = $row['max_id'] + 1;
    $_SESSION['notify'] = createSong($conn, $id, NULL, 0, $duration, $song_name, $date, $producer_name, 'producer');
    header("Location:../frontend/ProducerFrontEnd.php");
?>