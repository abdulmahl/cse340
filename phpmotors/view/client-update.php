<?php   
    if(!$_SESSION['loggedin']) {
        // header('Location: /phpmotors/index.php/');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Template">
    <title>Update Client Details &bull; PHP Motors</title>
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

            <h1 class="reg">Update Account Details</h1>

            <div class="note"> 
                <?php 
                    if(isset($message)) { 
                        echo $message;
                    }
                ?> 
            </div>

            <div class="registerFormWrap">
                <form action="/phpmotors/accounts/index.php" method="POST">

                    <h2 class="reg">Account Update</h2>
                   
                    <div class="registerNames__Field">
                        <label for="clientFirstName" class="clientnames">First Name: <input name="firstname" type="text" id="clientFirstName" placeholder="First Name*" <?php if(isset($firstname)) {echo "value='$firstname'";} elseif($_SESSION['clientData']['clientFirstname']) {echo "value='".$_SESSION['clienyData']['ClientFirstname']."'";} ?> required></label>
                        <label for="clientLastName" class="clientnames">Last Name: <input name="lastname" type="text" id="clientLastName" placeholder="Last Name*" <?php if(isset($lastname)) {echo "value='$lastname'";} elseif($_SESSION['clientData']['clientLastname']) {echo "value'".$_SESSION['clientData']['clientLastname']."'";} ?> required></label>
                        <label for="clientEmail" class="clientnames">Email: <input name="newEmail" type="email" id="clientEmail" placeholder="Email*" <?php if(isset($newEmail)) {echo "value='$newEmail'";} elseif($_SESSION['clientData']['clientEmail']) {echo "value'".$_SESSION['clientData']['clientEmail']."'";} ?> required></label>
                    </div>

                    <div id="regButton">
                        <button class="regButton">Update Details</button>
                        <input type="hidden" name="action" value="updateDetails">
                        <input type="hidden" name="invId" value="<?php if(isset($_SESSION['clientData']['clientId'])) {echo "value='".$_SESSION['clientData']['clientId']."'";} ?>">
                    </div>

                </form>

            </div>
            <br> <br>
            <div class="registerFormWrap">
                <form action="/phpmotors/accounts/index.php" method="POST">

                    <h2 class="reg">Change Password</h2>

                    <div class="createPassword__Field">
                        <label for="password" class="clientnames">New Password<input name="newPassword" type="password" id="password" placeholder="Password*" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                    </div>

                    <label for="show-password" class="show"><input name="show" type="checkbox" id="show-password" onclick="myFunction()">Show Password</label>
                    <p class="passwordCharacters">
                        Passwords should be a minimum of eight characters in length. 
                        Longer passwords are more secure, they should contain at least 1 
                        uppercase character, 1 number, and 1 special character
                    </p>

                    <br>

                    <div id="updateButton">
                        <button class="regButton">Update Password</button>
                        <input type="hidden" name="action" value="updatePassword">
                        <input type="hidden" name="invId" value="<?php if(isset($_SESSION['clientData']['clientId'])) {echo "value='".$_SESSION['clientData']['clientId']."'";} ?>">
                    </div>

                    <br>

                </form>
        
            </div>
            <br> <br>

        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>

    <script>
        function myFunction() {
          let x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>

    <script src="scripts/index.js"></script>
    <script src="/phpmotors/scripts/date-time.js"></script>

</body>
</html>