<div id="headerWrap">
    <a href="http://localhost/phpmotors/" title="View the PHP Motors Home Page">
        <img src="/phpmotors/images/site/logo.png" alt="logo-image" id="logo">
    </a>
    
    <div class="accWrap">

        <?php 
            if($_SESSION['loggedin']) {
                echo "<a class='welcome' href='/phpmotors/accounts/index.php/?action=none' title='Back to Admin view'>".$_SESSION['clientData']['clientFirstname']." </a> <span class='pipe'> | </span>";
            }
        ?>

        <?php 
            if($_SESSION['loggedin']) {
                echo "<a class='log-out' href='/phpmotors/accounts/?action=logout' title='Logout from PHP Motors'>Log out</a>";
            } else {
                echo "<a class='acc' href='/phpmotors/accounts/?action=login' title='Login or Register with PHP Motors'>My Account</a>";
            }
        ?>
        
    </div>

</div>