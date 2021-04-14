<?php

        //logs in with provided user info and password, then use SQL query to query database 
        //after qurerying return the result
        function login($conn, $username, $pwd) // done2
        {
            $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$pwd'";
            $result = mysqli_query($conn, $sql);
            return $result;
        }
        //searches an account based on a given username
        //SQL queries the account table and returns all tuples that have matching username with the given $username
        function searchAccount($conn, $username) // done2
        {
            $sql = "SELECT * FROM spotify.account WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        } 

        function signup($conn, $username, $password, $type) //done2
        {
            $result = getMaxID($conn);
            $row = $result->fetch_assoc(); 
            $id = $row["max_id"] + 1;
            $sql = "INSERT INTO account (username, password, account_type, id)
                    VALUES('$username', '$password', '$type', '$id')";
            if ($conn->query($sql) === TRUE) {
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
        //queries in song table and searches for all tuples that matches the given songId
        //return the tuple of the song table if there is a matching tuple
        function searchSong($conn, $songId) // done2
        {
            $sql = "SELECT * FROM spotify.song WHERE id = $songId";
            $result = $conn->query($sql);
            
            return $result;
        }

        //searches for all albums inside album table
        //returns any tuples that have name = $album_name
        function searchAlbum($conn, $album_name) //done2
        {
            $sql = "SELECT * FROM album WHERE name = '$album_name'";
            $result = $conn->query($sql);
            
            return $result;
        }

        //queries for all the songs in an album in the song table using a given $album_name
        //result will contain all the songs that are in this specified album
        function searchSongsInAlbum($conn, $album_name) //done2
        {
            $sql = "SELECT * FROM album_song WHERE album_name = '$album_name'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        //queries for all the songs in a playlist in the song table using a given $playlist_name
        //result will contain all the songs that are in this specified playlist
        function searchSongsInPlaylist($conn, $playlist_name) //done2
        {
            $sql = "SELECT song_id FROM playlist_song WHERE playlist_name = '$playlist_name'";
            $result = $conn->query($sql);
            
            return $result;
        }

        //queries for all the songs in a playlist in the song table using a given $username of an artist
        //result will contain all the songs that are made by this artist
        function searchSongByArtist($conn, $username) //done2
        {
            $sql = "SELECT * FROM artist_song WHERE artist_username = '$username'";
            $result = $conn->query($sql);
            return $result;
        }

        //queries for all the songs in a playlist in the song table using a given $username of a producer
        //result will contain all the songs that are made by this producer
        function searchSongByProducer($conn, $username) //done2
        {
            $sql = "SELECT * FROM producer_song WHERE producer_username = '$username'";
            $result = $conn->query($sql);
            
            return $result;
        }

        function searchSongByName($conn, $song_name) //done2
        {
            $sql = "SELECT * FROM song WHERE name = '$song_name'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchArtistBySong($conn, $songID)
        {
            $sql = "SELECT * FROM artist_song WHERE song_id = $songID";
            $result = mysqli_query($conn, $sql);
            return $result;
        }

        //queries all playlist that matches the given $playlist_name in the playlist table
        //result contains all the information of all matching playlist
        function searchPlaylist($conn, $playlist_name) //done2
        {
            $sql = "SELECT * FROM playlist WHERE name = '$playlist_name'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchPlaylistsByUser($conn, $username){
            $sql = "SELECT * FROM playlist WHERE user_username = '$username'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }
        //queries all albums that are made by a specific artist by using the given $artistID
        //result contains all the album name taken from the matching tuples
        function searchArtistAlbum($conn, $artistID) // done2
        {
            $sql = "SELECT album_name FROM artist_album WHERE artist_id = $artistID";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        // Searches for all Ratings made under a specific song
        // result contains all ratings under a song
        function searchRatings($conn, $songID) //done2
        {
            $sql = "SELECT * FROM rating WHERE song_id = $songID";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        // Searches for a rating under a specific song made by a specific user
        // result contains all ratings made by specific user under specific song
        function searchSpecificRatings($conn, $songID, $username) //done2
        {
            $sql = "SELECT * FROM rating WHERE song_id = $songID AND user_username = '$username'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        // Searches for all Ratings made by a specific user
        // result contains all rating made by specific user
        function searchUsersRating($conn,$username){ //done2
            $sql = "SELECT * FROM rating WHERE user_username = '$username'";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }
        // creates a new Song based on the passed in info, if the album_name is not null, it also add the song to the album. Also based on the type of user, 
        //the corressponding function is also called to create a relation
        function createSong($conn, $id, $album_name, $no_of_plays, $duration, $name, $date_created, $username, $type) //done2
        {
            if($album_name == NULL)
            {
                $sql = "INSERT INTO song (id, album_name, no_of_plays, duration, name, date_created)
                        VALUES ('$id', NULL, '$no_of_plays', '$duration', '$name', '$date_created')";
            }
            else
            {
                $sql = "INSERT INTO song (id, album_name, no_of_plays, duration, name, date_created)
                        VALUES ('$id', '$album_name', '$no_of_plays', '$duration', '$name', '$date_created')";
            }
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
            if($album_name != NULL)
                addSongToAlbum($conn, $album_name, $id);
            if($type == 'artist')
                addToArtistSong($conn, $username, $id);
            if($type == 'producer')
                addToProduceSong($conn, $username, $id);
        }

        // Connects a artists and the song that they have created
        function addToArtistSong($conn, $username, $id) // done2
        {
            $sql = "INSERT INTO artist_song (artist_username, song_id)
                    VALUES('$username', '$id')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Connects a prducer and the song that they have produced
        function addToProduceSong($conn, $username, $id) //done2
        {
            $sql = "INSERT INTO producer_song (producer_username, song_id)
                    VALUES('$username', '$id')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        //creates a playlist that has a unique name within the user's playlists
        function createPlaylist($conn, $name, $user_username) //done2
        {
            $sql = "INSERT INTO playlist (user_username, name, no_of_songs, duration)
                    VALUES('$user_username', '$name', 0, 0)";
           if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
        }

        //Adds a specific song to a specific Album and calls the makeChangestoAlbum function to edit Album info based on Song info
        function addSongToAlbum($conn, $a_name, $songId) // done2
        {
            $sql = "INSERT INTO album_song (album_name, song_id) 
                    VALUES('$a_name', '$songId')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }        
            $sql = "UPDATE song SET album_name = '$a_name' WHERE id = '$songId'";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }       
            makeChangestoAlbum($conn, $a_name, $songId);
        }

        //Adds a specific song to a specific Playlist and calls the makeChangestoPlaylist function to edit Playlist info based on Song info
        function addSongToPlayList($conn, $p_name, $songId) //done2
        {

            $sql = "INSERT INTO playlist_song (playlist_name, song_id) 
                    VALUES('$p_name', '$songId')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
            makeChangestoPlaylist($conn, $p_name, $songId);
        }

        function increaseNoOfPlays($conn, $songName) //done2
        {
            $sql = "UPDATE song SET no_of_plays = no_of_plays + 1 WHERE name = '$songName' ";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
        }

        //creates a new Album and specifies the name of the album as well as the date created (no_of_songs and duration are set to 0 to begin with)
        function createAlbum($conn, $album_name, $date_created) //done2
        {
            $sql = "INSERT INTO album (name, no_of_songs, duration, date_created)
                    VALUES('$album_name', 0, 0, '$date_created')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
        }

        // Adds a new rating to a specific song that is made by a specific user
        function addRating($conn, $username, $songId, $comment, $star_rating) //done2
        {
            $sql = "INSERT INTO rating (user_username, song_id, star_rating, comment)
                    VALUES('$username', '$songId', '$star_rating', '$comment')";
            if ($conn->query($sql) === TRUE) {
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
                $sql = "UPDATE album SET duration = duration + $dur WHERE name = '$a_name' ";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
                } 
                $sql = "UPDATE album SET no_of_songs = no_of_songs + 1 WHERE name = '$a_name' ";
                if ($conn->query($sql) === TRUE) {
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
                $sql = "UPDATE playlist SET duration = duration + $dur WHERE name = '$p_name' ";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
                }  
                $sql = "UPDATE playlist SET no_of_songs = no_of_songs + 1 WHERE name = '$p_name' ";
                if ($conn->query($sql) === TRUE) {
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
            $sql = "UPDATE rating SET comment = '$comment' WHERE user_username = '$username' AND song_id = $songId";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }  
        }

        // allows a general user or an admin to edit the Star rating of a Rating made by a specific user on a specific song 
        function editStarRating($conn, $username, $songId, $star) //done2
        {
            $sql = "UPDATE rating SET star_rating = $star WHERE user_username = '$username' AND song_id = $songId";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // if the user is an admin, it lets the user delete a Song as well as all relations that song has
        function deleteSong($conn, $songID) //done2
        {

            $sql = "DELETE FROM album_song WHERE song_id = $songID";
            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "Error deleting record: " . $conn->error;
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

            $sql = "DELETE FROM rating WHERE song_id = $songID";
            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
                } else {
                echo "Error deleting record: " . $conn->error;
                }

            $sql = "DELETE FROM song WHERE id = '$songID'";

            if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
            } else {
            echo "song not found " . $conn->error;
            }
        }

        //if the user is an admin, it lets the user delete a rating made by a specific user on a specific song 
        function deleteRating($conn, $username, $songId) //done2
        {
            $sql = "DELETE FROM rating WHERE song_id = $songId AND user_username = '$username'";
            if ($conn->query($sql) === TRUE) {
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
                            $sql = "DELETE FROM playlist_song WHERE song_id = $songID AND playlist_name = '$playlist_name'";
                            if ($conn->query($sql) === TRUE) {
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
                                $sql = "UPDATE playlist SET no_of_songs = no_of_songs - 1 WHERE name = '$playlist_name'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "Record deleted successfully";
                                    } else {
                                    echo "song not found " . $conn->error;
                                    }
                                $sql = "UPDATE playlist SET duration = duration - $dur WHERE name = '$playlist_name'";
                                if ($conn->query($sql) === TRUE) {
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