<?php
    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Review Update&bull; PHP Motors</title>
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
            <h1 class="">Update Review</h1>
            <p class="">Update your review</p>

            <div class="note"> 
                <?php
                    if(isset($message)) { 
                        echo $message;
                    }
                ?> 
            </div>
            
            <?php echo "<h3 class='customerRev'>Review the $vehicleDetails[invMake] $vehicleDetails[invModel]</h3>"; ?>

            <form action="/phpmotors/reviews/index.php" method="POST" <?php if(!$_SESSION['loggedin']) { echo "hidden"; } ?>>
                    <label for="editReview">Update Review: <textarea name="edit" id="editReview" cols="30" rows="10" required><?php if(isset($reviewText)) { echo "value='$reviewText'"; }?></textarea></label>

                    <button class="regbtn">Update Review</button>
                    <input type="hidden" name="action" value="editReview">
                    <input type="hidden" name="reviewId" <?php echo 'value="'.$reviewId.'"'; ?>>
            </form>
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/date-time.js"></script>

</body>
</html>