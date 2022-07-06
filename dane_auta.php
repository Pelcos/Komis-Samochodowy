<?php
session_start(); 

if (!isset($_SESSION['zalogowany'])) {   /// jak nie zalogowany to nie przenosi do str glw 
    header("location:index.php");
}

if (!isset($_SESSION['puste_pole'])) {
    $_SESSION['puste_pole'] = '';
}
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div id="trzymacz">
        <div id="menu">
        <br> <br>
          <?php echo 'Witaj, jesteś zalogowany jako: <br> <b>'.$_SESSION['login']."</b>";?>
           

          <br>
          <br>
         <p class="nabuton">
          <a href="dodaj_auto.php"><button class="buttonmenu"> Dodaj do bazy</button></a> <br>
          <a href="do_kiedy_oc.php"><button class="buttonmenu"> Do kiedy oc</button></a><br>
          <a href="strglw.php"><button class="buttonmenu"> Lista samochodów</button></a>
        <br>
            
                        <?php

                echo '<form ENCTYPE = "multipart/form-data" action="" method="post" >
                <input type="text" name="szuk"> 
                <br>
                <center> <button type="submit" value="submit" name="wyszukaj" class="buttonmenu"> Wyszukaj </button> </center>

                </form> ';

                if (isset($_POST['wyszukaj'])) {
                $wyszukaj=$_POST['szuk'];
                header("location: dane_auta.php?numer_auta=$wyszukaj",  true,  301 );  exit;
                echo $wyszukaj;
                }
                else {}

                ?>


<a href="nie_zgloszone.php" id="nie_zgloszone"> Czy wszytkie pojazdy są zgłoszone? </a>


<br><br><br><br><br><br><a href="logout.php"><button class="buttonmenu">Wyloguj</button></a> </p>
        
     
        
        
        </p>

    


        </div>
        <div id="tresc"> 
          
    <br> <br>
    <?php 
   


   $id = $_GET['numer_auta'];
   
   $_SESSION['numer_auta'] = $id;

   require_once "connect.php"; //wyciągnięcie danych z connect.php

   $numer_rejestracyjny=$_SESSION['numer_auta'];
   echo $id."<br><br><br>";


   require("funkcje.php");
   $zapytanie = "SELECT * FROM `tabela_samochody` WHERE numer_rejestracyjny='$numer_rejestracyjny' ";
   
   $rezultat = ZapytanieBazy($zapytanie);
   
   $wiersz = $rezultat ->fetch_assoc(); 

   echo "Numer auta w bazie: ".$wiersz['id']."<br>".
   "Numer rejestracyjny samochodu: ".$numer_rejestracyjny."<br>".
   "Marka samochodu: ".$wiersz['marka_auta']."<br>".
   "Model samochodu: ".$wiersz['model']."<br>".
   "samochod kupiony: ".$wiersz['kiedy_kupiony']."<br>".
   "OC samochodu do: ".$wiersz['oc_samochodu']."<br>".
   "Kupiony od: ".$wiersz['od_kogo_kupiony']."<br>".
   "Numer telefonu do byłego własciciela: ".$wiersz['nr_tel']."<br><br>".
   "Status zgłoszenia zakupu: ";
   
   if ($wiersz['czy_zgloszone_kupno'] == 0) 
   {echo 'Zakup nie zgloszony !!! <br> <br>';
    echo 'zgłoś kupno: <br><br> ';

    echo '
       
    <form action="" method="post" enctype="multipart/form-data">  

    <input type="checkbox" name="czy_zgloszone_kupno"> 

    <input type="submit" value="Zgłoś!" name="przeslij">

    </form>';
    if(isset($_POST['przeslij'])) {  
    
        require_once("funkcje.php");

        $zapytanie = "UPDATE `tabela_samochody` SET `czy_zgloszone_kupno` = '1' WHERE `tabela_samochody`.`numer_rejestracyjny` = '$numer_rejestracyjny'";

        $rezultat = ZapytanieBazy($zapytanie);
        
      }
    }

   else {echo ' zgłoszone kupno.<br> <br>';};

   
  
   echo "Zdjęcie auta: <br><img src='samochody/$numer_rejestracyjny/$numer_rejestracyjny.jpg' width='30%' height='35%' /><br>";
    
    
    
    // umowy k-s auta

 
    $lokalizacja_umowa_ks = "samochody/$numer_rejestracyjny/umowa_ks_$numer_rejestracyjny.jpg";
    if (isset($_FILES["umowa_ks"])){
    move_uploaded_file($_FILES["umowa_ks"]["tmp_name"], $lokalizacja_umowa_ks);
    }
    else {};


    echo "<form ENCTYPE = 'multipart/form-data' action='dane_auta.php?numer_auta=$numer_rejestracyjny' method='post' >
    
    Dodaj umowę kupna-sprzedaży:<br>
    <input type='file' name='umowa_ks' /> 
    <br><br> 

    <input type='submit' > <button> <a href='strglw.php'> Powrót </a></button> 
    <br><br>" ;


?>

 


               
</div>





</div>

</body>  
</html>