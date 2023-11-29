<?php 
    //* This is the Accounts Controller (Accounts Controller) *//

    //? Create or access a session.
    session_start();

    //? Get the database connection file. 
    require_once '../library/connections.php';

    //? Get the email/password function file.
    require_once '../library/functions.php';

    //? Get the PHP Motors Model for use when needed.
    require_once '../model/main-model.php';

    //? Get the accounts model.
    require_once '../model/accounts-model.php';

    require_once '../model/reviews-model.php';

    require_once '../model/vehicles-model.php';

    //? Get the array classifications.
    $classifications = getClassifications();

    //? build dynamic hamburger button.
    $hamBtn = buildHamBtn();

    //? Build a navigation bar using the $classifications array.
    $navList = buildNavBar($classifications);

    $action = filter_input(INPUT_POST, 'action');
    if($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    switch($action) {
        case 'registerClient':
            // Trim, filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            // Validate the email variable using my custom function.
            $clientEmail = checkEmail($clientEmail);
            // Check password format using my custom function.
            $checkPassword = checkPassword($clientPassword);

            // Check for existing email.
            $existingEmail = filterExistingEmail($clientEmail);

            // Check for existing email in the table.
            if($existingEmail) {
                $message = '<p>That email address already exists! Do you want to login instead? </p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
                $message = '<p>Please provide information for all empty form fields. <br> NB, all fields marked with an * are obligatory</p>';
                include '../view/register.php';
                exit; 
            }

            // Hash the checked password.
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname,
            $clientEmail, $hashedPassword);

            // Check and report the result
            if($regOutcome === 1){
                
                setcookie('firstname', $sessionFirstname, strtotime('+1 year'), '/');

                $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header('Location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/register.php';
                exit;
            }
        break;

        case 'Login':
            // Trim, filter and store the data.
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            // Validate the email variable using my custom function.
            $clientEmail = checkEmail($clientEmail);
            // Check password format using my custom function.
            $checkPassword = checkPassword($clientPassword);

            // Check for any missing data.
            if(empty($clientEmail) || empty($checkPassword)) {
                // var_dump( $checkPassword);
                $_SESSION['message'] = '<p>Please provide valid email address and password.</p>';
                include '../view/login.php';
                exit; 
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if(!$hashCheck) {
            $_SESSION['message'] = '<p>Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;

            // Get the list of reviews for the client.
            $reviews = getClientReviews($_SESSION['clientData']['clientId']);
            $reviewDetails = '<ul>';
            foreach($reviews as $review){
                $reviewDetails .= buildListItem($review['reviewDate'], $review['reviewId']);
            }
            $reviewDetails .= '</ul>';

            // Send them to the admin view
            include '../view/admin.php';
            exit;
            
        break;

        case 'updateDetails':
            // Trim, filter and store the data
            $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $newEmail = trim(filter_input(INPUT_POST, 'newEmail', FILTER_SANITIZE_EMAIL));
            $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

            // Validate the email variable using custom function.
            $newEmail = checkEmail($newEmail);

            // Check if email already exists.
            $existingEmail = filterExistingEmail($newEmail);

            // Check for existing email in the table.
            if($existingEmail) {
                $message = '<p>That email address already exists! Please try a different one.</p>';
                include '../view/client-update.php';
                exit;
            }

              // Check for missing data
              if(empty($firstname) || empty($lastname) || empty($newEmail) || empty($invId)){
                $message = '<p>Please provide information for all empty form fields. <br> NB, all fields marked with an * are obligatory</p>';
                include '../view/client-update.php';
                exit; 
            }

            // Send the updated details to the model
            $updateOutcome = updateClientDetails($firstname, $lastname,
            $newEmail, $invId);

            // Query client data by client id.
            $clientData = getClientById($invId);
            array_pop($clientData); //
            // Store data in $_SESSION storage.
            $_SESSION['clientData'] = $clientData;

            // Check and report the result
            if($updateOutcome === 1){
                $message = "Thank you $firstname, Your details have been updated successfully!";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/accounts/');
                exit;
            } else {
                $message = "<p>Sorry $firstname, but the update failed. Please try again.</p>";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/accounts/');
                exit;
            }

        break;

        case 'updatePassword':
            $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            // Check password format using my custom function.
            $checkPassword = checkPassword($newPassword);

            // Check missing data.
            if(empty($checkPassword)) {
                $message1 = '<p>Please provide infomation for all empty fields. <br> Fields marked with an * are mandatory. <br> Check if your password matches the required pattern.</p>';
                include '../view/client-update.php';
                exit;
            }
            // Hash new password.
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Send updated password to model.
            $updatedOutcome = updateClientPassword($hashedPassword, $invId);

            // Check and report results.
            if($updatedOutcome === 1) {
                $message = "<p>Thank you, Password successfully updated!</p>";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/accounts/');
                exit;
            } else {
                $message = "<p>Sorry, but password update failed. Please try again!";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/accounts/');
                exit;
            }
        break;

        case 'logout':
            session_destroy();
            header('Location: /phpmotors/accounts/?action=login');
        break;
 
        case 'register':
            include '../view/register.php';
        break;
            
        case 'login':
            include '../view/login.php';
        break;

        case 'update':
            include '../view/client-update.php';
        break;

        default:
            // Get the list of reviews for the client.
            $reviews = getClientReviews($_SESSION['clientData']['clientId']);
            $reviewDetails = '<ul>';
            foreach($reviews as $review){
                $reviewDetails .= buildListItem($review['reviewDate'], $review['reviewId']);
            }
            $reviewDetails .= '</ul>';
            include '../view/admin.php';
            exit;
        break;
    }
?>