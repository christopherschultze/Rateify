<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
    $result = searchArtistAlbum($conn,'artist');
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          echo $row['album_name'];
        }
      } else {
        echo "0 results";
      }
      
    closeCon($conn);
?>