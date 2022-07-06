<?php 

session_start();

require_once "connect.php"; //wyciągnięcie danych z connect.php

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name); 

if ($polaczenie->connect_errno!=0) {
    echo 'Błąd, nie działa połączenie z Bazą !'.$polaczenie->connect_errno;
}
else {

    $login = $_POST['login']; // pobranie loginu z formularza na stronie logowania 
    $haslo = $_POST['haslo'];

  
    $sql = "SELECT * FROM users WHERE login='$login' AND haslo='$haslo'"; //pobranie danych z bazy i przyrównanie do $login i $haslo

    $rezultat = $polaczenie->query($sql); // wysłanie zapytania ze zmiennej $sql

    $ile_userow= $rezultat->num_rows; // ile rekordów wróciło z bazy 0 = brak danych 1= są dane
    
    if ($ile_userow == 1) {   // if do sprawdznia czy jest w bazie :) 

        $_SESSION['zalogowany']= true; // zmienna która będzie trzymać true albo false czy jest ktos zalogowany.

        $wiersz = $rezultat -> fetch_assoc();  //wrzuca dane z tabeli do $wiersz

        $_SESSION['login']=$wiersz['login']; //session przeżuca między stronami zmienne

        $rezultat->free_result();  // czysczenie zmiennej 

        header('location:strglw.php'); // przeniesienie na stronę 
        unset($_SESSION['zly_login']); // jakuda sie zalogowac to usuwa zmienna bo po co ma siedziec w pamieci
    }

    else {
        header('location:index.php');
        $_SESSION['zly_login']='Błędne Dane Logowania!';
    }
    


    $polaczenie->close(); // zamkniecie połaczenia 
};



?>

