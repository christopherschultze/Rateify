<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_SESSION['username'];
    
    $_SESSION['curr_playlist'] = 0;
    $result = searchPlaylistsByUser($conn,$username);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $playlist_names[] = $row['name'];
            }

            $_SESSION['users_playlists'] = $playlist_names;
        }
        $result = searchSongsInPlaylist($conn, $_SESSION['users_playlists'][$_SESSION['curr_playlist']]);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $songInfo = searchSong($conn, $row["song_id"]);
                if ($result->num_rows > 0){
                    while($row2 = $songInfo->fetch_assoc())
                    {
                        $song_info[] = $row2;
                        // $row2["name"]; //song name
                        // $row2["id"]; // song id
                        // $row2['album_name']; //album name
                        // $row2['no_of_plays']; //album name
                        // $row2['duration']; //album name
                        // $row2['date_created']; //album name
                    }
                }
            }
    
            $_SESSION['songs_info'] = $song_info;
          } 
          else{
              $_SESSION['songs_info'] = null;
          }

        header("Location: ../frontend/listenerPlaylists.php");

    closeCon($conn); 


?>