<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    // echo "Connected Succesfully\n";
    createSong($conn);
    // deleteSong($conn, 0);
    // $result = searchSong($conn, 0);
    // header("Content-type: JSON");
    // $output = array();
    // $row = mysqli_fetch_array($result);
    // $output[0]['id'] = $row['id'];
    // $output[0]['album_name'] = $row['album_name'];
    // $output[0]['no_of_plays'] = $row['no_of_plays'];
    // $output[0]['duration'] = $row['duration'];
    // $output[0]['name'] = $row['name'];
    // $output[0]['date_created'] = $row['date_created'];

    // echo json_encode($output, JSON_PRETTY_PRINT);
    // closeCon($conn);
?>