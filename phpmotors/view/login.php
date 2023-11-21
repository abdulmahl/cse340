<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Login &bull; PHP Motors</title>
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

        <div class="note">
            <?php 
                if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                } 
            ?>
        </div>

        <main class="loginCheckBack">

            <div class="loginFormWrap">
                
                <form action="/phpmotors/accounts/" method="POST">

                    <h1 class="logIn">Log In</h1>

                    <div class="registerField">
                        <label for="email">Email<input name="clientEmail" type="email" id="email" placeholder="Email*" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required></label>
                        <label for="password">Password<input name="clientPassword" type="password" id="password" placeholder="Password*" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                    </div>
                    <label for="show-password" class="show"><input name="show" type="checkbox" id="show-password">Show Password</label>

                    <p class="passwordCharacters">
                        Passwords should be a minimum of eight characters in length. 
                        Longer passwords are more secure, they should contain at least 1 
                        uppercase character, 1 number, and 1 special character
                    </p>

                    <div id="logInButton">
                        <button type="submit" class="logInButton">LOGIN</button>
                        <input type="hidden" name="action" value="Login">
                    </div>      

                    <div class="register-if-no-account">
                        <p class="registerNoAcc">No Account? <a class="sign" href="/phpmotors/accounts/?action=register">Sign Up</a> </p>
                    </div>

                </form>

            </div>
         
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    <script src="/phpmotors/scripts/index.js"></script>
    <script src="/phpmotors/scripts/showPassword.js"></script>
    <script src="/phpmotors/scripts/date-time.js"></script>

</body>
</html>