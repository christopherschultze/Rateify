<?php
    session_start();
    include 'connection.php';
    include 'logic.php';
    $conn = connect();
    $album_name = $_POST['album_name'];
    $result = searchAlbumArtist($conn, $_SESSION['username'], $album_name);
    if($result->num_rows > 0)
    {
        $_SESSION['notify'] = 2;
    }
    else
    {
        $date_created = $_POST['date_created'];
        $_SESSION['notify'] = createAlbum($conn, $album_name, $date_created, $_SESSION['username']);
    }
    header("Location: ../frontend/CreateAlbumView.php");
?>