<?php 

function ZapytanieBazy($zapytanie) {
    $host='localhost';
    $db_user='root';
    $db_password= '';
    $db_name='komis';



    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name); 
    $rezultat = $polaczenie->query($zapytanie);

    return $rezultat;
}




?>











