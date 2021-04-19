<?php
    include '../connection.php';
    include '../logic.php';
    $conn = connect();
    //$result = login($conn,$username,$password);a



    $method = $_GET['method'];
    switch ($method) {

        case "login":

            // variables
            $username = $_GET['username'];
            $password = $_GET['password'];

            // method call
            $result = login($conn,$username,$password);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "signup":

            // variables
            $username = $_GET['username'];
            $password = $_GET['password'];
            $account_type = $_GET['account_type'];

            // method call
            $notify = signup($conn,$username,$password,$account_type);
                
            // display for postman
            if ($notify == 1)
                echo "\nAccount table updated";
            else 
                echo "failed";

            break;

        case "getMaxID":

            // variables

            // method call
            $result = getMaxID($conn);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "getMaxSongID":
            
            // variables

            // method call
            $result = getMaxSongID($conn);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchSong":

            // variables
            $song_id = $_GET['song_id'];

            // method call
            $result = searchSong($conn, $song_id);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;


        case "searchArtistSong":
            // variables
            $username = $_GET['username'];
            $song_id = $_GET['song_id'];

            // method call
            $result = searchArtistSong($conn, $username, $song_id);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchAlbum":

            // variables
            $album_name = $_GET['album_name'];

            // method call
            $result = searchAlbum($conn, $album_name);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            break;

            

        case "searchSongsInAlbum":
            // variables
            $album_name = $_GET['album_name'];

            // method call
            $result = searchSongsInAlbum($conn, $album_name);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            break;


        case "searchAlbumBySong":
            // variables
            $song_id = $_GET['song_id'];

            // method call
            $result = searchAlbumBySong($conn, $song_id);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            break;
        
        case "searchSongsInPlaylist":
            // variables
            $playlist_name = $_GET['playlist_name'];

            // method call
            $result = searchSongsInPlaylist($conn, $playlist_name);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            break;
        
        case "searchSongByArtist":
            // variables
            $username = $_GET['username'];

            // method call
            $result = searchSongByArtist($conn, $username);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            break;

        case "searchSongByProducer":
            // variables
            $username = $_GET['username'];

            // method call
            $result = searchSongByProducer($conn, $username);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            break;


        case "searchSongByName":

            // variables
            $song_name = $_GET['song_name'];

            // method call
            $result = searchSongByName($conn, $song_name);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchArtistBySong":
            // variables
            $song_id = $_GET['song_id'];

            // method call
            $result = searchArtistBySong($conn, $song_id);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;
        
        case "searchPlaylist":
            // variables
            $playlist_name = $_GET['playlist_name'];

            // method call
            $result = searchPlaylist($conn, $playlist_name);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchPlaylistsByUser":
            // variables
            $username = $_GET['username'];

            // method call
            $result = searchPlaylistsByUser($conn, $username);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchArtistAlbum":
            // variables
            $username = $_GET['username'];

            // method call
            $result = searchArtistAlbum($conn, $username);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchAlbumArtist":
            // variables
            $username = $_GET['username'];
            $album_name = $_GET['album_name'];

            // method call
            $result = searchAlbumArtist($conn, $username, $album_name);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchRatings":
            //variables
            $song_id = $_GET['song_id'];

            // method call
            $result = searchRatings($conn, $song_id);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchSpecificRatings":
            //variables
            $song_id = $_GET['song_id'];
            $username = $_GET['username'];

            // method call
            $result = searchSpecificRatings($conn, $song_id, $username);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);

            break;

        case "searchUsersRating":
            //variables
            $username = $_GET['username'];

            // method call
            $result = searchUsersRating($conn, $username);

            // display for postman
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            break;

        case "deleteSong":

            // variables
            $song_id = $_GET['song_id'];

            // method call
            $notify = deleteSong($conn, $song_id);

            // display for postman
            if ($notify == 1)
                echo "song deleted";
            else
                echo "failed to delete song";

            break;

        case "removeSongFromPlaylist":

            //variables
            $playlist_name = $_GET['playlist_name'];
            $songID = $_GET['song_id'];
            $username = $_GET['username'];
        
            //method call
            removeSongFromPlaylist($conn, $playlist_name, $songID, $username);
            //display for postman
            //echo "remove song from playlist successfully";
            break;
        
        case "deleteRating":
            //variables
            $username = $_GET['username'];
            $songID = $_GET['song_id'];
        
            //method call
            $notify = DeleteRating($conn, $username, $songID);
            
            //display for postman
            if($notify == 1)
                echo "successfully";
            if($notify == 2)
                echo "failed";
            break;
        
        case "makeChangestoPlaylist":
            //variables
            $p_name = $_GET['playlist_name'];
            $songID = $_GET['song_id'];
                //method call 
            makeChangestoPlaylist($conn, $p_name, $songID);
            //display for postman
            echo "make changes to playlist successfully";
            break;
        
        case "makeChangestoAlbum":
            //variables
            $a_name = $_GET['album_name'];
            $songID = $_GET['song_id'];
        
            //method call
            makeChangestoAlbum($conn, $a_name, $songID);
        
            //display for postman
            echo "make changes to album successfully";
            break;
        
        case "addRating":
            //variables
            $username = $_GET['username'];
            $songID = $_GET['song_id'];
            $comment = $_GET['comment'];
            $star = $_GET['star'];
        
            //method call
            addRating($conn, $username, $songID, $comment, $star);
        
            //displat for postman
            echo "rating added successfully";
            break;
        
        case "createAlbum":
            //variables
            $album_name = $_GET['album_name'];
            $date_created = $_GET['date_created'];
            $username = $_GET['username'];
        
            //method call_user_func
            $notify = createAlbum($conn, $album_name, $date_created, $username);
        
            //display for postman
            if($notify == 1)
                echo "Successful";
            else
                echo "failed";
            break;
        
        case "increaseNoOfPlays":
            //variables
            $songID = $_GET['song_id'];
        
            //method call
            increaseNoOfPlays($conn, $songID);
        
            //display for postman
            //echo "Successful";
            break;
        
        case "addSongToPlayList":
            //variables
            $p_name = $_GET['playlist_name'];
            $songID = $_GET['song_id'];
        
            //method call
            addSongToPlayList($conn, $p_name, $songID);
        
            //display for postman
            echo "Successful";
            break;
        
        case "addSongToAlbum":
            //variables
            $a_name = $_GET['album_name'];
            $songID = $_GET['song_id'];
        
            //method call
            addSongToAlbum($conn, $a_name, $songID);
        
            //display for postman
            echo "Successful";
            break;
        
        case "createPlaylist":
            //variables
            $p_name = $_GET['playlist_name'];
            $username = $_GET['username'];
        
            //method call
            createPlaylist($conn, $p_name, $username);
        
            //display for postman
            echo "Successful";
            break;
        
        case "addToProduceSong":
            //var
            $username = $_GET['username'];
            $songID = $_GET['song_id'];
        
            //method call
            addToProduceSong($conn, $username, $songID);
        
            //display for postman
            echo "Successful";
            break;
        
        case "addToArtistSong":
            $username = $_GET['username'];
            $songID = $_GET['song_id'];
        
            //method call
            addToArtistSong($conn, $username, $songID);
        
            //display for postman
            echo "Successful";
            break;
        
        case "createSong":
            $songID = $_GET['song_id'];
            $a_name = $_GET['album_name'];
            $no_of_plays = $_GET['no_of_plays'];
            $duration = $_GET['duration'];
            $name = $_GET['song_name'];
            $date = $_GET['date_created'];
            $username = $_GET['username'];
            $type = $_GET['type'];
        
            //method calls
            createSong($conn, $songID, $a_name, $no_of_plays, $duration, $name, $date, $username, $type);
        
            //display to postman
            echo "Successful";
            break;

        case "decreaseDurationToAlbum":

            $song_id = $_GET['song_id'];
            $a_name = $_GET['album_name'];
            
            decreaseDurationToAlbum($conn, $song_id, $a_name);

            break;


            
    }




    
?>