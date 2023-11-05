<?php 
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
        header('Location: /phpmotors/index.php/');
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

            </div>
            
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    <script src="/phpmotors/scripts/index.js" defer></script>
    <script src="/phpmotors/scripts/date-time.js" defer></script>
</body>
</html>