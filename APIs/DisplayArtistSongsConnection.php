<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_SESSION['username'];
    // $artists = array();
    $result = searchSongByArtist($conn,$username);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $songInfo = searchSong($conn, $row['song_id']);
                if ($songInfo->num_rows > 0){
                    while($row2 = $songInfo->fetch_assoc())
                    {
                        $artists_song_info[] = $row2;
                    }
                }
            }
            $_SESSION['artists_songs'] = $artists_song_info;
        }else{
            $_SESSION['artists_songs'] = NULL;
        }
        
        //echo $_SESSION['artists_songs']['name'];
        header("Location: ../frontend/ArtistViewSongs.php");

    closeCon($conn); 


?>