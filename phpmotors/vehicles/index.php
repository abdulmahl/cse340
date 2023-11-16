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

    //? build dynamic hamburger button.
    $hamBtn = buildHamBtn();

    //? Build a navigation bar using the $classifications array.
    $navList = buildNavBar($classifications);

    //? Build the dropdown selection list.
    $classificationList = '<select name="classificationName" class="selectionTab">';
    $classificationList .= '<option disabled selected> Select Classification </option>';
    foreach($classifications as $classification) {
        $classificationList .= "<option value=$classification[classificationId]>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';

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
                $message = '<p>Please provide information for all empty form fields. NB, all fields marked with an * are obligatory</p>';
                $_SESSION['message'] = $message;
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
                $message = '<p>Sorry, car classification registration failed. Please try again.</p>';
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
                $message = '<p>Please provide information for all empty form fields. NB, all fields marked with an * are obligatory</p>';
                $_SESSION['message'] = $message;
                include '../view/addvehicle.php';
                exit; 
            }

            // Send the data to the model
            $regVehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationName);

            // Check and report the result
            if($regVehicleOutcome === 1){
                $message = "<p>The $invMake $invModel, was successfully added! Thank you.</p>";
                include '../view/addvehicle.php';
                exit;
            } else {
                $message = '<p>Sorry, vehicle registration failed. Please try again later.</p>';
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
                $message = '<p>Please complete all information for the updated item! Double check the classification of the item.</p>';
                include '../view/update-vehicle.php';
                exit;
            }

            $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

            if ($updateResult) {
                $message = "<p>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p>Error: The $invMake $invModel was not updated.</p>";
                include '../view/update-vehicle.php';
                exit;
            }
        break;

        case 'deleteVehicle':
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p>Error: $invMake $invModel was not deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
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
                $message = '<p>Sorry, no vehicle information could be found</p>';
            }
            include '../view/update-vehicle.php';
            exit;
        break;

        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo) < 1) {
                $message = '<p>Sorry, no vehicle information could be found</p>';
            }
            include '../view/delete-vehicle.php';
            exit;
        break;

        case 'classif':
            include '../view/addclassification.php';
        break;
            
        case 'vehicle':
            include '../view/addvehicle.php';
        break;

        case 'updatevehicle':
            include '../view/update-vehicle.php';
        break;

        case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if(!count($vehicles)){
                $message = "<p>Sorry, no $classificationName vehicles could be found.</p>";
            } else {
                $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            
            include '../view/classification.php';
            exit;
        break;

        case 'vehicleDisplay':
            $vehicleId = filter_input(INPUT_GET, 'vehicle', FILTER_SANITIZE_NUMBER_INT);

            $vehicleDetails = getVehicleDetails($vehicleId);

            if($vehicleDetails) {
                $displayVehicleDetails = getVehicleDisplay($vehicleDetails);
            } else {
                $message = '<p> Sorry, no such vehicle exists.</p>';
            }
            include '../view/vehicle-details.php';
            exit;
        break;

        default:
            $classificationList = buildClassificationList($classifications);
            include '../view/vehiclemanager.php';
            exit;
        break;
    }
?>