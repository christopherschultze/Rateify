<?php
  session_start();
  $_SESSION['notify'];
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Produce a track...</title>

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
            <a class="navbar-brand heading-black" href="index.html">
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
                <h1> Upload your Track</h1>
              </div>
              <?php
                if($_SESSION['notify'] === 1)
                {
                  echo "<script>alert('song created successfully');</script>";
                }
                if($_SESSION['notify'] == 2)
                  echo "<script>alert('Failed');</script>";
                $_SESSION['notify'] = 0;
              ?>
                <!-- signup form -->
                <form action="../APIs/ProducerConnection.php" method="post">

                    <!-- playlist name field -->
                    <div class="form-group">
                      <label for="exampleInputEmail1" >Song Name</label>
                      <input name = "song_name" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter song name">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1" >Duration</label>
                      <input name = "track_duration" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter track duration">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1" >Date</label>
                      <input name = "date" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter date">
                    </div>

                    <!-- login button -->
                    <!-- TODO: login button functionality-->
                    <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                      <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "PUBLISH!" onclick='window.location.reload();'>
                    </div>
                </form>
                <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="producer.php" class="btn btn-primary" role="button" aria-pressed="true">
                  Go Back <-
                </a>
              </div>

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