<?php
    //? This function will check the value of the $clientEmail
    //? variable after it is sanitized, to check if the email
    //? passed looks valid.
    function checkEmail($clientEmail) {
        //? This function will return one of two values
        //? the first will be the actual email address if the 
        //? value is judged "valid", and two returns NULL if the
        //? email address is judged as "invalid".
        $validEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $validEmail;
    }

    //? this function will perform the same check as for the checkEmail 
    //? function, only for the password.
    function checkPassword($clientPassword) {
        //? Check the password for a minimum of 8 characters,
        //? at least one 1 capital letter, 1 number and
        //? 1 special character.
        $pattern  = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }
?>