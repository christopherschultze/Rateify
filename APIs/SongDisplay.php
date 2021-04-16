<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    
    $conn = connect();
    $_SESSION['song'] = key($_POST['song_id']);
    $_SESSION['songs_artist'] = $_SESSION['username'];

    $result = searchSong($conn,$_SESSION['song']);
    $result2 = searchRatings($conn,$_SESSION['song']);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $song_info = $row;
        }

        $_SESSION['selected_songs_info'] = $song_info;
      } 
      else{
          $_SESSION['selected_songs_info'] = NULL;
      }

    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $rating_info[] = $row2;
     }

        $_SESSION['song_rating'] = $rating_info;
      } 
      else{
          $_SESSION['song_rating'] = NULL;
      }

    header("Location: ../frontend/SongPage.php");

    closeCon($conn); 

    

?>