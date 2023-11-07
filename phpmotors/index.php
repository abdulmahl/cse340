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

    // var_dump($classifications);
    // exit;

    //? build dynamic hamburger button.
    $hamBtn = '<span></span> <span></span> <span></span>';

    //? Build a dynamic navigation bar using the $classifications array.
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
     $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    // echo $navList;
    // exit;

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