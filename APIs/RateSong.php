<?php
    session_start();
    $_SESSION['song_choosing'] = key($_POST['rating']);
    header("Location: ../frontend/RatingView.php");
    // echo $_SESSION['song_choosing'];
?>