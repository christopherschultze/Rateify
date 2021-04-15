<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_SESSION['username'];
    $result = searchArtistAlbum($conn,$username);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $albumInfo = searchAlbum($conn, $row['album_name']);
                if ($result->num_rows > 0){
                    while($row2 = $songInfo->fetch_assoc())
                    {
                        $artists_album_info[] = $row2;
                    }
                }
            }
            $_SESSION['artists_albums'] = $artists_album_info;
        }else{
            $_SESSION['artists_albums'] = NULL;
        }
        
       // header("Location: ../frontend/ArtistViewAlbums.php");

    closeCon($conn); 


?>