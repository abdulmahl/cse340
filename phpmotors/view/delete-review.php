<?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Confirm Review Delete &bull; PHP Motors</title>
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

            <section class="editDiv">
                <div class="revUp">
                    <h1 class="">Delete Review</h1>
                    <p class="redDel">This action <strong>CANNOT</strong> be undone.</p>
                </div>
            
                <div class="note"> 
                <?php 
                    if(isset($message)) { 
                        echo $message; 
                    }
                ?> 
                </div>

                <form action="/phpmotors/reviews/index.php" method="POST" <?php if(!$_SESSION['loggedin']) { echo "hidden"; } ?>>
                    <label class="editReview" for="editReview">Delete This Review: <textarea name="reviewText" id="editReview" cols="30" rows="10" readonly><?php if(isset($reviewText)) { echo $reviewText; } elseif(isset($review['reviewText'])) { echo $review['reviewText'];} ?></textarea></label>
                    <br>
                    <button type="submit" name="submit" class="regButton">Delete Review</button>
                    <br>
                    <input type="hidden" name="action" value="deleteReview">
                    <input type="hidden" name="reviewId" <?php echo 'value="'.$reviewId.'"' ?>>
                </form>
            </section>
    
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/date-time.js"></script>

</body>
</html>