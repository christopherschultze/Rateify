<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    // createPlaylist($conn, 'playlist1', 'user1');
    // $result = searchSongsInAlbum($conn, 'album1');
    // addRating($conn, 'user1', 1, 'this shit is lit', 500);
    increaseNoOfPlays($conn, 'SICKO MODE');
    // header("Content-type: JSON");
    // $output = array();
    // $row_number = 0;
    // // while($row = mysqli_fetch_array($result))
    // $row = mysqli_fetch_array($result)
    // // {
    // $output[$row_number]['id'] = $row['id'];
    //     // $row_number++;
    // // }

    // echo json_encode($output, JSON_PRETTY_PRINT);
    closeCon($conn);
?>