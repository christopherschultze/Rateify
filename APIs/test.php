<?php
    include 'connection.php';
    include 'logic.php';
    
    $conn = connect();
   deleteSong($conn, 12);
    // echo $_POST['formGender'];
    // echo "<br>";
    // echo $_POST['comment'];
    // if(isset($_POST['formSubmit']) )
    // {
    //   echo $_POST['formMovie'];
    //   // $varName = $_POST['formName'];
    //   // $varGender = $_POST['formGender'];
    //   // $errorMessage = "";

    //   // - - - snip - - - 
    // }
    // if (isset($_POST['submit'])){
    //   echo "sefgmesiofesmif";
    //   echo $_POST['Subject']; 
    //   }
    // createPlaylist($conn, 'playlist1', 'user1');
    // $result = searchSongsInAlbum($conn, 'album1');
    // addRating($conn, 'user1', 1, 'this shit is lit', 500);

    // $result = searchSongByName($conn, 'Runaway');
   // $result = searchArtistAlbum($conn, 'artist1');

    // $result = searchSongByName($conn, 'SICKO MODE');
    // $ids = array();
    // $artists = array();
    // $album_names = array();
    // if ($result->num_rows > 0) {
    //   // output data of each row
    //   while($row = $result->fetch_assoc()) {
    //     echo $row['artist_username'];
    //   }
    // }
    //       array_push($ids, $row['id']);
    //       array_push($album_names, $row['album_name']);
    //     }
    //   } else {
    //     echo "0 results";
    //   }
    //   foreach($ids as &$id)
    //   {
    //     $artist = searchArtistBySong($conn, $id);
    //     echo "for song id: " .$id. "<br>";
    //     echo "Artists are: "; 
    //     if($artist -> num_rows > 0)
    //       {
    //         while($row2 = $artist->fetch_assoc())
    //         {
    //             echo $row2['artist_username'];
    //             // array_push($artists, $row2['artist_username']);
    //         }
    //         echo "<br>";
    //       }
    //   }
            // print_r($ids);
      // echo "Info for SICKO MODE: ";
      // echo "<br>";
      // echo "album name: ";
      // foreach($album_names as &$album)
      // {
      //   echo $album;
      //   echo " ";
      // }
      // echo "<br>";
      // echo "artist name: ";
      // foreach($artists as &$artist)
      // {
      //   echo $artist;
      //   echo " ";
      // }
    // echo $result;
    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "song id: " . $row["id"]. "<br>";
    //     }
    //   } else {
    //     echo "0 results";
    //   }
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