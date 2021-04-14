<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    
    $conn = connect();
    $temp = $_SESSION['temp'];
    $_SESSION['song_playing'] = $_POST[$temp];
    $_SESSION['temp']++;
    echo $_SESSION['temp'];
    
    // echo $_SESSION['random'];
    //   echo $_SESSION['songs_info'][0]['name'];

    // header("Location: ../frontend/listenerPlaylists.php");
    function hello($message)
    {
        echo $message;
    }

    closeCon($conn); 

    

?>