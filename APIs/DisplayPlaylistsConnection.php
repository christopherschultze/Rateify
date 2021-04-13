<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $username = $_SESSION['username'];
    

    $result = searchPlaylistsByUser($conn,$username);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "name: " . $row["name"].  " -user: " . $row["user_username"]. "<br>";
            }
        }
    }

    closeCon($conn); 


?>