<?php
  session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rateify - Listener Page</title>
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


<!--Search Song-->
<section class="py-7 py-md-0 bg-hero" id="login">
    <div class="container">
    <div class="col-md-8 col-sm-10 col-12 mx-auto my-auto text-center">
        
        <form action="../APIs/SearchSongsConnection.php" method="post">
        <div style="position: absolute; top: 75px; width:700px;"class="form-group">
            <input name = "song_name" type="search" class="form-control" id="SongName" aria-describedby="SearchSongHelp" placeholder="Enter Song Name">
            <div style= "position: absolute; right: 0px; top: 0px;">  
                <button style="background-color: white; border: white;"type = "submit"><img src="Images/magnifying glass.png" width="auto" height="42" /></button>
            </div>
        </div>          
        </form>
    </div>
    <div style="position: absolute; top:200px;">
                <table style = "width: 1150px;" class="table">
                    <thead>
                    <tr>
                        <th style = "width: 100px;"scope="col">#</th>
                        <th style = "width: 192px;" scope="col">Song</th>
                        <th style = "width: 192px;" scope="col">Artist</th>
                        <th style = "width: 192px;" scope="col">Album</th>
                        <th style = "width: 192px;" scope="col">Duration</th>
                        <th style = "width: 100px;" scope="col">No_of_Plays</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- view song form -->
                    <?php

                    if(!empty($_SESSION['song_results']))
                    {
                        $no_of_songs = count($_SESSION['song_results']);
                        $song_no = 0;
                        $id = 1;
                        while($no_of_songs > $song_no){
                            $song_name = $_SESSION['song_results'][$song_no]['name'];
                            $duration = $_SESSION['song_results'][$song_no]['duration'];
                            $no_of_plays = $_SESSION['song_results'][$song_no]['no_of_plays'];
                            $album_name = $_SESSION['song_results'][$song_no]['album_name'];
                            $artist_name = $_SESSION['song_results'][$song_no]['artist_username'];
                            
                            echo '<tr><th style = "width: 150px;" scope="row">'.$id.'</th><td>'.$song_name.'</td><td> '.$artist_name.'<td>'.$album_name.'</td><td>'.$duration.'</td><td>'.$no_of_plays.'</td></tr>';

                            $id++;
                            $song_no++;
                        }
                       
                    }
                    ?> 
                    </tbody>
                </table>
    </div>  
    </div>
   
</section>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.3/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>