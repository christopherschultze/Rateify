<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    

    $conn = connect();
    $_SESSION['curr_playlist'] = key($_POST['clicked']);
    
    header("Location: ../frontend/listenerPlaylists.php");

    closeCon($conn); 


?>