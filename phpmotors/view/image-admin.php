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
    <title>Image Management &bull; PHP Motors</title>
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
                    if (isset($message)) {
                        echo $message;
                    } 
                ?>
            </div>

            <h1 class="imgMan">Image Management</h1>
            <p class="imgWelcomeMsg1">Welcome to the images management page</p>
            <p class="imgWelcomeMsg1">Choose any of the listed options below to manage your images.</p>

            <h2 class="imgH2">Add New Vehicle Image</h2>
           
            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data" class="imgFormCont">
                <p class="p">Vehicle</p>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <p class="p">Is this the main image for the vehicle?</p>
                    <label for="priYes" class="pImage">Yes<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1"></label>
                    <label for="priNo" class="pImage">No<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0"></label>
                </fieldset>
                <p class="p">Upload Image:</p>
                <label id="chooseFile" for="file1"><input type="file" name="file1" id="file1"><span class="input">input</span></label>
                <label id="labelbtn" for="regbtn"><input type="submit" class="regbtn" id="regbtn" value="Upload"><span class="input">input</span></label>
                <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2 class="imgH2">Existing Images</h2>
            <p class="imgDel">When deleting an image, delete the thumbnail too and vice versa.
                This action cannot be undone!
            </p>
            <?php
                if (isset($imageDisplay)) {
                    echo $imageDisplay;
                } 
            ?>

        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/date-time.js"></script>

</body>
</html>
<?php unset($_SESSION['message']); ?>
