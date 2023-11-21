<?php 
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/index.php/');
        exit;
    }

    // Build the classifications option list
    $classifList = '<select name="classificationId" id="classificationId">';
        foreach($classifications as $classification) {
            $classifList .= "<option value='$classification[classificationId]'";
            if(isset($classificationId)) {
                if($classification['classifictionId'] === $classificationId) {
                    $classifList .= ' selected ';
                }
            } elseif(isset($invInfo['classificationId'])) {
                if($classification['classificationId'] === $invInfo['classificationId']) {
                    $classifList .= ' selected ';
                }
            }
        $classifList .= ">$classification[classificationName]</option>";
        }
    $classifList .= '</select>';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
    elseif(isset($invMake) && isset($invModel)) {
        echo "Modify $invMake $invModel";
    } ?> &bull; PHP Motors</title>
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
           <?php echo $navList; ?>
        </nav>

        <div class="note"> 
            <?php 
                if(isset($message)) { 
                    echo $message; 
                }
            ?> 
        </div>

        <main class="add-main">

            <div class="addVehicleFormWrap">

                <form action="http://localhost/phpmotors/vehicles/" method="POST">
        
                    <h1 class="update-vehicle"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                        elseif(isset($invMake) && isset($invModel)) { 
                        echo "Modify $invMake $invModel"; }?></h1>
                    
                    <div class="labels">
                        <label for="classificationId">Classification <?php echo $classifList;?> </label>
                        <label for="invMake">Make*<input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)) { echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?>></label>
                        <label for="invModel">Model*<input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)) {echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?>></label>
                        <label for="invDescription">Description*<textarea name="invDescription" id="invDescription" rows="11" cols="27" required ><?php if(isset($invDescription)) { echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription'];} ?></textarea></label>
                        <label for="invImage">Image Path*<input type="text" name="invImage" id="invImage" value="/phpmotors/images/no-image.png" required <?php if(isset($invImage)) {echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'";} ?>></label>
                        <label for="invThumbnail">Thumbnail Path*<input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors/images/no-image.png" required <?php if(isset($invTumbnail)) {echo "value='$invThumbnail'";} elseif(isset($invInfo)) {echo "value='$invInfo[invThumbnail]'";}?>></label>
                        <label for="invPrice">Vehicle Price*<input type="number" name="invPrice" id="invPrice" required <?php if(isset($invPrice)) { echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'";} ?>></label>
                        <label for="invStock">Stock*<input type="number" name="invStock" id="invStock" required <?php if(isset($invStock)) {echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'";} ?>></label>
                        <label for="invColor">Color*<input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)) {echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'";} ?>></label>
                    </div>

                    <div id="regButton">
                        <button class="regButton">Update Vehicle</button>
                        <input type="hidden" name="action" value="updateVehicle">
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])) {echo $invInfo['invId'];} elseif(isset($invId)) {echo $invId;} ?>">
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