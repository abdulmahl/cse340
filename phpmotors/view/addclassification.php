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
    <title>Add Classification &bull; PHP Motors</title>
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

        <main class="add-class">
            <div class="backGround">

                <div class="note"> 
                    <?php 
                        if(isset($message)) {
                            echo $message;
                        }
                    ?> 
                </div>

            </div>
           
            <div class="addClassFormWrap">
                <form action="http://localhost/phpmotors/vehicles/" method="POST">

                    <h1 class="add-classification">Add Classification</h1>

                    <div class="labels">
                        <label for="classificationName">Add Classification*<input type="text" name="classificationName" id="classificationName" required></label>

                        <div id="regButton">
                            <button class="regButton">Add Classification</button>
                            <input type="hidden" name="action" value="addclassification">
                        </div>
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