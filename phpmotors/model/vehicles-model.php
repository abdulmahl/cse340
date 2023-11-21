<?php
    //? This the Vehicles model.

    //? This function will handle the adding of a new classification.
    function addClassification($classificationName) {
        //? Create a connection object from the phpmotors connection function.
        $db = phpmotorsConnect();
        //? SQL statement!!!
        $sql = 'INSERT INTO carclassification (classificationName) 
            VALUES (:classificationName)';
        //? Prepare sql statements using the phpmotors connections.
        $stmt = $db->prepare($sql);
        //? This next line replace the placeholders in the SQL
        //? statement with the actual value in the variable
        //? and tells the database the type of data it is.
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        //? Insert the data.
        $stmt->execute();
        //? Check how many rows changed as a result of our insert.
        $rowsChanged = $stmt->rowCount();
        //? Close database interaction
        $stmt->closeCursor();
        //? Return the indication of successful rows changed.
        return $rowsChanged;
    }

    //? This function will handle the adding of a new vehicle.
    function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
        //? Create a connection object from the phpmotors connection function.
        $db = phpmotorsConnect();
        //? SQL statement!!!
        $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
        //? Prepare sql statements using the phpmotors connections.
        $stmt = $db->prepare($sql);
        //? The next several lines replace the placeholders in the SQL
        //? statement with the actual values in the variables
        //? and tells the database the type of data it is.
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        //? Insert the data.
        $stmt->execute();
        //? Check how many rows changed as a result of our insert.
        $rowsChanged = $stmt->rowCount();
        //? Close database interaction
        $stmt->closeCursor();
        //? Return the indication of successful rows changed.
        return $rowsChanged;
    }

    //? Get vehicles by classificationId from the db.
    function getInventoryByClassification($classificationId){ 
        $db = phpmotorsConnect(); 
        $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
        $stmt = $db->prepare($sql); 
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
        $stmt->execute(); 
        $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $stmt->closeCursor(); 
        return $inventory; 
    }

    //? Get vehicle information by invId from the db.
    function getInvItemInfo($invId){
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

    //? This function will handle the updating of a vehicle.
    function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
        //? Create a connection object from the phpmotors connection function.
        $db = phpmotorsConnect();
        //? SQL statement!!!
        $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
        //? Prepare sql statements using the phpmotors connections.
        $stmt = $db->prepare($sql);
        //? The next several lines replace the placeholders in the SQL
        //? statement with the actual values in the variables
        //? and tells the database the type of data it is.
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        //? Insert the data.
        $stmt->execute();
        //? Check how many rows changed as a result of our insert.
        $rowsChanged = $stmt->rowCount();
        //? Close database interaction
        $stmt->closeCursor();
        //? Return the indication of successful rows changed.
        return $rowsChanged;
    }

    //? This function will handle the deletion of a vehicle.
    function deleteVehicle($invId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    //? This function will handle the display of the classifications list.
    function getVehiclesByClassification($classificationName) {
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
    }

    //? This function will get data from the db to display on the document as HTML.
    function getVehicleDetails($invId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT inv.invMake, inv.invModel, inv.invDescription, inv.invPrice, inv.invStock, inv.invColor, (SELECT img.imgPath FROM images img WHERE inv.invId = img.invId AND img.imgPrimary = 1 LIMIT 1) invImage FROM inventory inv WHERE invId = :invId';

        // $sql = 'SELECT invMake, invModel, invDescription, invPrice, invStock, invColor, invImage FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

    //? This function will obtain information about all vehicles in inventory.
    function getVehicles(){
        $db = phpmotorsConnect();
        $sql = 'SELECT invId, invMake, invModel FROM inventory';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }
?>