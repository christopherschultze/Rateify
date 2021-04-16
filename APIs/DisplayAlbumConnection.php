<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    
    $conn = connect();
    $_SESSION['album'] = key($_POST['album_name']);
    $_SESSION['albums_artist'] = $_SESSION['username'];

    
    $result = searchSongsInAlbum($conn,$_SESSION['album']);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $result2 = searchSong($conn,$row['song_id']);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                        $song_info[] = $row2;
                }
            }
        }
        $_SESSION['album_songs'] = $song_info;
    }
    else
    {
        $_SESSION['album_songs'] = NULL;
    }

    $result3 = searchAlbum($conn, $_SESSION['album']);
    if ($result3->num_rows > 0) {
        while($row3 = $result3->fetch_assoc()) {
            $album_info = $row3;
        }

        $_SESSION["selected_album"] = $album_info;
    }
    else{
        $_SESSION["selected_album"] = NULL;
    }

    header("Location: ../frontend/AlbumPage.php");

    closeCon($conn); 

    

?>