<?php
    session_start();
    include 'logic.php';
    include 'connection.php';
    // echo $_SESSION['username'];
    $ids = array();
    $conn = connect();
    $song_name = $_POST['song_name'];
    $result2 = searchSongByName($conn, $song_name);
    if($result2->num_rows > 0)
    {
        while($row = $result2->fetch_assoc())
            array_push($ids, $row['id']);
        foreach($ids as $i)
        {
            $result3 = searchArtistSong($conn, $_SESSION['username'], $i);
            if($result3->num_rows > 0)
            {
                $_SESSION['notify'] = 2;
                break;
            }
        }
        if($_SESSION['notify'] != 2)
        {
            $date_created = $_POST['date_created'];
            $duration = $_POST['duration'];
            $query = getMaxSongID($conn);
            $id = $query->fetch_assoc();
            $max_id = $id['max_id'] + 1;
            $_SESSION['notify'] = 1;
            $_SESSION['notify'] = createSong($conn, $max_id, NULL, 0, $duration, $song_name, $date_created, $_SESSION['username'], $_SESSION['account_type']);
        }
    }
    else
    {
        $date_created = $_POST['date_created'];
        $duration = $_POST['duration'];
        $query = getMaxSongID($conn);
        $id = $query->fetch_assoc();
        $max_id = $id['max_id'] + 1;
        $_SESSION['notify'] = 1;
        $_SESSION['notify'] = createSong($conn, $max_id, NULL, 0, $duration, $song_name, $date_created, $_SESSION['username'], $_SESSION['account_type']);
    }
    // echo " ";
    // echo $_SESSION['notify'];
    // hello2($conn, 'Hello');
    header("Location: ../frontend/CreateSongView.php");
?>