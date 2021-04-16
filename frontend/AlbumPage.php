<?php
  session_start();
//   $_SESSION['selected_songs_info'];
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rateify - Artist</title>
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
    <div style = "position: absolute; top:200px; left: 20px;"class="container">
            
            <div class="col-12 mx-auto my-auto text-center">
            <div  class="col text-left">
                <a href="artist.php"> <-Return to Artist Options</a>.
              </div>
                <div style = "position: absolute; left:150px;" class="col text-center">
                    <h1>Album: <?php echo $_SESSION['selected_album']['name']?> </h1>
                    <h5>Artist: <?php echo $_SESSION['albums_artist'] ?></h5>
                    <h6>Date: <?php echo $_SESSION['selected_album']['date_created']?></h6>
                </div>
                 <!-- hyperlinks -->
             
            </div> 
            <div style = "position: absolute; top: 300px; left:150px;"class = "col text-center">
            <div  style = "top: 15px;" class="col text-left">
                <h5>Songs &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Album Duration: <?php echo $_SESSION['selected_album']['duration'] ?></h5>
                </div>
            <table style = "width: 1100px;" class="table">
                </div>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Song Name</th>
                        <th scope="col">Duration</th>
                        <th scope="col">no_of_plays</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->

                  <?php

                    if(!empty($_SESSION['album_songs']))
                    {
                        $no_of_songs = count($_SESSION['album_songs']);
                        $song_no = 0;
                        $id = 1;
                        while($no_of_songs > $song_no){
                            $name = $_SESSION['album_songs'][$song_no]['name'];
                            $sduration = $_SESSION['album_songs'][$song_no]['duration'];
                            $no_of_plays = $_SESSION['album_songs'][$song_no]['no_of_plays'];
                            
                            echo '<tr><th scope="row">'.$id.'</th><td>'.$name.'</td><td>'.$sduration.'</td><td>'.$no_of_plays.'</td></tr>';

                            $id++;
                            $song_no++;
                        }
                       
                    }
                  ?>
              </tbody>
              
            </table> 

            <?php
              echo "<br>";
              echo "<br>";
              echo "<br>";
              echo '<div><a href="../APIs/AddSongToAlbumConnection.php"> +Add Song To Album</a>.</div>';
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