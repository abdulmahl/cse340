<?php
    //? This function will check the value of the $clientEmail
    //? variable after it is sanitized, to check if the email
    //? passed looks valid.
    function checkEmail($clientEmail) {
        //? This function will return one of two values
        //? the first will be the actual email address if the 
        //? value is judged "valid", and two returns NULL if the
        //? email address is judged as "invalid".
        $validEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $validEmail;
    }

    //? this function will perform the same check as for the checkEmail 
    //? function, only for the password.
    function checkPassword($clientPassword) {
        //? Check the password for a minimum of 8 characters,
        //? at least one 1 capital letter, 1 number and
        //? 1 special character.
        $pattern  = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }

    function buildHamBtn() {
        $hamBtn = '<span></span> <span></span> <span></span>';
        return $hamBtn;
    }

    function buildNavBar($classifications) {
        //? Build a dynamic navigation bar using the $classifications array.
        $navList = '<ul>';
        $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }

    // Build the classifications select list 
    function buildClassificationList($classifications){ 
        $classificationList = '<select name="classificationId" id="classificationList">'; 
        $classificationList .= "<option>Choose a Classification</option>"; 
        foreach ($classifications as $classification) { 
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
        } 
        $classificationList .= '</select>'; 
        return $classificationList; 
    }

    // Build a vehicles display list.
    function buildVehiclesDisplay($vehicles){
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
            $dv .= '<li>';
            $dv .= "<a href='/phpmotors/vehicles?action=vehicleDisplay&vehicle=$vehicle[invId]'>";
            $dv .= '<div class="card">';
            $dv .= '<div class="cardText">';
            $dv .= "<h2 class='vName'>$vehicle[invMake] $vehicle[invModel]</h2>";
            $dv .= '<span class="invPrice">$'.number_format($vehicle['invPrice'], 2, '.').'</span>';
            $dv .= '</div>';
            $dv .= '<div class="imgContainer">';
            $dv .= "<img class='whips' src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
            $dv .= '</div>';
            $dv .= '</div>';
            $dv .= '<hr>';
            $dv .= '</a>';
            $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
    }

    // This function will build a display of vehicle details.
    function getVehicleDisplay($vehicleDetails){
        $dv = "<section class='vehicle-details'>";
        $dv .= "<img src='$vehicleDetails[invImage]' alt='$vehicleDetails[invMake]-$vehicleDetails[inModel]'>";
        $dv .= '<h2>Price: $'.number_format($vehicleDetails['invPrice']).'</h2>';
        $dv .= "<h2>$vehicleDetails[invMake] $vehicleDetails[invModel] Details</h2>";
        $dv .= "<p>$vehicleDetails[invDescription]</p>";
        $dv .= "<p>Color: $vehicleDetails[invColor]</p>";
        $dv .= "<p>Inventory Stock: $vehicleDetails[invStock]</p>";
        $dv .= '</section>';
        return $dv;
    }
?>