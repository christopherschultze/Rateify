<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_SESSION['username'];
    $song_info = array();
    // $artists = array();
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
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $songInfo = searchSong($conn, $row["song_id"]);
                if ($result->num_rows > 0){
                    while($row2 = $songInfo->fetch_assoc())
                    {
                         array_push($song_info, $row2);
                         $artist = searchArtistBySong($conn, $row['id']);
                        if($artist -> num_rows > 0)
                        {
                            $row_number = 0;
                            while($row3 = $artist->fetch_assoc())
                            {
                                // array_push($artists, $row3['artist_username'];
                                $_SESSION['artist_name'][$row_number] = $row3['artist_username'];
                                $row_number++;
                                // array_push($artists, $row2['artist_username']);
                            }
                        }
                        //  $artist = searchArtistBySong($conn,$row2['id']);
                        // $row3 = $artist->fetch_assoc();
                        // array_push($song_info,$row3);
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
              $_SESSION['songs_info'] = NULL;
              $_SESSION['artist_name'] = NULL;
          }

        header("Location: ../frontend/listenerPlaylists.php");

    closeCon($conn); 


?>