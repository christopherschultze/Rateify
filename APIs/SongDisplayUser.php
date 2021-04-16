<?php
    session_start();
    include 'connection.php';
    include 'logic.php';    
    $conn = connect();
    $_SESSION['song'] = key($_POST['song_id_no']);
    $artist = searchArtistBySong($conn,$_SESSION['song']);
    $temp = searchSong($conn,$_SESSION['song']);
    if ($temp->num_rows > 0) {
        while($r = $temp->fetch_assoc()) {
            $song_name = $r['name'];
        }
        $_SESSION['song_choosing'] = $song_name;
    }
    if ($artist->num_rows > 0) {
        while($rows = $artist->fetch_assoc()) {
            $artist_name = $rows['artist_username'];
        }
    $_SESSION['songs_artist'] = $artist_name;
    }
    
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
     
    header("Location: ../frontend/SongPageUser.php");

    closeCon($conn); 

    

?>