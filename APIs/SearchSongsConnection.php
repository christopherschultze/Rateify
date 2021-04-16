<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $song_name = $_POST['song_name'];
    $_SESSION['searchedSongName'] = $song_name;
    $_SESSION['all_songs'] = array();
    

    if(!empty($song_name) ){
        $result = searchSongByName($conn,$song_name);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($_SESSION['all_songs'], $row);
                // echo "id: " . $row["id"].  " -album name: " . $row["album_name"]. "<br>";
            }
        }
        else
        {
            echo "song not found";
        }
    }

    header("Location: ../frontend/displaySearchSongs.php");

    closeCon($conn); 


?>