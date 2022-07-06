<?php

//var_dump($_FILES);
//die();

session_start();
if (!isset($_SESSION['zalogowany'])) {   /// jak nie zalogowany to nie przenosi do str glw 
    header("location:index.php");
}

require_once "connect.php"; //wyciągnięcie danych z connect.php

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name); 



$marka_auta = $_POST['marka_auta'];
$numer_rejestracyjny = preg_replace('/\s+/', '', $_POST['numer_rejestracyjny']); // usuwa spacje 
$model=$_POST['model'];
$oc_samochodu=$_POST['oc_samochodu'];
$kiedy_kupiony=$_POST['kiedy_kupiony'];
$od_kogo_kupiony=$_POST['od_kogo_kupiony'];
$nr_tel=$_POST['nr_tel'];



if (!isset($_SESSION['puste_pole'])) {
    $_SESSION['puste_pole'] = '';
}

if (!empty($marka_auta) and !empty($kiedy_kupiony) and !empty($numer_rejestracyjny and !empty($model) and !empty($oc_samochodu) and !empty($kiedy_kupiony) and !empty($od_kogo_kupiony) and !empty($nr_tel) )) {
    $zapytanie = "INSERT INTO `tabela_samochody` (`id`, `marka_auta`, `numer_rejestracyjny`, `model`, `oc_samochodu`, `kiedy_kupiony`,`od_kogo_kupiony`, `nr_tel` ) VALUES (NULL, '$marka_auta', '$numer_rejestracyjny', '$model', '$oc_samochodu', '$kiedy_kupiony', '$od_kogo_kupiony', '$nr_tel');";
    $polaczenie->query($zapytanie); // wysłanie zapytania
    $_SESSION['puste_pole'] = 'Pomyślnie dodano auto do bazy.';

    $tworz_folder = mkdir("samochody/$numer_rejestracyjny", 0777);  // towrzenie folderu o zanwie nr rej
    echo $tworz_folder;

    

    // zdjecie auta
    $lokalizacja_zdjecie_auta = "samochody/$numer_rejestracyjny/$numer_rejestracyjny.jpg";
    move_uploaded_file($_FILES["zdj_auta"]["tmp_name"], $lokalizacja_zdjecie_auta);




}
else  {
    
    $_SESSION['puste_pole'] = 'Wprowadź dane we wszystkie pola !!';
}
header('location:dodaj_auto.php');




$polaczenie->close();
?>