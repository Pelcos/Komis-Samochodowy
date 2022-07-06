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
              

<form ENCTYPE = "multipart/form-data" action="dodanie_do_bazy_auta.php" method="post" >
    
    Podaj Markę Samochodu który chcesz wprowadzić do bazy:
    <input type="text" name="marka_auta">
    <br>     <br>
    Podaj numer rejestracyjny auta które chcesz wprowadzić do bazy:
    <input type="text" name="numer_rejestracyjny"> 
    <br><br>
    Wprowadź model samochodu:
    <input type="text" name="model"> 
    <br><br>
    Podaj do kiedy jesty ważne OC samochodu:
    <input type="date" name="oc_samochodu"> 
    <br><br> 
    Podaj Kiedy kupiony samochód:
    <input type="date" name="kiedy_kupiony"> 
    <br><br>    
    Podaj od kogo kupiony samochód (Imie i nazwisko):
    <input type="text" name="od_kogo_kupiony"> 
    <br><br>
    Podaj numer telefonu osoby od której zakupione auto:
    <input type="number" name="nr_tel"> 
    <br><br>
    Dodaj Zdjęcie samochodu:<br>
    <input type="file" name="zdj_auta" /> 
    <br><br> 

    

    <input type="submit" id="dodaj_do_bazy" value="Dodaj Do bazy!"> <button><a href="strglw.php">Powrót</a></button>
<br><br>

    <br> <br>
    <?php echo $_SESSION['puste_pole']  ?>

</form>

     

               
</div>





</div>

</body>  
</html>