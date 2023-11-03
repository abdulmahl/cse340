<?php 
    //? This is the Accounts Model.

    //? This Function will handle the site registrations.
    function regClient( $clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
        // Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement
        $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    //? This function will handle the checking of duplicate email addresses,
    //? if an email is duplicated it will return negative and return positive 
    //? if the case is otherwise.
    function filterExistingEmail($clientEmail) {
        // Create connection object using function from phpmotors connection.
        $db = phpmotorsConnect();
        // Use sql SELECT statement to select emails.
        $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
        // Create prepared statement using the phpmotors connection.
        $stmt = $db->prepare($sql);
        // Replace placeholders in the SQL statement with actual
        // values in the variables.
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        // Insert the data.
        $stmt->execute();
        // Match the eamils.
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        // Close interaction with the database.
        $stmt->closeCursor();
        if(empty($matchEmail)) {
            return 0;
            // echo 'Nothing found';
            // exit;
        } else {
            return 1;
            // echo 'Match found';
            // exit;
        }
    }

    //? Get client data based on an email address
    function getClient($clientEmail){
        $db = phpmotorsConnect();
        $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->execute();
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
    }
?>