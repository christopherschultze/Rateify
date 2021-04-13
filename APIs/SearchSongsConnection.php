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
                echo "id: " . $row["id"].  " -album name: " . $row["album_name"]. "<br>";
            }
        }
        else
        {
            echo "song not found";
        }
    }

    closeCon($conn); 


?>