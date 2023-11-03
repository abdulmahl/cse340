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
    <title>Add Classification &bull; PHP Motors</title>
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
            <div id="hamBtn"> <?php echo $hamBtn; ?> </div>
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
                        echo $message1; 
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
    <script src="/phpmotors/scripts/index.js" defer></script>
    <script src="/phpmotors/scripts/date-time.js" defer></script>
</body>
</html>