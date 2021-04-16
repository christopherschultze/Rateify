<?php
  session_start();
  $_SESSION['random'] = array();
  $_SESSION['temp'] = 0;
  // $_SESSION["curr_playlist"];
  // $_SESSION['songs_info'] = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rateify - Listener Playlists</title>
    <meta name="description"
          content="Rateify is a music service that allows users to rate songs"/>

    <!--Inter UI font-->
    <link href="https://rsms.me/inter/inter-ui.css" rel="stylesheet">

    <!--vendors styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <!-- Bootstrap CSS / Color Scheme -->
    <link rel="stylesheet" href="css/default.css" id="theme-color">
</head>
<body>

<!--navigation-->
<section class="smart-scroll">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand heading-black" href="index.php">
                Rateify
            </a>
            <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span data-feather="grid"></span>
            </button>
            
        </nav>
    </div>
</section>

<!--signup functionality-->
<section class="py-7 py-md-0 bg-hero" id="login">
    <div class="container">
        <div class="row vh-md-100">
            <div class="col-md-8 col-sm-10 col-12 mx-auto my-auto text-center">
                
              <!-- header -->
              <div class="col text-center">
                <h1> Hello <?php echo $_SESSION['username'] ?></h1>
              </div>

              <!-- header -->
              <div class="col text-center">
                <h2> Please select a playlist option. </h2>
              </div>
              
              <!-- hyperlinks -->
              <div class="col text-center">
                <a href="listener.php"> Return to action page</a>.
              </div>

              <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="createPlaylist.php" class="btn btn-primary" role="button" aria-pressed="true">
                  Create a playlist
                </a>
              </div>
              <div class="col-md-8 col-12 mx-auto pt-5 text-center">

              <form action="../APIs/UpdatePlaylistDisplayConnection.php" method="post">
                  <?php
                  if(!empty($_SESSION['users_playlists']))
                  {
                    $no_of_playlists = count($_SESSION['users_playlists']);

                    $playlist_no = 0;

                    while($no_of_playlists > $playlist_no){
                      $temp = $_SESSION["users_playlists"][$playlist_no];
                      echo '<input type = "submit" name = "clicked['.$playlist_no.']" class="btn btn-primary" role="button" aria-pressed="true" value = "'.$temp.'" />';
                      $playlist_no++;
                      echo "<br/>";
                      echo "<br/>";
                    } 
                  }else
                  {
                    echo "YOU CURRENTLY HAVE NO PLAYLISTS!";
                  }
   
                  ?>
                </form>
            </div>
            <div class=" mx-auto pt-5 text-center">
                <h3> <?php if(!empty($_SESSION['users_playlists'])){echo $_SESSION['users_playlists'][$_SESSION['curr_playlist']];} ?></h3>
                <table style = "width: 850px;" class="table">
                    <thead>
                    <tr>
                        <th scope="col">REMOVE SONG</th>
                        <th scope="col">#</th>
                        <th scope="col">Song</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Album</th>
                        <th scope="col">Duration</th>
                        <th scope="col">No_of_Plays</th>
                        <th scope="col">PLAY SONG</th>
                    </tr>
                    </thead>
                    <tbody>
                    <form action="../APIs/UpdatePlaysConnection.php" method="post">
                    <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    if(!empty($_SESSION['songs_info']))
                    {
                      $conn = connect();
                      $no_of_songs = count($_SESSION['songs_info']);
                      $song_no = 0;
                      $id = 1;
                      while($no_of_songs > $song_no){
                        $artists = array();
                        $song_id = $_SESSION['songs_info'][$song_no]['id'];
                        $song_name = $_SESSION['songs_info'][$song_no]['name'];
                        $album_name = $_SESSION['songs_info'][$song_no]['album_name'];
                        $duration = $_SESSION['songs_info'][$song_no]['duration'];
                        $no_of_plays = $_SESSION['songs_info'][$song_no]['no_of_plays'];
                        $artist = searchArtistBySong($conn, $song_id);
                        if($artist->num_rows > 0)
                        {
                          while($row3 = $artist->fetch_assoc()) {
                            array_push($artists, $row3['artist_username']);
            
                          }
                          
                        }
                       
                        $iteration = 0;
              
                        foreach($artists as $a)
                        {
                          if($iteration == 0)
                          {
                            echo '<tr><th scope="row"><input type = "submit" name = "removing['.$song_id.']" class="btn btn-primary" role="button" aria-pressed="true" value = "REMOVE" formaction="../APIs/RemoveFromPlaylistConnection.php" /></th><th scope="row">'.$id.'</th><td>'.$song_name.'</td><td>'.$a.'</td><td>'.$album_name.'</td><td>'.$duration.'</td><td>'.$no_of_plays.'</td>  <td> <div style="position: relative;"><button name = "song_played['.$song_id.']" style="background-color: rgb(0, 0, 0); border: black;" type = "submit"><img src="Images/Play-Button-PNG-Image.png" width="auto" height="41" /></button></div></td></tr>';
                          }
                          else
                          {
                            echo '<tr><th></th><td></td><td>'.$a.'</td><td></td><td></td><td></td></tr>';
                          }
                          $iteration++;
                        }
                        
                     
                        $song_no++;
                        $id++;
                        reset($artists);
                      }
                    }
                    ?>
                    </form>
                    </tbody>
                </table>
            </div>
            <?php
              echo "<br>";
              echo "<br>";
              echo "<br>";
              echo '<div><a href="SearchSongToAdd.php"> +Add Song To Playlist</a>.</div>';
              echo "<br>";
              echo "<br>";
            ?>
        </div>
       
    </div>
</section>

<!--scroll to top-->
<div class="scroll-top">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.3/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>