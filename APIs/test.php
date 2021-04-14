<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    // createPlaylist($conn, 'playlist1', 'user1');
    // $result = searchSongsInAlbum($conn, 'album1');
    // addRating($conn, 'user1', 1, 'this shit is lit', 500);
    $result = searchPlaylistsByUser($conn, 'user1');

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
         echo $row['playlist_name'];
         echo $row['user_username'];
        }
    } else {
       echo "0 results";
    }
  
    closeCon($conn);
?>