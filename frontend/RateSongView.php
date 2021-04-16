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
        <div class="row vh-md-100">
            <div class="col-md-8 col-sm-10 col-12 mx-auto my-auto text-center">
                
              <!-- header -->
              <div class="col text-center">
                <h2> Search a song</h2>
              </div>
              

              <form action="../APIs/RateSongConnection.php" method="post">

                <!-- username field -->
                <div class="form-group">
                <label for="exampleInputEmail1" >Artist</label>
                <input name = "artist" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter artist">
                </div>

                <!-- password field -->
                <div class="form-group">
                <label for="exampleInputPassword1" >Song</label>
                <input name = "song_name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter song name">
                </div>


                <!-- login button -->
                <!-- TODO: login button functionality-->
                <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "Search">
                </div>
                </form>

                <!--GO Back Button [idk how to move it further down]-->
                <div class = "col-md-8 col-12 mx-auto pt-5 text-center">
                    <a href="listenerSongs.php" class="btn btn-primary" role="button" aria-pressed="true">
                        <- Go Back
                      </a>
                </div>
            </div>
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