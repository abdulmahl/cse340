<?php
    //* numeric array or indexed array;
    //* uses numeric values as keys to access values from the array.
    $cars = ['Subaru', 'Lexus', 'Benz'];

    //* Associative array, uses strings as keys to allow us to access values
    //* from the array.
    $cookies = ['brown' => 'Choc-chip', 'red' => 'Cranberry-chip', 'dark' => 'Double-choc-chip']; 

    $newArray = [$cars, $cookies];

    $olistCars = '<ol>';
    foreach($cars as $car) {
        $olistCars .= "<li>$car</li>";
    }
    $olistCars .= '</ol>';

    echo $cars[1];
    echo $olistCars;

    $olistCookies = '<ol>';
    foreach($cookies as $cookie) {
        $olistCookies .= "<li>$cookie</li>";
    }
    $olistCookies .= '</ol>';

    echo $cookies['dark'];
    echo($olistCookies);

    //* Display the contents of the $newArray
    //* using a nested foreach loop.
    $newList = '<ul>';
    foreach($newArray as $key => $subArray) {
        $newList .= "<li>Array: $key";
        $newList .= '<ol>';
        foreach($subArray as $element) {
            $newList .= "<li>$element</li>";
        }
        $newList .= '</ol>';
        $newList .= '</li>';
    }
    $newList .= '</ul>';

    echo $newList;


    //* create a new array this one method.
    $northAmerica[] = 'Canada'; 
    $northAmerica[] = 'United States'; 
    $northAmerica[] = 'Mexico';

    //* This is another method of creating an array.
    $northAmerica = array( /* Array contents go here...*/ );

    //* This is another method of creating an array.
    $northAmerica = [ /* Array contents go here...*/ ];

    $newAmerica = '<ul>';
    foreach($northAmerica as $america) {
        $newAmerica .= "<li>$america</li>";
    }
    $newAmerica .= '</ul>';

    echo($newAmerica);

?>