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
    <title>Deleting a rating...</title>

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


<?php
  if($_SESSION['notify'] == 1)
    echo "<script>alert('Comment removed sucessfully');</script>";
  if($_SESSION['notify'] == 2)
    echo "<script>alert('Failed to remove comment');</script>";
  $_SESSION['notify'] = 0;
?>

<!--signup functionality-->
<section class="py-7 py-md-0 bg-hero" id="login">
    <div class="container">
        <div class="row vh-md-100">
            <div class="col-md-8 col-sm-10 col-12 mx-auto my-auto text-center">
                
              <!-- header -->
              <div class="col text-center">
                <h1> Delete Rating</h1>
              </div>

                <!-- signup form -->
                <form action="../APIs/DeleteRatingConnection.php" method="post">

                    <!-- playlist name field -->
                    <div class="form-group">
                      <label for="exampleInputEmail1" >Username of the Rating</label>
                      <input name = "username" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter username">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1" >Song ID of the Rating</label>
                      <input name = "song_id" type="text" class="form-control" id="signupUsername" aria-describedby="signupUsernameHelp" placeholder="Enter song id">
                    </div>

                    <!-- login button -->
                    <!-- TODO: login button functionality-->
                    <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                      <input type = "submit" class="btn btn-primary" role="button" aria-pressed="true" name = "button" value = "DELETE!" onclick='window.location.reload();'>
                    </div>
                </form>
                <div class="col-md-8 col-12 mx-auto pt-5 text-center">
                <a href="admin.php" class="btn btn-primary" role="button" aria-pressed="true">
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