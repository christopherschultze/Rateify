<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $song_name = $_POST['song_name'];
    // echo $song_name;
    // echo "<br>";
    $artist = $_POST['artist'];
    // echo $artist;
    // echo "<br>";
    $_SESSION['all_rating_songs'] = array();
    

    if(!empty($song_name) ){
        $result = searchSongByName($conn,$song_name);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // echo $row['id'];
                // echo "<br/>";
                $result2 = searchArtistSong($conn, $artist, $row['id']);
                if($result2->num_rows > 0)
                {
                    $row2 = $result2->fetch_assoc();
                    array_push($_SESSION['all_rating_songs'], $row2);
                }
            }
        }
        else
        {
            echo "song not found";
        }
    }
    // print_r($_SESSION['all_rating_songs']);
    header("Location: ../frontend/displayRateSong.php");

    closeCon($conn); 


?>