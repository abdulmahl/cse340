<?php 
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/index.php/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">

    <title><?php if(isset($invInfo['invMake'])) {
        echo "Delete $invInfo[invMake] $invInfo[invModel]";
    } ?> &bull; PHP Motors</title>

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
        
                    <h1 class="update-vehicle"><?php if(isset($invInfo['invMake'])){ 
                        echo "<span class='del'>Delete</span> `$invInfo[invMake] $invInfo[invModel]`";}?></h1>

                    <p class="confirm-del">Confirm Vehicle Deletion. The delete is permanent</p>
                    
                    <div class="labels">
                        <label for="invMake">Make*<input type="text" readonly name="invMake" id="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?>></label>
                        <label for="invModel">Model*<input type="text" readonly name="invModel" id="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?>></label>
                        <label for="invDescription">Description*<textarea name="invDescription" readonly id="invDescription" rows="11" cols="27" ><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription'];} ?></textarea></label>
                    </div>

                    <div id="regButton">
                        <button class="delButton">Delete Vehicle</button>
                        <input type="hidden" name="action" value="deleteVehicle">
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])) {echo $invInfo['invId'];} ?>">
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