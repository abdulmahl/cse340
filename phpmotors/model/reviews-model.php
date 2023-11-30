<?php 
    //* This is the reviews model.

    //? This fuction handles the adding of reviews.
    function addReview($reviewText, $clientId, $invId) {
        $db = phpmotorsConnect();
        $sql = 'INSERT INTO reviews (reviewText, clientId, invId) VALUES (:reviewText, :clientId, :invId)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    //? This function will handle getting inventory information from the DB.
    function getInvReviews($invId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, r.clientId, c.clientFirstname, c.clientLastname FROM reviews r INNER JOIN clients c ON c.clientId = r.clientId WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $itemList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $itemList;
    }

    //? This function will get all the client reviews.
    function getClientReviews($clientId){
        $db = phpmotorsConnect();
        $sql = 'SELECT reviewId, reviewText, reviewDate, reviews.invId, reviews.clientId, inventory.invMake, inventory.invModel FROM reviews JOIN inventory JOIN clients ON reviews.invId = inventory.invId AND reviews.clientId = clients.clientId WHERE reviews.invId = inventory.invId AND reviews.clientId = :clientId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $itemList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $itemList;
    }

    //? This function will each review by it's id.
    function getReview($reviewId){
        $db = phpmotorsConnect();
        $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, r.clientId, c.clientFirstname, c.clientLastname FROM reviews r INNER JOIN clients c WHERE r.reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $review = $stmt->fetch();
        $stmt->closeCursor();
        return $review;
    }

    //? This function will handle updating the reviews.
    function updateReview($reviewText, $reviewId){
        $db = phpmotorsConnect();
        $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    //? This function will handle deleting the reviews using the id to target the reviews.
    function deleteReview($reviewId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    
?>