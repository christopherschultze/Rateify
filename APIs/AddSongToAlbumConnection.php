<?php
    session_start();
    include 'logic.php';
    include 'connection.php';
    $conn = connect();
    $_SESSION['all_songs_of_artist'] = array();
    $result = searchSongByArtist($conn, $_SESSION['username']);
    if($result -> num_rows > 0)
    {
        while($row=$result->fetch_assoc())
            array_push($_SESSION['all_songs_of_artist'], $row['song_id']);
    }
    // print_r($_SESSION['all_songs_of_artist']);
    header("Location: ../frontend/AddSongToAlbumView.php");
?>