<?php
    session_start();
    include 'logic.php';
    include 'connection.php';
    $conn = connect();
    $comment = $_POST['comment'];
    $star = $_POST['star'];
    $artist = $_SESSION['artist_rating'];
    $song_name = $_SESSION['song_name_rating'];
    // $conn, $username, $songId, $comment, $star_rating
    $result = searchSongByArtist($conn, $artist);
    $id = $result ->fetch_assoc();
    $song_id = $id['song_id'];
    // $conn, $username, $songId, $comment, $star_rating
    $_SESSION['notify'] = addRating($conn, $_SESSION['username'], $song_id, $comment, $star);
    header("Location: ../frontend/RatingView.php");
?>