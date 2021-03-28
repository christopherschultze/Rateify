<?php
        include 'logic.php';
        include 'connection.php';

        $conn = connect();

        $result = login($conn, "test", "test1");
        header("Content-Type: JSON");
        $rowNumber = 0;
        $output = array();
        while($row = mysql_fetch_array($result)){
            $output[$rowNumber]['1'] = $row['username'];
            $output[$rowNumber]['2'] = $row['password'];
            $output[$rowNumber]['3'] = $row['accountType'];
            $output[$rowNumber]['4'] = $row['id'];

            $rowNumber++;
        }
        echo json_decode($output, JSON_PRETTY_PRINT);

?>