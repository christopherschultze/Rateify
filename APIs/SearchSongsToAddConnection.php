<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $song_name = $_POST['song_name'];
    

    if(!empty($song_name) ){
        $result = searchSongByName($conn,$song_name);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               
                $songs[] = $row;
            }
            $_SESSION['song_results'] = $songs;
        }
        else
        {
            $_SESSION['song_results'] = NULL;
        }
    }

    header("Location: ../frontend/DisplaySongToAddResults.php");

    closeCon($conn); 


?>