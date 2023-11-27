<?php 
    //* This is the reviews controller!

    //? Create or access a session.
    session_start();

    //? Get the database connection file. 
    require_once '../library/connections.php';

    require_once '../library/functions.php';

    //? Get the PHP Motors Model for use when needed.
    require_once '../model/main-model.php';

    //? Get the accounts model.
    require_once '../model/accounts-model.php';

    //? Bring the reviews model into the scope.
    require_once '../model/reviews-model.php';

    //? Get the array classifications.
    $classifications = getClassifications();

    //? build dynamic hamburger button.
    $hamBtn = buildHamBtn();

    //? Get the navigation bar.
    $navList = buildNavBar($classifications);

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch ($action) {
        case 'addReview':
            // Get and filter all the needed input.
            $newReview = filter_input(INPUT_POST, 'newReview', FILTER_SANITIZE_STRING);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $vehicleId = filter_input(INPUT_POST, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);

            // Check for any missing input data.
            if(empty($newReview) || empty($clientId) || empty($vehicleId)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                header('Location: /phpmotors/reviews/');
            }

            // Send data  to the model.
            $newReviewOutcome = addReview($newReview, $clientId, $vehicleId);

            if($newReviewOutcome === 1) {
                $message = '<p>Review added successfully!</p>';
                header('Location: /phpmotors/reviews/');
            } else {
                $message = '<p>Sorry, review not added. Please try again!</p>';
                header('Location: /phpmotors/reviews/');
                exit;
            }
            break;

        case 'editReview':
            // Get and filter input.
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

            // Check for missing data.
            if(empty($reviewId) || empty($reviewText)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/review-update.php';
                exit;
            }

            // Add data to the model.
            $reviewUpdateOutcome = updateReview($reviewId, $reviewText);

            //Check and report the outcome of the update.
            if($reviewUpdateOutcome === 1) {
                $_SEESSION['message'] = '<p>Review update was a success!</p>';
            } else {
                $_SESSION['message'] = '<p>Sorry, update did not occure. Please try again!</p>';
            }

            header('Location: /phpmotors/accounts/');
            exit;
            break;

        case 'edit':
            // Get and filter input.
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            // Get review details.
            $review = getReview($reviewId);

            // Include the view to edit 
            include '../view/review-update.php';
            break;

        case 'deleteReview':
            // Filter / get input.
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

            $deleteReport = deleteReview($reviewId);

            if ($deleteReport == 1){
                $_SESSION['message'] = "<p>Review successfully deleted.</p>";
            } else {
                $_SESSION['message'] = "<p>Sorry, review not deleted. Please try again.</p>".$deleteReport;
            }

            header('location: /accounts/');
            exit;
            break;

        case 'delete':
            // Get and filter input.
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

            $review = getReview($reviewId);

            include '../view/confirm-delete.php';
            break;

        default:
            if ($_SESSION['loggedin']){
                include '../view/admin.php';
                exit;
            }
            header('Location: /index.php/');
            exit;
            break;
    }
?> 