<?php
  session_start();
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
                <a href="displaySearchSongs.php"> <-Return to viewing Songs</a>.
              </div>
                <div style = "position: absolute; left:150px;" class="col text-center">
                    <h1><?php echo $_SESSION['selected_songs_info']['name']?> </h1>
                    <h5><?php echo $_SESSION['songs_artist'] ?></h5>
                    <h6><?php echo $_SESSION['selected_songs_info']['date_created']?></h6>
                </div>
                 <!-- hyperlinks -->
             
            </div> 
            <div style = "position: absolute; top: 300px; left:150px;"class = "col text-center">
            <div  style = "top: 15px;" class="col text-left">
                <h5>Ratings</h5>
                </div>
            <table style = "width: 1200px;" class="table">
                </div>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">star_rating</th>
                        <th scope="col">Comment</th>
                    </tr>
                    </thead>
                    <tbody>
              <!-- view song form -->

                  <?php

                    if(!empty($_SESSION['song_rating']))
                    {
                        $no_of_ratings = count($_SESSION['song_rating']);
                        $rating_no = 0;
                        $id = 1;
                        while($no_of_ratings > $rating_no){
                            $user = $_SESSION['song_rating'][$rating_no]['user_username'];
                            $star_rating = $_SESSION['song_rating'][$rating_no]['star_rating'];
                            $comment = $_SESSION['song_rating'][$rating_no]['comment'];
                            
                            echo '<tr><th scope="row">'.$id.'</th><td>'.$user.'</td><td>'.$star_rating.'</td><td>'.$comment.'</td></tr>';

                            $id++;
                            $rating_no++;
                        }
                       
                    }
                  ?>
              </tbody>
            </table> 
            <?php
              echo "<br>";
              echo "<br>";
              echo "<br>";
              $_SESSION['artist_rating'] = $_SESSION['songs_artist'];
              $_SESSION['song_name_rating'] = $_SESSION['selected_songs_info']['name'];
              echo '<div><a href="RatingView.php"> +Rate This Song</a>.</div>';
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