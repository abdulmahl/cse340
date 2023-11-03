<?php 
    //* Proxy connection to the phpmotors database

    function phpmotorsConnect() 
        {
            $server = 'localhost';
            $dbname = 'phpmotors';
            $username = 'iClient';
            $password = 'GU3a3wrjo9RPcbta';
            $dsn = "mysql:host=$server;dbname=$dbname";
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

            try {
                $link = new PDO($dsn, $username, $password, $options);
                return $link;
                // if(is_object($link)) {
                //     echo 'It worked';
                // }
            } catch(PDOException $e) {
                require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/500.php';
                exit;
                // echo 'It did not work, error' . $e->getMessage();
            }
        }

        // phpmotorsConnect();
?>