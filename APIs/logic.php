<?php
        function hello2($conn, $message)
        {
            echo "<script>alert('$message');</script>";
        }
        //logs in with provided user info and password, then use SQL query to query database 
        //after qurerying return the result
        function login($conn, $username, $pwd) // done2
        {
            $sql = "SELECT * FROM account WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $pwd);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }
        //searches an account based on a given username
        //SQL queries the account table and returns all tuples that have matching username with the given $username
        function searchAccount($conn, $username) // done2
        {
            //$sql = "SELECT * FROM spotify.account WHERE username = '$username'";
            //$result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM spotify.account WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        } 

        function signup($conn, $username, $password, $type) //done2
        {
            $result = getMaxID($conn);
            $row = $result->fetch_assoc(); 
            $id = $row["max_id"] + 1;
            $sql = "INSERT INTO account (username, password, account_type, id)
                    VALUES(?, ?, ?, $id)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $username, $pwd,$type);
            
            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        function getMaxID($conn){
            $sql = "SELECT MAX(id) AS max_id FROM account";
            $result = mysqli_query($conn,$sql);
            return $result;
        }

        function getMaxSongID($conn){
            $sql = "SELECT MAX(id) AS max_id FROM song";
            $result = mysqli_query($conn,$sql);
            return $result;
        }
        //queries in song table and searches for all tuples that matches the given songId
        //return the tuple of the song table if there is a matching tuple
        function searchSong($conn, $songId) // done2
        {
            $sql = "SELECT * FROM spotify.song WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function searchArtistSong($conn, $username, $song_id)
        {
            $sql = "SELECT * FROM artist_song WHERE song_id = ? AND artist_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $song_id, $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        // function searchSongByArt

        //searches for all albums inside album table
        //returns any tuples that have name = $album_name
        function searchAlbum($conn, $album_name) //done2
        {
            // $sql = "SELECT * FROM album WHERE name = '$album_name'";
            // $result = $conn->query($sql);
            $sql = "SELECT * FROM album WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $album_name);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        //queries for all the songs in an album in the song table using a given $album_name
        //result will contain all the songs that are in this specified album
        function searchSongsInAlbum($conn, $album_name) //done2
        {
            // $sql = "SELECT * FROM album_song WHERE album_name = '$album_name'";
            // $result = mysqli_query($conn, $sql);
            
            $sql = "SELECT * FROM album_song WHERE album_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $album_name);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function searchAlbumBySong($conn, $song_id)
        {
            //$sql = "SELECT album_name FROM album_song WHERE song_id = '$song_id'";
            //$result = mysqli_query($conn, $sql);

            $sql = "SELECT album_name FROM album_song WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $song_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        //queries for all the songs in a playlist in the song table using a given $playlist_name
        //result will contain all the songs that are in this specified playlist
        function searchSongsInPlaylist($conn, $playlist_name) //done2
        {
            // $sql = "SELECT song_id FROM playlist_song WHERE playlist_name = '$playlist_name'";
            // $result = $conn->query($sql);

            $sql = "SELECT song_id FROM playlist_song WHERE playlist_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $playlist_name);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        //queries for all the songs in a playlist in the song table using a given $username of an artist
        //result will contain all the songs that are made by this artist
        function searchSongByArtist($conn, $username) //done2
        {
            // $sql = "SELECT * FROM artist_song WHERE artist_username = '$username'";
            $sql = "SELECT * FROM artist_song WHERE artist_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        //queries for all the songs in a playlist in the song table using a given $username of a producer
        //result will contain all the songs that are made by this producer
        function searchSongByProducer($conn, $username) //done2
        {
            //$sql = "SELECT * FROM producer_song WHERE producer_username = '$username'";
            //$result = $conn->query($sql);

            $sql = "SELECT * FROM producer_song WHERE producer_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function searchSongByName($conn, $song_name) //done2
        {
            $sql = "SELECT * FROM song AS songs, artist_song AS artists WHERE songs.id = artists.song_id AND songs.name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $song_name);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function searchArtistBySong($conn, $songID)
        {
            // $sql = "SELECT * FROM artist_song WHERE song_id = $songID";
            // $result = mysqli_query($conn, $sql);

            $sql = "SELECT * FROM artist_song WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
        }

        //queries all playlist that matches the given $playlist_name in the playlist table
        //result contains all the information of all matching playlist
        function searchPlaylist($conn, $playlist_name) //done2
        {
            // $sql = "SELECT * FROM playlist WHERE name = '$playlist_name'";
            // $result = mysqli_query($conn, $sql);

            $sql = "SELECT * FROM playlist WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $playlist_name);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;
        }

        function searchPlaylistsByUser($conn, $username){
            // $sql = "SELECT * FROM playlist WHERE user_username = '$username'";
            // $result = mysqli_query($conn, $sql);

            $sql = "SELECT * FROM playlist WHERE user_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
        }
        //queries all albums that are made by a specific artist by using the given $artistusername
        //result contains all the album name taken from the matching tuples
        function searchArtistAlbum($conn, $username) // done2
        {
            // $sql = "SELECT * FROM artist_album WHERE artist_username = '$username'";
            // $result = mysqli_query($conn, $sql);

            $sql = "SELECT * FROM artist_album WHERE artist_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;
        }

        function searchAlbumArtist($conn, $username, $album_name)
        {
            $sql = "SELECT * FROM artist_album WHERE artist_username = '$username' AND album_name = '$album_name'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        // Searches for all Ratings made under a specific song
        // result contains all ratings under a song
        function searchRatings($conn, $songID) //done2
        {
            // $sql = "SELECT * FROM rating WHERE song_id = $songID";
            // $result = mysqli_query($conn, $sql);

            $sql = "SELECT * FROM rating WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;
        }

        // Searches for a rating under a specific song made by a specific user
        // result contains all ratings made by specific user under specific song
        function searchSpecificRatings($conn, $songID, $username) //done2
        {
            $sql = "SELECT * FROM rating WHERE song_id = ? AND user_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $songID, $user_username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        // Searches for all Ratings made by a specific user
        // result contains all rating made by specific user
        function searchUsersRating($conn,$username){ //done2
            // $sql = "SELECT * FROM rating WHERE user_username = '$username'";
            // $result = mysqli_query($conn, $sql);

            $sql = "SELECT * FROM rating WHERE user_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;
        }
        // creates a new Song based on the passed in info, if the album_name is not null, it also add the song to the album. Also based on the type of user, 
        //the corressponding function is also called to create a relation
        function createSong($conn, $id, $album_name, $no_of_plays, $duration, $name, $date_created, $username, $type) //done2
        {
            $notify = 0;
            if($album_name == NULL)
            {
                $sql = "INSERT INTO song (id, album_name, no_of_plays, duration, name, date_created)
                        VALUES (?, NULL, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('iidss', $id, $no_of_plays, $duration, $name, $date_created);
                        //VALUES ('$id', NULL, '$no_of_plays', '$duration', '$name', '$date_created')";
                //if ($conn->query($sql) === TRUE) {
                   // echo "<script>alert('song created successfully');</script>";
                    //$notify = 1;
               // } else {
                   // $notify = 2;
                   // echo "<script>alert('Error creating song');</script>";
               // }
               

            }
            else
            {
                $sql = "INSERT INTO song (id, album_name, no_of_plays, duration, name, date_created)
                         VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('isidss', $id, $album_name, $no_of_plays, $duration, $name, $date_created);
                        //VALUES ('$id', '$album_name', '$no_of_plays', '$duration', '$name', '$date_created')";
                // if ($conn->query($sql) === TRUE) {
                //     echo "<script>alert('song created successfully');</script>";
                //     $notify = 1;
                // } else {
                //     $notify = 2;
                //  echo "Error: " . $sql . "<br>" . $conn->error;
                // }
                // $sql2 = "INSERT INTO album_song(album_name, song_id) VALUES('$album_name', '$id')";
                // if ($conn->query($sql2) === TRUE) {
                //     echo "<script>alert('song added to album successfully');</script>";
                // } else {
                //     echo "<script>alert('Error adding song to album');</script>";
                // }
               
            }
            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
                // TODO: is error message worth fixing? $sql is not what is expected (this applies to many error messages)
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
            if($album_name != NULL)
                addSongToAlbum($conn, $album_name, $id);
            if($type == 'artist')
                addToArtistSong($conn, $username, $id);
            if($type == 'producer')
                addToProduceSong($conn, $username, $id);
            return $notify;
        }

        // Connects a artists and the song that they have created
        function addToArtistSong($conn, $username, $id) // done2
        {
            $sql = "INSERT INTO artist_song (artist_username, song_id)
                    VALUES(?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $username, $id);

            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Connects a prducer and the song that they have produced
        function addToProduceSong($conn, $username, $id) //done2
        {
            $sql = "INSERT INTO producer_song (producer_username, song_id)
                    VALUES(?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $username, $id);
            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        //creates a playlist that has a unique name within the user's playlists
        function createPlaylist($conn, $name, $user_username) //done2
        {
            $sql = "INSERT INTO playlist (user_username, name, no_of_songs, duration)
                    VALUES(?, ?, 0, 0)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $user_username, $name);
            $stmt->execute();
            if($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
                //  echo "Error: " . $sql . "<br>" . $conn->error;
                echo "Error: in createPlaylist";
            }  
        }

        //Adds a specific song to a specific Album and calls the makeChangestoAlbum function to edit Album info based on Song info
        function addSongToAlbum($conn, $a_name, $songId) // done2
        {

            $sql = "INSERT INTO album_song (album_name, song_id) 
            VALUES(?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $a_name, $songId);
            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }        
            $sql = "UPDATE song SET album_name = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $a_name, $songId);
            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }       
            makeChangestoAlbum($conn, $a_name, $songId);
        }

        //Adds a specific song to a specific Playlist and calls the makeChangestoPlaylist function to edit Playlist info based on Song info
        function addSongToPlayList($conn, $p_name, $songId) //done2
        {

            //$sql = "INSERT INTO playlist_song (playlist_name, song_id) 
            //        VALUES('$p_name', '$songId')";

            $sql = "INSERT INTO playlist_song (playlist_name, song_id) 
                    VALUES(?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $p_name, $songId);
        
            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
            makeChangestoPlaylist($conn, $p_name, $songId);
        }

        function increaseNoOfPlays($conn, $songId) //done2
        {
            $sql = "UPDATE song SET no_of_plays = no_of_plays + 1 WHERE id = '$songId' ";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
        }

        //creates a new Album and specifies the name of the album as well as the date created (no_of_songs and duration are set to 0 to begin with)
        function createAlbum($conn, $album_name, $date_created, $username) //done2
        {
            // $notify = 0;
            // $sql = "INSERT INTO album (name, no_of_songs, duration, date_created)
            //         VALUES('$album_name', 0, 0, '$date_created')";
            // if ($conn->query($sql) === TRUE) {
            //     $notify = 1;
            // $sql = "INSERT INTO album (name, no_of_songs, duration, date_created)
            //         VALUES('$album_name', 0, 0, '$date_created')";

            $sql = "INSERT INTO album (name, no_of_songs, duration, date_created)
                    VALUES(?, 0, 0, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $album_name, $date_created);

            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
                $notify = 2;
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $sql = "INSERT INTO artist_album(artist_username, album_name) VALUES ('$username', '$album_name')";  
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
            return $notify;
        }

        // Adds a new rating to a specific song that is made by a specific user
        function addRating($conn, $username, $songId, $comment, $star_rating) //done2
        {
            // $sql = "INSERT INTO rating (user_username, song_id, star_rating, comment)
            //         VALUES('$username', '$songId', '$star_rating', '$comment')";
            $sql = "INSERT INTO rating (user_username, song_id, star_rating, comment)
                     VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('siis', $username, $songID, $star_rating, $comment);

            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
        }

        // function that is called whenever a new song is added to a Album which edits the no_of_songs and duration of the playlist
        function makeChangestoAlbum($conn, $a_name, $songId) // done2
        {
            $result = searchSong($conn, $songId);
            $dur = 0;
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $dur = $row['duration'];
                $sql = "UPDATE album SET duration = duration + $dur WHERE name = ? ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $a_name);

                if ($stmt->execute() === TRUE) {
                    echo "New record created successfully";
                } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
                } 
                $sql = "UPDATE album SET no_of_songs = no_of_songs + 1 WHERE name = ? ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $a_name);
                if ($stmt->execute() === TRUE) {
                    echo "New record created successfully";
                } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
                } 
            }

            else
            {
                echo "song not found";
            }
            
        }

        // function that is called whenever a new song is added to a playlist which edits the no_of_songs and duration of the playlist
        function makeChangestoPlaylist($conn, $p_name, $songId) // done2
        {
            $result = searchSong($conn, $songId);
            $dur = 0;
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $dur = $row['duration'];
                //$sql = "UPDATE playlist SET duration = duration + $dur WHERE name = '$p_name' ";

                $sql = "UPDATE playlist SET duration = duration + $dur WHERE name = ? ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $p_name);

                if ($stmt->execute() === TRUE) {
                    echo "New record created successfully";
                } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
                }  
                // $sql = "UPDATE playlist SET no_of_songs = no_of_songs + 1 WHERE name = '$p_name' ";

                $sql = "UPDATE playlist SET no_of_songs = no_of_songs + 1 WHERE name = ? ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $p_name);

                if ($stmt->execute() === TRUE) {
                    echo "New record created successfully";
                } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
                }  
            }
            else
            {
                echo "Song not found";  
            }
            
        }

        // allows a general user or an admin to edit the comment of a Rating made by a specific user on a specific song 
        function editComment($conn, $username, $songId, $comment) //done2
        {
            //$sql = "UPDATE rating SET comment = '$comment' WHERE user_username = '$username' AND song_id = $songId";

            $sql = "UPDATE rating SET comment = ? WHERE user_username = ? AND song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssi', $comment, $username, $songId);

            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
        }

        // allows a general user or an admin to edit the Star rating of a Rating made by a specific user on a specific song 
        function editStarRating($conn, $username, $songId, $star) //done2
        {
            //$sql = "UPDATE rating SET star_rating = $star WHERE user_username = '$username' AND song_id = $songId";

            $sql = "UPDATE rating SET star_rating = ? WHERE user_username = ? AND song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('isi', $star, $username, $songId);

            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // if the user is an admin, it lets the user delete a Song as well as all relations that song has
        function deleteSong($conn, $songID) //done2
        {
            $notify = 0;
            $result = searchSong($conn, $song_id);
                $sql = "DELETE FROM album_song WHERE song_id = $songID";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Song deleted successfully');</script>";
                    $notify = 1;
                    } else {
                    echo "Error deleting record: " . $conn->error;
                    $notify = 2;
                    }
                $sql = "DELETE FROM playlist_song WHERE song_id = $songID";
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                    } else {
                    echo "Error deleting record: " . $conn->error;
                    }
                $sql = "DELETE FROM producer_song WHERE song_id = $songID";
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                    } else {
                    echo "Error deleting record: " . $conn->error;
                    }
                $sql = "DELETE FROM artist_song WHERE song_id = $songID";
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                    } else {
                    echo "Error deleting record: " . $conn->error;
                    }

                // $sql = "DELETE FROM rating WHERE song_id = $songID";
                // if ($conn->query($sql) === TRUE) {
                //     echo "Record deleted successfully";
                //     } else {
                //     echo "Error deleting record: " . $conn->error;
                //     }

                // $sql = "DELETE FROM song WHERE id = '$songID'";

                // if ($conn->query($sql) === TRUE) {
            $sql = "DELETE FROM album_song WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);
            if ($stmt->execute() === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "Error deleting record: " . $conn->error;
                }
            $sql = "DELETE FROM playlist_song WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);
            if ($stmt->execute() === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "Error deleting record: " . $conn->error;
                }
            $sql = "DELETE FROM producer_song WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);
            if ($stmt->execute() === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "Error deleting record: " . $conn->error;
                }
            $sql = "DELETE FROM artist_song WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);
            if ($stmt->execute() === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "Error deleting record: " . $conn->error;
                }

            $sql = "DELETE FROM rating WHERE song_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);
            if ($stmt->execute() === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "song not found " . $conn->error;
                }
           

            $sql = "DELETE FROM song WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $songID);

            if ($stmt->execute() === TRUE) {
            echo "Record deleted successfully";
            } else {
            echo "song not found " . $conn->error;
            }

            return $notify;
        }

        //if the user is an admin, it lets the user delete a rating made by a specific user on a specific song 
        function deleteRating($conn, $username, $songId) //done2
        {
            $sql = "DELETE FROM rating WHERE song_id = ? AND user_username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $songId, user_username);
            if ($stmt->execute() === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "song not found " . $conn->error;
                }
            if ($stmt->execute() === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "song not found " . $conn->error;
                }
        }

        //uses the DELETE keyword for SQL and remove a song in that playlist
        //after removing that song from that playlist in the playlist_song table, query for the song info using the searchSrong function
        //the return value of the searchSong function will contain the duration of the song
        //using the duration of this song to reduce the duration of the playlist and decrease the no_of_songs in the playlist by 1 as well
        function removeSongFromPlaylist($conn, $playlist_name, $songID, $username) //done2
        {
            $playlist = searchPlaylist($conn, $playlist_name);

            if ($playlist->num_rows > 0) {
                //     // output data of each row
                    while($row = $playlist->fetch_assoc()) {
                        if($row["user_username"] == $username)
                        {
                            //$sql = "DELETE FROM playlist_song WHERE song_id = $songID AND playlist_name = '$playlist_name'";

                            $sql = "DELETE FROM playlist_song WHERE song_id = ? AND playlist_name = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('is', $songID, $playlist_name);
                            

                            if ($stmt->execute() === TRUE) {
                                echo "Record deleted successfully";
                                } else {
                                echo "song not found " . $conn->error;
                                }
                            
                            $dur = 0;
                            $result = searchSong($conn, $songID);
                            if ($result->num_rows > 0)
                            {
                                $row = $result->fetch_assoc();
                                $dur = $row['duration'];
                                // $sql = "UPDATE playlist SET no_of_songs = no_of_songs - 1 WHERE name = '$playlist_name'";

                                $sql = "UPDATE playlist SET no_of_songs = no_of_songs - 1 WHERE name = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $playlist_name);

                                if ($stmt->execute() === TRUE) {
                                    echo "Record deleted successfully";
                                    } else {
                                    echo "song not found " . $conn->error;
                                    }
                                // $sql = "UPDATE playlist SET duration = duration - $dur WHERE name = '$playlist_name'";

                                $sql = "UPDATE playlist SET duration = duration - $dur WHERE name = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $playlist_name);

                                if ($stmt->execute() === TRUE) {
                                    echo "Record deleted successfully";
                                    } else {
                                    echo "song not found " . $conn->error;
                                    }
                            }
                            else
                                echo "song not found";
                        }
                    }
                }
        }
?>