<?php
        $host = 'localhost';
        $user = 'root';
        $pwd = 'ensf409';
        $db = 'spotify';

        $conn;


        function connect() {
            global $host, $user, $pwd, $db;
            $conn = mysqli_connect($host, $user, $pwd, $db);
            if(my_sqli_connect_errno($conn))
            {
                print "Connection failed.";
            }
            else
            {
                printf "Hello";
            }
        }


?>