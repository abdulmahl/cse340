<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Home &bull; PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/medium.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Text&family=Rajdhani&display=swap">
</head>
<body>

    <div class="container">

        <header>
            <?php
                require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';
            ?>
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
            <h1 class="welcomeMsg"><strong>Welcome to PHP Motors!</strong></h1>

            <div class="mainContainer">
                <div class="description">
                    <div class="descriptionTitle"><strong>DMC Delorean</strong></div>
                    <div class="descript"><strong>3 cup holder</strong></div>
                    <div class="descript"><strong>Superman doors</strong> </div>
                    <div class="descript"><strong>Fuzzy dice!</strong></div>
                </div>
                <img src="/phpmotors/images/delorean.jpg" alt="delorean-image" id="heroImage">

                <div class="ownWrapper">
                    <a href="#" class="ownToday">Own Today</a>
                </div>
            </div>

            <div class="mainContainer1">

                <div class="formWrap">
                    <h2 class="reviews"><strong>DMC Delorean Reviews</strong></h2>
                    <ul class="reviewsList">
                        <li>"So fast it's almost like travling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </div>

                <div class="upgradesWrapper">
                    <h2 class="upgrades">Delorean Upgrades</h2>
                    <div class="upgradeIcons">
                        <div class="fluxWrap">
                            <div class="iconWrap">
                                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux-cap-image" id="iconImg1">
                            </div>
                            <a href="#" class="flux">Flux Decapitator</a>
                        </div>
                    
                    <div class="flameWrap">
                            <div class="iconWrap">
                                <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame-image" id="iconImg2">
                            </div>
                            <a href="#" class="flux">Flame Decals</a>
                    </div>

                        <div class="bumperWrap">
                            <div class="iconWrap">
                                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper-sticker-image" id="iconImg3">
                            </div>
                            <a href="#" class="flux">Bumper Stickers</a>
                        </div>

                        <div class="hubWrap">
                            <div class="iconWrap">
                                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub-cap-image" id="iconImg4">
                            </div>
                            <a href="#" class="flux">Hub Caps</a>
                        </div>
                    </div>
                </div>
                
            </div>

        </main>
       
        <footer>
            <?php
                require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';
            ?>
        </footer>
      
    </div>
    <script src="/phpmotors/scripts/index.js"></script>
    <script src="/phpmotors/scripts/date-time.js"></script>
</body>
</html>