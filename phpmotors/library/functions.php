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

    //? Build dynamic hamburger button (for mobile view port), functionality handled by JS.
    function buildHamBtn() {
        $hamBtn = '<span></span> <span></span> <span></span>';
        return $hamBtn;
    }

    //? Build a dynamic navigation bar using the $classifications array.
    function buildNavBar($classifications) {
        $navList = '<ul>';
        $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }

    //? Build the classifications select list using the $classificatins list.
    function buildClassificationList($classifications){ 
        $classificationList = '<select name="classificationId" id="classificationList">'; 
        $classificationList .= "<option>Choose a Classification</option>"; 
        foreach ($classifications as $classification) { 
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
        } 
        $classificationList .= '</select>'; 
        return $classificationList; 
    }

    //? Build a vehicles display list.
    function buildVehiclesDisplay($vehicles){
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
            $dv .= '<li>';
                $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDisplay&vehicle=$vehicle[invId]'>";
                    $dv .= '<div class="card">';
                        $dv .= '<div class="cardText">';
                            $dv .= "<img class='whips' src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
                            $dv .= "<h2 class='vName'>$vehicle[invMake] $vehicle[invModel]</h2>";
                            $dv .= '<span class="invPrice">$'.number_format($vehicle['invPrice']).'</span>';
                        $dv .= '</div>';
                    $dv .= '</div>';
                $dv .= '</a>';
                $dv .= '<hr>';
            $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
    }

    //? This function will build a display of vehicle details, return the display as HTML.
    function getVehicleDisplay($vehicleDetails){
        $dv = "<section class='vehicle-details'>";

        $dv .= '<div class="leftPart">';
        $dv .= "<h1 class='vHeader'> $vehicleDetails[invMake] $vehicleDetails[invModel] </h1>";
        $dv .= "<img id='displayWhip' src='$vehicleDetails[invImage]' alt='$vehicleDetails[invMake]-$vehicleDetails[inModel]'>";
        $dv .= '<h2 class="vPrice">Price: $'.number_format($vehicleDetails['invPrice']).'</h2>';
        $dv .= '</div>';

        $dv .= '<div class="rightPart">';
        $dv .= "<h2 class='vNameDesc'>$vehicleDetails[invMake] $vehicleDetails[invModel] Details</h2>";
        $dv .= "<p class='grayOutDesc'>Description: $vehicleDetails[invDescription]</p>";
        $dv .= "<p class='grayOut'>Color: $vehicleDetails[invColor]</p>";
        $dv .= "<p class='grayOut'>Inventory Stock: $vehicleDetails[invStock]</p>";
        $dv .= '</div>';

        $dv .= '</section>';
        return $dv;
    }

    //* * ******************************** *//
    //*  Functions for working with images *//
    //* * ******************************** *//

    //? This function adds "-tn" designation to the file name.
    function makeThumbnailName($image) {
        $i = strrpos($image, '.');
        $image_name = substr($image, 0, $i);
        $ext = substr($image, $i);
        $image = $image_name . '-tn' . $ext;
        return $image;
    }

    //? This function will build the images display for the image management view.
    function buildImageDisplay($imageArray) {
        $id = '<ul id="image-display">';
        foreach ($imageArray as $image) {
            $id .= '<li>';
            $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
            $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
            $id .= '</li>';
        }
        $id .= '</ul>';
        return $id;
    }

    //? This function will build the vehicles select list.
    function buildVehiclesSelect($vehicles) {
        $prodList = '<select name="invId" id="invId">';
        $prodList .= "<option>Choose a Vehicle</option>";
        foreach ($vehicles as $vehicle) {
            $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
        }
        $prodList .= '</select>';
        return $prodList;
    }

    //? This function handles the file upload process and returns the path.
    //? The file path is stored into the database
    function uploadFile($name) {
        // Gets the paths, full and local directory
        global $image_dir, $image_dir_path;
        if (isset($_FILES[$name])) {
            // Gets the actual file name
            $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
        }
    }

    //? This function will processes images by getting paths and 
    //? creating smaller versions of the images.
    function processImage($dir, $filename) {
        // Set up the variables
        $dir = $dir . '/';
    
        // Set up the image path
        $image_path = $dir . $filename;
    
        // Set up the thumbnail image path
        $image_path_tn = $dir.makeThumbnailName($filename);
    
        // Create a thumbnail image that's a maximum of 200 pixels square
        resizeImage($image_path, $image_path_tn, 200, 200);
    
        // Resize original to a maximum of 500 pixels square
        resizeImage($image_path, $image_path, 500, 500);
    }

    //? This function checks and Resizes images.
    function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
        // Get image type
        $image_info = getimagesize($old_image_path);
        $image_type = $image_info[2];
    
        // Set up the function names
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $image_from_file = 'imagecreatefromjpeg';
                $image_to_file = 'imagejpeg';
                break;

            case IMAGETYPE_GIF:
                $image_from_file = 'imagecreatefromgif';
                $image_to_file = 'imagegif';
                break;

            case IMAGETYPE_PNG:
                $image_from_file = 'imagecreatefrompng';
                $image_to_file = 'imagepng';
                break;

            default:
                return;
        } // ends the switch
    
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
    
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);
    
        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);
    
        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }
    
        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
    
        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
        } else {
            // Write the old image to a new file
            $image_to_file($old_image, $new_image_path);
        }
        // Free any memory associated with the old image
        imagedestroy($old_image);
    } 
?>