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
              <h1> Search Results for <?php echo $_SESSION['searchedSongNameAdmin'];?> </h1>
              </div>

              <!-- hyperlinks -->
              <div class="col text-center">
                <a href="searchSongAdmin.php"> Return to action page</a>.
              </div>

              <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Song ID</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->
                  <?php
                    include '../APIs/logic.php';
                    include '../APIs/connection.php';
                    $conn = connect();
                    if(sizeof($_SESSION['all_songsAdmin']) != 0)
                    {
                        $no_of_songs = count($_SESSION['all_songsAdmin']);
                        // echo $_SESSION['all_songsAdmin'][0]['id'];
                        // echo "<br/>";
                        // echo $_SESSION['all_songsAdmin'][1]['id'];
                        // echo "<br/>";
                        // echo $_SESSION['all_songsAdmin'][2]['id'];
                        // echo "<br/>";
                        $song_no = 0;
                        $id = 1;
                        while($no_of_songs > $song_no){
                            $artists = array();
                            $artist_names = searchArtistBySong($conn, $_SESSION['all_songsAdmin'][$song_no]['id']);
                            if($artist_names->num_rows > 0)
                            {
                                while($row3 = $artist_names->fetch_assoc())
                                    array_push($artists, $row3['artist_username']);
                            }
                            $duration = $_SESSION['all_songsAdmin'][$song_no]['duration'];
                            $no_of_plays = $_SESSION['all_songsAdmin'][$song_no]['no_of_plays'];
                            // $album_name = $_SESSION['all_songs'][$song_no]['album_name'];
                            $iteration = 0;
                            if(!empty($artists))
                            {
                                while($iteration < sizeof($artists))
                                {
                                    if($iteration == 0)
                                    {
                                        echo '<tr><th scope="row">'.$id.'</th><td>'.$_SESSION['all_songsAdmin'][$song_no]['name'].'</td><td>'.$artists[$iteration].'</td><td>'.$_SESSION['all_songsAdmin'][$song_no]['id'].'</td></tr>';
                                    }
                                    else
                                    {
                                        echo '<tr><th scope="row"></th><td></td><td>'.$artists[$iteration].'</td><td></td><td></td></tr>';
                                    }
                                    $iteration++;
                                }
                                
                            }
                            else
                                echo '<tr><th scope="row">'.$id.'</th><td>'.$_SESSION['all_songsAdmin'][$song_no]['name'].'</td><td>'.$artists[$iteration].'</td><td>'.$_SESSION['all_songs'][$song_no]['id'].'</td></tr>';
                            
                            

                            $id++;
                            $song_no++;
                        }
                       
                    }
                    else
                    {
                        echo '<h3> No results </h3>';
                    }
                  ?> 
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