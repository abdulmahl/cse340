<?php 
    //* This is the phpmotors controller (PHP Motors Controller) *//
    //* Main Controller. *//

    //? Create or access a session.
    session_start();
    //? Get the database connection file. 
    require_once 'library/connections.php';

    //? Get the PHP Motors Model for use when needed.
    require_once 'model/main-model.php';

    //? Get the email/password check function file.
    require_once 'library/functions.php';

    //? Get the array classifications.
    $classifications = getClassifications();

    //? build dynamic hamburger button.
    $hamBtn = '<span></span> <span></span> <span></span>';

    //? Get the navigation bar.
    $navList = buildNavBar($classifications);

    //? Check if firstname cookie exists, if it does collect it's value.
    if(isset($_SESSION['loggedin'])) {
        $sessionFirstname = $_SESSION['clientdata']['clientFirstname'];
        // filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }

    $action = filter_input(INPUT_POST, 'action');
    if($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    switch($action) {
        case 'template':
            include 'view/template.php';
        break;

        default:
            include 'view/home.php';
        break;
    }
?>