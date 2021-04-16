<?php
    session_start();
    include 'connection.php';
    include 'logic.php';
    $conn = connect();
    $playlist_name = $_POST['playlist_name'];
    $username = $_SESSION['username'];
    createPlaylist($conn, $playlist_name, $username);
    $_SESSION['curr_playlist'] = 0;
    $_SESSION['artist_name'] = 0;
    $_SESSION['users_playlists'] = 0;
    $result = searchPlaylistsByUser($conn,$username);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $playlist_names[] = $row['name'];
            }

            $_SESSION['users_playlists'] = $playlist_names;
        }
        else{
            $_SESSION['users_playlists'] = NULL;
        }
        $result = searchSongsInPlaylist($conn, $_SESSION['users_playlists'][$_SESSION['curr_playlist']]);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $songInfo = searchSong($conn, $row["song_id"]);
                if ($songInfo->num_rows > 0){
                    while($row2 = $songInfo->fetch_assoc())
                    {
                         $song_info[] = $row2;
                         $artist = searchArtistBySong($conn, $row['id']);
                        if($artist -> num_rows > 0)
                        {
                            $row_number = 0;
                            while($row3 = $artist->fetch_assoc())
                            {
                                $_SESSION['artist_name'][$row_number] = $row3['artist_username'];
                                $row_number++;
                            }
                        }
                        
                    }
                }
            }
    
            $_SESSION['songs_info'] = $song_info;
          } 
          else{
              $_SESSION['songs_info'] = NULL;
              $_SESSION['artist_name'] = NULL;
          }
    header("Location: ../frontend/listenerPlaylists.php");
?>