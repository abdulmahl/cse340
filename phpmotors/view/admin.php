<?php 
    if(!$_SESSION['loggedin']) {
        header('Location: /phpmotors/index.php/');
    }


    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Administration &bull; PHP Motors</title>
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

        <main class="adminMain">

            <div class="note">
                <?php 
                    if(isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                ?>
            </div>

            <h1 class="fullname">
                <?php
                    echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname'];
                ?>
            </h1>

            <p class="log-in">You are Logged in.</p>
            <ul class="loggedin-list">
                <li class="credentials"> First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li class="credentials"> Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li class="credentials"> Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            </ul>

            <div class="acc-inv-container">
                <div class="acc-man">
                    <?php 
                        if($_SESSION['loggedin']) {
                            echo '<h2 class="inv">Account Management</h2>
                                <span class="updateInv">Use this link to update your account details</span> <br>
                                <a href="/phpmotors/accounts/index.php/?action=update" class="levelClientLink">Account Management</a>';
                        }
                    ?>
                </div>
                <br>
                <div class="inv-man">
                    <?php 
                        if($_SESSION['clientData']['clientLevel'] > 1) {
                            echo '<h2 class="inv">Inventory Management</h2>
                                <span class="updateInv">Use this link to update the inventory</span> <br>
                                <a href="/phpmotors/vehicles" class="levelClientLink">Vehicle Management</a>';
                        }
                    ?>
                </div>
            </div>
            
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/date-time.js"></script>

</body>
</html><?php unset($_SESSION['message']); ?>