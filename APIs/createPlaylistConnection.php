<?php
    session_start();
    include 'connection.php';
    include 'logic.php';
    $conn = connect();
    // echo "<script>alert('Success!');</script>";
    $playlist_name = $_POST['playlist_name'];
    $username = $_SESSION['username'];
    // echo $username;
    // $result = searchPlaylistsByUser($conn, $username);
    // echo $result->num_rows;
    // if($result->num_rows == 0)
    // {
        createPlaylist($conn, $playlist_name, $username);
        // $_SESSION['playlist_success'] = TRUE;
        // echo "added";
    // }
    // else
    // {
        // echo "failed";
        // header("Location: ../frontend/createPlaylist.php");
        // $_SESSION['playlist_success'] = FALSE;
        // echo "failed";
    // }
    header("Location: ../frontend/createPlaylist.php");
?>