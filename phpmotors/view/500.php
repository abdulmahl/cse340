<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Server Error &bull; PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/medium.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Text&family=Rajdhani&display=swap">
</head>
<body>

    <div class="container">
        <header>
           <?php 
                require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php' 
            ?>
        </header>

        <div class="hamBtnWrap">
            <div id="hamBtn"> <?php echo $hamBtn; ?> </div>
        </div>

        <nav id="primaryNav">
           <?php 
                require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php'
            ?>
        </nav>

        <main>
            <h1 class="serverTitle">Server Error...</h1>
            <h2 class="serverMsg">
                Sorry our server seems to be 
                experiencing technical difficulties.
                Please check back later.
            </h2>
        </main>

        <footer>
            <?php 
                require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php' 
            ?>
        </footer>
    </div>
    <script src="/phpmotors/scripts/index.js" defer></script>
    <script src="/phpmotors/scripts/date-time.js" defer></script>
</body>
</html>