<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $song_name = $_POST['song_name'];
    $_SESSION['searchedSongNameAdmin'] = $song_name;
    $_SESSION['all_songsAdmin'] = array();
    

    if(!empty($song_name) ){
        $result = searchSongByName($conn,$song_name);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($_SESSION['all_songsAdmin'], $row);
                // echo "id: " . $row["id"].  " -album name: " . $row["album_name"]. "<br>";
            }
            // $_SESSION['song_results'] = $songs;
        }
        else
        {
            $_SESSION['song_results'] = NULL;
        }
    }
    // print_r($_SESSION['all_songsAdmin']);
    header("Location: ../frontend/displaySearchSongsAdmin.php");

    closeCon($conn); 


?>