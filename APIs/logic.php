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

        function searchRatings($conn, $songID)
        {
            $sql = "SELECT * FROM spotify.rating WHERE song_id = $songID";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

        function searchSpecificRatings($conn, $songID, $username)
        {
            $sql = "SELECT * FROM spotify.rating WHERE song_id = $songID AND user_username = $username";
            $result = mysqli_query($conn, $sql);
            
            return $result;
        }

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

        function addToArtistSong($conn, $username, $id)
        {
            $sql = "INSERT INTO spotify.artist_song(artist_username, song_id)
                    VALUES($username, $id)";
            print "Insert completed.";
        }

        function addToProduceSong($conn, $username, $id)
        {
            $sql = "INSERT INTO spotify.producer_song(producer_username, song_id)
                    VALUES($username, $id)";
            print "Insert completed.";
        }

        function createPlaylist($conn, $name, $user_username) //done
        {
            $sql = "INSERT INTO spotify.playlist (user_username, name, no_of_songs, duration)
                    VALUES($user_username, $name, 0, 0)";
            print "Insert completed.";
        }

        function addSongToAlbum($conn, $a_name, $songId) // done
        {
            $sql = "INSERT INTO spotify.album_song (album_name, song_id) 
                    VALUES($a_name, $songId)";
            $sql = "UPDATE spotify.song SET album_name = $a_name WHERE song_id = $songId";
            makeChangestoAlbum($conn, $a_name, $songId);
            print "Insert completed.";
        }

        function addSongToPlayList($conn, $p_name, $songId) //done
        {

            $sql = "INSERT INTO spotify.playlist_song (playlist_name, song_id) 
                    VALUES($p_name, $songID)";
            makeChangestoPlaylist($conn, $p_name, $songId);
            print "Insert completed.";
        }

        function createAlbum($conn, $album_name, $date_created) //done
        {
            $sql = "INSERT INTO spotify.album (name, no_of_songs, duration, date_created)
                    VALUES($album_name, 0, 0, $date_created)";
            print "Insert completed.";
        }

        function addRating($conn, $username, $songId, $comment, $star_rating)
        {
            $sql = "INSERT INTO spotify.rating (user_username, song_id, star_rating, comment)
                    VALUES($username, $songId, $star_rating, $comment)";
            print "Insert completed.";
        }

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

        function editComment($conn, $username, $songId, $comment)
        {
            $sql = "UPDATE spotify.rating SET comment = $comment WHERE user_username = $username AND song_id = $songId";
        }

        function editStarRating($conn, $username, $songId, $star)
        {
            $sql = "UPDATE spotify.rating SET star_rating = $star WHERE user_username = $username AND song_id = $songId";
        }

        function deleteSong($conn, $songID)
        {
            $sql = "DELETE FROM spotify.song WHERE song_id = $songID";
            $sql = "DELETE FROM spotify.album_song WHERE songId = $songID";
            $sql = "DELETE FROM spotify.playlist_song WHERE song_id = $songID";
            print "Delete completed";
        }

        function deleteRating($conn, $username, $songId)
        {
            $sql = "DELETE FROM spotify.rating WHERE song_id = $songId AND user_username = $username";
            print "Delete completed";
        }
?>