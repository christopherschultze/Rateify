<?php
  session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rateify - Search Songs</title>
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

<!-- listener functionality -->
<section class="py-7 py-md-0 bg-hero" id="login">
    <div class="container">
        <div class="row vh-md-100">
            <div class="col-12 mx-auto my-auto text-center">
              
              <div class="col text-center">
              <h1> Search Results for <?php echo $_SESSION['searchedSongName'];?> </h1>
              </div>

              <!-- hyperlinks -->
              <div class="col text-center">
                <a href="listener.php"> <- Return to user page</a>.
              </div>

              <table class="table">
              <div  style = "top: 15px;" class="col text-center">
                <h6>*Click on Song Name For Details*</h6>
                </div>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Album</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Duration</th>
                        <th scope="col">No. of plays</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->
              <form action="../APIs/SongDisplayUser.php" method="post">
                  <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    $conn = connect();
                    if(sizeof($_SESSION['all_songs']) != 0)
                    {
                        $no_of_songs = count($_SESSION['all_songs']);
                        $song_no = 0;
                        $id = 1;
                        while($no_of_songs > $song_no){
                            $artists = array();
                            $albums = array();
                            $album_names = searchAlbumBySong($conn, $_SESSION['all_songs'][$song_no]['id']);
                            $artist_names = searchArtistBySong($conn, $_SESSION['all_songs'][$song_no]['id']);
                            if($album_names->num_rows > 0)
                            {
                                while($row2 = $album_names->fetch_assoc())
                                    array_push($albums, $row2['album_name']);
                            }
                            if($artist_names->num_rows > 0)
                            {
                                while($row3 = $artist_names->fetch_assoc())
                                {
                                    array_push($artists, $row3['artist_username']);
                                }
                                    
                                
                               
                            }

                            $duration = $_SESSION['all_songs'][$song_no]['duration'];
                            $no_of_plays = $_SESSION['all_songs'][$song_no]['no_of_plays'];
                            // $album_name = $_SESSION['all_songs'][$song_no]['album_name'];
                            $iteration = 0;
                            $smaller = 0;
                            $difference = 0;
                            if(sizeof($artists) > sizeof($albums))
                            {
                                $smaller = sizeof($albums);
                                $difference = sizeof($artists) - sizeof($albums);
                            }
                            else
                            {
                                $smaller = sizeof($artists);
                                $difference = sizeof($albums) - sizeof($artists);
                            }
                            if(!empty($albums) && !empty($artists))
                            {
                                while($iteration < $smaller)
                                {
                                    $song_name = $_SESSION['all_songs'][$song_no]['name'];
                                    $song_id = $_SESSION['all_songs'][$song_no]['id'];
                                    if($iteration == 0)
                                    {
                                        echo '<tr><th scope="row">'.$id.'</th><td><input name = "song_id_no['.$song_id.']" type = "submit" style="border:1px solid black; background-color: transparent; color: white; role="button" aria-pressed="true" value = "'.$song_name.'"></td><td>'.$albums[$iteration].'</td><td>'.$artists[$iteration].'</td><td>'.$duration.'</td><td>'.$no_of_plays.'</td></tr>';
                                    }
                                    else
                                    {
                                        echo '<tr><th scope="row"></th><td></td><td>'.$albums[$iteration].'</td><td>'.$artists[$iteration].'</td><td></td><td></td></tr>';
                                    }
                                    $iteration++;
                                }
                                if(sizeof($artists) > sizeof($albums))
                                {
                                    while($iteration < sizeof($artists))
                                    {
                                        echo '<tr><th scope="row"></th><td></td><td></td><td>'.$artists[$iteration].'</td><td></td><td></td></tr>';
                                        $iteration++;
                                    }
                                }
                                else
                                {
                                    while($iteration < sizeof($albums))
                                    {
                                        echo '<tr><th scope="row"></th><td></td><td>'.$albums[$iteration].'</td><td></td><td></td><td></td></tr>';
                                        $iteration++;
                                    }
                                }
                                
                            }
                            else if(empty($albums) && !empty($artists))
                            {
                                foreach($artists as $artist)
                                {
                                    if($iteration == 0)
                                        echo '<tr><th scope="row">'.$id.'</th><td>'.$_SESSION['all_songs'][$song_no]['name'].'</td><td></td><td>'.$artist.'</td><td>'.$duration.'</td><td>'.$no_of_plays.'</td></tr>';
                                    else
                                        echo '<tr><th scope="row"></th><td></td><td></td><td>'.$artist.'</td><td></td><td></td></tr>';
                                    $iteration++;
                                }
                            }
                            else if(!empty($albums) && empty($artists))
                            {
                                foreach($albums as $album)
                                {
                                    if($iteration == 0)
                                        echo '<tr><th scope="row">'.$id.'</th><td>'.$_SESSION['all_songs'][$song_no]['name'].'</td><td>'.$album.'</td><td></td><td>'.$duration.'</td><td>'.$no_of_plays.'</td></tr>';
                                    else
                                        echo '<tr><th scope="row"></th><td></td><td></td>'.$album.'<td></td><td></td><td></td></tr>';
                                    $iteration++;
                                }
                            }
                            else
                                echo '<tr><th scope="row">'.$id.'</th><td></td><td></td><td></td><td>'.$duration.'</td><td>'.$no_of_plays.'</td></tr>';
                            
                            

                            $id++;
                            $song_no++;
                        }
                       
                    }
                    else
                    {
                        echo '<h3> No results </h3>';
                    }
                  ?> 
                  </form>
              </tbody>
            </table>
            </div>
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