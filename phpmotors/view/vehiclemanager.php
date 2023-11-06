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
    <title>Vehicle Management &bull; PHP Motors</title>
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
           <?php 
                echo $navList;
           ?>
        </nav>

        <main class="vManager">
            <?php
                if(isset($message)) {
                    echo $message;
                }
            ?>
            <div class="managementWrap">

                <h1 class="vehicle-manager">Vehicle Management</h1>
                <div class="addVehicleandClass">
                    <a href="/phpmotors/vehicles/?action=vehicle">Add a vehicle</a>
                    <a href="/phpmotors/vehicles/?action=classification">Add a classification</a>
                </div>

                <div class="heading">
                    <?php
                        if (isset($message)) { 
                        echo $message; 
                        } 
                        if (isset($classificationList)) { 
                        echo '<h2>Vehicles By Classification</h2>'; 
                        echo '<p class="choose">Choose a classification to see those vehicles</p>'; 
                        echo $classificationList; 
                        }
                    ?>

                    <noscript>
                    <p class="enable-js"><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                    </noscript>

                    <table id="inventoryDisplay"></table>
                </div>
              
            </div>
            
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    <script src="../scripts/inventory.js"></script>
    <script src="../scripts/index.js"></script>
    <script src="../scripts/date-time.js"></script>
</body>
</html>