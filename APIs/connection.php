<?php
        $host = 'localhost';
        $user = 'root';
        $pwd = '';
        $db = 'spotify';

        $conn;


        function connect() {
            global $host, $user, $pwd, $db;
            $conn = mysqli_connect($host, $user, $pwd, $db);
            // if(my_sqli_connect_errno($conn))
            // {
            //     print "Connection failed.";
            // }
            // else
            // {
            //     print "Hello";
            // }
            return $conn;
        }

        function closeCon($conn)
        {
            $conn->close();
        }


?>