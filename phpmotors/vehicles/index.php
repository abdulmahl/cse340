<?php 
    //* This is the Vehicles Controller (Vehicles Controller) *//

    //? Create or access a session.
    session_start();

    //? Get the database connection file. 
    require_once '../library/connections.php';

    require_once '../library/functions.php';

    //? Get the PHP Motors Model for use when needed.
    require_once '../model/main-model.php';

    //? Get the vehicles model.
    require_once '../model/vehicles-model.php';

    //? Get the array classifications.
    $classifications = getClassifications();

    // var_dump($classifications);
    // exit;

    //? build dynamic hamburger button.
    $hamBtn = '<span></span> <span></span> <span></span>';

    //? Build a navigation bar using the $classifications array.
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors Home Page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    // echo $navList;
    // exit;

    //? Build the dynamic dropdown selection list.
    $classificationList = '<select name="classificationName" class="selectionTab">';
    $classificationList .= '<option disabled selected> Select Classification </option>';
    foreach($classifications as $classification) {
        $classificationList .= "<option value=$classification[classificationId]>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';

    // echo $classificationList;
    // exit;

    $action = filter_input(INPUT_POST, 'action');
    if($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    switch($action) { 
        //? Add classification case!
        case 'addclassification':
            // Filter and store data.
            $newClassificationName = filter_input(INPUT_POST, 'classificationName');

            // Check for missing input.
            if(empty($newClassificationName)) {
                $message = '<p class="note">Please provide information for all empty form fields.</p>';
                $message1 = '<p class="note">NB, all fields marked with an * are obligatory</p>';
                include '../view/addclassification.php';
                exit;
            }

            // Send data to the model.
            $regClassOutcome = addClassification($newClassificationName);

            // Check and report results.
            if($regClassOutcome === 1) {
                header ('Location: http://localhost/phpmotors/vehicles/index.php');
                exit;
            } else {
                $message = '<p class="note">Sorry, car classification registration failed. Please try again.</p>';
                include '../view/addclassification.php';
                exit;
            }
        break;

        //? Add vehicle case!
        case 'addvehicle':
            // Filter and store the data
            $classificationName = filter_input(INPUT_POST, 'classificationName');
            $invMake = filter_input(INPUT_POST, 'invMake');
            $invModel = filter_input(INPUT_POST, 'invModel');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = filter_input(INPUT_POST, 'invColor');

            // Check for missing data
            if(empty($classificationName)||empty($invMake)||empty($invModel)||empty($invDescription)||empty($invImage)||empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invColor)) {
                $message = '<p class="note">Please provide information for all empty form fields.</p>';
                $message1 = '<p class="note">NB, all fields marked with an * are obligatory</p>';
                include '../view/addvehicle.php';
                exit; 
            }

            // Send the data to the model
            $regVehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationName);

            // Check and report the result
            if($regVehicleOutcome === 1){
                $message = "<p class='note'>The $invMake $invModel, was successfully added! Thank you.</p>";
                include '../view/addvehicle.php';
                exit;
            } else {
                $message = '<p class="note">Sorry, vehicle registration failed. Please try again later.</p>';
                include '../view/addvehicle.php';
                exit;
            }
        break;

        case 'updateVehicle':
            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
                $message = '<p class="note">Please complete all information for the updated item! Double check the classification of the item.</p>';
                include '../view/update-vehicle.php';
                exit;
            }

            $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

            if ($updateResult) {
                $message = "<p class'note'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='note'>Error. The $invMake $invModel was not updated.</p>";
                include '../view/update-vehicle.php';
                exit;
            }
        break;

        case 'getInventoryItems': 
            // Get the classificationId 
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
            // Fetch the vehicles by classificationId from the DB 
            $inventoryArray = getInventoryByClassification($classificationId); 
            // Convert the array to a JSON object and send it back 
            echo json_encode($inventoryArray); 
        break;

        case 'mod':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo) < 1) {
                $message = '<p class="note">Sorry, no vehicle infornation could be found</p>';
            }
            include '../view/update-vehicle.php';
            exit;
        break;

        case 'classification':
            include '../view/addclassification.php';
        break;
            
        case 'vehicle':
            include '../view/addvehicle.php';
        break;

        case 'updatevehicle':
            include '../view/update-vehicle.php';
            break;

        default:
            $classificationList = buildClassificationList($classifications);
            // var_dump($classificationList);
            include '../view/vehiclemanager.php';
            exit;
        break;
    }
?>