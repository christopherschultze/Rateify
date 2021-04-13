<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_SESSION['username'];
    

    $result = searchPlaylistsByUser($conn,$username);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $playlist_names[] = $row['name'];
            }

            $_SESSION['users_playlists'] = $playlist_names[];
        }
            header("Location: ../frontend/listenerPlaylists.php")

    closeCon($conn); 


?>