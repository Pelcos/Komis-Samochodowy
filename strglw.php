<?php session_start(); 

if (!isset($_SESSION['zalogowany'])) {   /// jak nie zalogowany to nie przenosi do str glw 
  header("location:index.php");
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
          
              
              <?php   
           
       
              require("funkcje.php");

              $zapytanie = "SELECT * FROM `tabela_samochody` ORDER BY `oc_samochodu` ASC";

              // $zapytanie2 = "SELECT numer_rejestracyjny FROM `tabela_samochody` ORDER BY kiedy_kupiony DESC" ; 
              $rezultat = ZapytanieBazy($zapytanie);
              // $rezultat2 =ZapytanieBazy($zapytanie2);
              
                while($wiersz =$rezultat->fetch_assoc()) {
                  echo '<p class="lista">';
                  $numer_rejestracyjny= $wiersz['numer_rejestracyjny']; 
                  echo ' Id samochodu: '.$wiersz['id'].'<br> Marka samochodu: '.$wiersz['marka_auta'].'<br> ';
                  
                  
                  echo "Numer rejestracyjny: <a href='dane_auta.php?numer_auta=$numer_rejestracyjny'>$numer_rejestracyjny</a><br>"; 
                  
                  echo "<img id='zdj' src='samochody/$numer_rejestracyjny/$numer_rejestracyjny.jpg' > <br><br><br><BR><BR><BR><BR><BR><BR> ";  
                 
                
                  
                  
                  echo '</p>';
              } 
                  
            
              
              ?>
               
                                  

               
            </div>


                

        </div>

    </body>  
</html>