<?php
        function login($conn, $username, $pwd) // done
        {
            $sql = "SELECT * FROM spotify.account WHERE username = $username AND password = $pwd";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchAccount($conn, $username)
        {
            $sql = "SELECT * FROM spotify.account WHERE username = $username";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchSong($conn, $songId) // done
        {
            $sql = "SELECT * FROM spotify.song WHERE song_id = $songID";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchAlbum($conn, $album_name)//done
        {
            $sql = "SELECT * FROM spotify.album WHERE name = $album_name";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchSongsInAlbum($conn, $album_name) //done
        {
            $sql = "SELECT * FROM spotify.song WHERE album_name = $album_name";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchSongsInPlaylist($conn, $playlist_name) //done
        {
            $sql = "SELECT * FROM spotify.playlist_song WHERE playlist_name = $playlist_name";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchSongByArtist($conn, $username)
        {
            $sql = "SELECT * FROM spotify.aritst_song WHERE artist_username = $username";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchSongByProducer($conn, $username)
        {
            $sql = "SELECT * FROM spotify.producer_song WHERE producer_username = $username";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchPlaylist($conn, $username, $playlist_name)
        {
            $sql = "SELECT * FROM spotify.playlist WHERE user_username = $username AND name = $playlist_name";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchArtistAlbum($conn, $artistID) // done
        {
            $sql = "SELECT album_name FROM spotify.artist_album WHERE artist_id = $artistID";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        // Searches for all Ratings made under a specific song
        // result contains all ratings under a song
        function searchRatings($conn, $songID)
        {
            $sql = "SELECT * FROM spotify.rating WHERE song_id = $songID";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        // Searches for a rating under a specific song made by a specific user
        // result contains all ratings made by specific user under specific song
        function searchSpecificRatings($conn, $songID, $username)
        {
            $sql = "SELECT * FROM spotify.rating WHERE song_id = $songID AND user_username = $username";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        // Searches for all Ratings made by a specific user
        // result contains all rating made by specific user
        function searchUsersRating($conn,$username){
            $sql = "SELECT * FROM spotify.rating WHERE user_username = $username";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }
        // creates a new Song based on the passed in info, if the album_name is not null, it also add the song to the album. Also based on the type of user, 
        //the corressponding function is also called to create a relation
        function createSong($conn, $id, $album_name, $duration, $name, $date_created, $username, $type) //done
        {
            $sql = "INSERT INTO spotify.song (song_id, album_name, no_of_plays, duration, name, date_created)
                    VALUES($id, $album_name, 0, $duration, $name, $date_created)";
            if($album_name != NULL)
                addSongToAlbum($conn, $album_name, $id);
            if($type == 'Artist')
                addToArtistSong($conn, $username, $id);
            if($type == 'Producer')
                addToProduceSong($conn, $username, $id);
            print "Insert completed.";
        }

        // Connects a artists and the song that they have created
        function addToArtistSong($conn, $username, $id)
        {
            $sql = "INSERT INTO spotify.artist_song(artist_username, song_id)
                    VALUES($username, $id)";
            print "Insert completed.";
        }

        // Connects a prducer and the song that they have produced
        function addToProduceSong($conn, $username, $id)
        {
            $sql = "INSERT INTO spotify.producer_song(producer_username, song_id)
                    VALUES($username, $id)";
            print "Insert completed.";
        }

        //creates a playlist that has a unique name within the user's playlists
        function createPlaylist($conn, $name, $user_username) //done
        {
            $sql = "INSERT INTO spotify.playlist (user_username, name, no_of_songs, duration)
                    VALUES($user_username, $name, 0, 0)";
            print "Insert completed.";
        }

        //Adds a specific song to a specific Album and calls the makeChangestoAlbum function to edit Album info based on Song info
        function addSongToAlbum($conn, $a_name, $songId) // done
        {
            $sql = "INSERT INTO spotify.album_song (album_name, song_id) 
                    VALUES($a_name, $songId)";
            $sql = "UPDATE spotify.song SET album_name = $a_name WHERE song_id = $songId";
            makeChangestoAlbum($conn, $a_name, $songId);
            print "Insert completed.";
        }

        //Adds a specific song to a specific Playlist and calls the makeChangestoPlaylist function to edit Playlist info based on Song info
        function addSongToPlayList($conn, $p_name, $songId) //done
        {

            $sql = "INSERT INTO spotify.playlist_song (playlist_name, song_id) 
                    VALUES($p_name, $songID)";
            makeChangestoPlaylist($conn, $p_name, $songId);
            print "Insert completed.";
        }

        //creates a new Album and specifies the name of the album as well as the date created (no_of_songs and duration are set to 0 to begin with)
        function createAlbum($conn, $album_name, $date_created) //done
        {
            $sql = "INSERT INTO spotify.album (name, no_of_songs, duration, date_created)
                    VALUES($album_name, 0, 0, $date_created)";
            print "Insert completed.";
        }

        // Adds a new rating to a specific song that is made by a specific user
        function addRating($conn, $username, $songId, $comment, $star_rating)
        {
            $sql = "INSERT INTO spotify.rating (user_username, song_id, star_rating, comment)
                    VALUES($username, $songId, $star_rating, $comment)";
            print "Insert completed.";
        }

        // function that is called whenever a new song is added to a Album which edits the no_of_songs and duration of the playlist
        function makeChangestoAlbum($conn, $a_name, $songId) // done
        {
            $result = searchSong($conn, $songId);
            $dur = 0;
            $row = mysql_fetch_array($result);
            $dur = $row['duration'];
            $sql = "UPDATE spotify.album SET duration = duration + $dur WHERE name = $a_name ";
            $sql = "UPDATE spotify.album SET no_of_songs = no_of_songs + 1 WHERE name = $a_name ";
            print "UPDATE completed.";
        }

        // function that is called whenever a new song is added to a playlist which edits the no_of_songs and duration of the playlist
        function makeChangestoPlaylist($conn, $p_name, $songId) // done
        {
            $result = searchSong($conn, $songId);
            $dur = 0;
            $row = mysql_fetch_array($result);
            $dur = $row['duration'];
            $sql = "UPDATE spotify.playlist SET duration = duration + $dur WHERE name = $p_name ";
            $sql = "UPDATE spotify.playlist SET no_of_songs = no_of_songs + 1 WHERE name = $p_name ";
            print "UPDATE completed.";
        }

        // allows a general user or an admin to edit the comment of a Rating made by a specific user on a specific song 
        function editComment($conn, $username, $songId, $comment)
        {
            $sql = "UPDATE spotify.rating SET comment = $comment WHERE user_username = $username AND song_id = $songId";
        }

        // allows a general user or an admin to edit the Star rating of a Rating made by a specific user on a specific song 
        function editStarRating($conn, $username, $songId, $star)
        {
            $sql = "UPDATE spotify.rating SET star_rating = $star WHERE user_username = $username AND song_id = $songId";
        }

        // if the user is an admin, it lets the user delete a Song as well as all relations that song has
        function deleteSong($conn, $songID)
        {
            $sql = "DELETE FROM spotify.song WHERE song_id = $songID";
            $sql = "DELETE FROM spotify.album_song WHERE songId = $songID";
            $sql = "DELETE FROM spotify.playlist_song WHERE song_id = $songID";
            print "Delete completed";
        }

        //if the user is an admin, it lets the user delete a rating made by a specific user on a specific song 
        function deleteRating($conn, $username, $songId)
        {
            $sql = "DELETE FROM spotify.rating WHERE song_id = $songId AND user_username = $username";
            print "Delete completed";
        }
?>