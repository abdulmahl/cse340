<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title><?php echo "$vehicleDetails[invMake] $vehicleDetails[invModel]"; ?> &bull; PHP Motors</title>
    <link rel="shortcut icon" href="favicon.ico"> 
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/medium.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container">
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>

        <div class="hamBtnWrap">
            <label class="burger" for="hamBtn"><small class="menuBtn">Menu</small>
                <input name="hamburgerBtn" title="Hamburger Button" type="checkbox" id="hamBtn">
                <?php echo $hamBtn; ?>
            </label>
        </div>
        
        <nav id="primaryNav">
           <?php 
                echo $navList;
           ?>
        </nav>

        <main>
            
            <div class="note">
                <?php 
                    if(isset($message)) {
                        echo $message;
                    } 
                ?>
            </div>
            
            <?php echo "<h1 class='vHeader'> $vehicleDetails[invMake] $vehicleDetails[invModel]</h1>" ?>
            <section class='vehicle-details'>

                <?php 
                    if(isset($thumbnailList)) {
                        echo $thumbnailList;
                        }
                ?>

                <div class="imgDisplay">
                    <?php echo "<img src='$vehicleDetails[invImage]' alt='$vehicleDetails[invMake]-$vehicleDetails[inModel]'>"; ?>
                </div>

                <?php if(isset($displayVehicleDetails)) {
                    echo $displayVehicleDetails;
                    }
                ?>
            </section>

            <br>
            <hr>
            
            <div class="reviewsPart">
                <?php 
                    if (!$_SESSION['loggedin']){
                        echo '<p class="revLogin">Please <a href="/phpmotors/accounts/?action=login"><strong>login</strong></a> to leave a review.</p>';
                    }
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                ?>

                <div class="formDiv">
                    <h3 class="customerRev">CustomerReviews</h3>
                    <?php if($_SESSION['loggedin']) echo "<h3 class='customerV'>Review the $vehicleDetails[invMake] $vehicleDetails[invModel]</h3>"; ?>

                    <form action="/phpmotors/reviews/index.php" method="POST" <?php if (!$_SESSION['loggedin']){echo "hidden";} ?>>
                        <div class="addRevDiv">
                            <?php
                                $screenName = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'];
                                echo "<label><strong>Name as Displayed: </strong><input value='$screenName' readonly></label>";
                            ?>
                            <label for="review">Add a review: <textarea id="review" name="reviewText" rows="10" cols="10" required></textarea></label>
                            <br>
                            <button class="regButton" value="">Add Review</button>
                            <br>
                            <input type="hidden" name="action" value="addReview">
                            <input type="hidden" name="clientId" <?php echo 'value="'.$_SESSION['clientData']['clientId'].'"'; ?>>
                            <input type="hidden" name="vehicleId" <?php echo "value='$vehicleId'"; ?>>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="displayReviews">
                    <?php
                        if(isset($reviewDisplay)) {
                            echo $reviewDisplay; 
                        } else { 
                            echo "<p class='firstRev'>Be the first to leave a review!</p>";
                        }
                    ?>
                </div>

            </div>
                
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/date-time.js"></script>

</body>
</html>