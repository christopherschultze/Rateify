<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    
    $conn = connect();
    $_SESSION['album'] = key($_POST['album_name']);
    $_SESSION['songs_artist'] = $_SESSION['username'];

    
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

    header("Location: ../frontend/AlbumPage.php");

    closeCon($conn); 

    

?>