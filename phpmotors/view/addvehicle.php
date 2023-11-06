<?php 
    if($_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/index.php/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Add Vehicle &bull; PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/medium.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Text&family=Rajdhani&display=swap">
</head>
<body>

    <div class="container">
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>

        <div class="hamBtnWrap">
            <label class="burger" for="hamBtn"><div class="menuBtn">Menu</div>
                <input name="hamburgerBtn" title="Hamburger Button" type="checkbox" id="hamBtn">
                <?php echo $hamBtn; ?>
            </label>
        </div>
        
        <nav id="primaryNav">
           <?php echo $navList; ?>
        </nav>

        <main class="add-main">

            <div class="note"> 
                <?php 
                    if(isset($message)) { 
                        echo $message; 
                    }
                    echo $message1; 
                ?> 
            </div>

            <div class="addVehicleFormWrap">

                <form action="http://localhost/phpmotors/vehicles/" method="POST">
        
                    <h1 class="add-vehicle">Add Vehicle</h1>
                    
                    <div class="labels">
                        <?php echo $classificationList;?>
                        <label for="invMake">Make*<input type="text" name="invMake" id="invMake" required></label>
                        <label for="invModel">Model*<input type="text" name="invModel" id="invModel" required></label>
                        <label for="invDescription">Description*<textarea name="invDescription" id="invDescription" rows="11" cols="27" required></textarea></label>
                        <label for="invImage">Image Path*<input type="text" name="invImage" id="invImage" value="/phpmotors/images/no-image.png" required></label>
                        <label for="invThumbnail">Thumbnail Path*<input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors/images/no-image.png" required></label>
                        <label for="invPrice">Vehicle Price*<input type="number" name="invPrice" id="invPrice" required></label>
                        <label for="invStock">Stock*<input type="number" name="invStock" id="invStock" required></label>
                        <label for="invColor">Color*<input type="text" name="invColor" id="invColor" required></label>
                    </div>

                    <div id="regButton">
                        <button class="regButton">Add Vehicle</button>
                        <input type="hidden" name="action" value="addvehicle">
                    </div>

                </form>
            
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