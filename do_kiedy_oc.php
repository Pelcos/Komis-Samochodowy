<?php
 session_start();

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
              
 
    Samochody którym kończy się ubezpieczenie: <br><br>
    <?php 

        require("funkcje.php");

        

        /* require_once "connect.php"; //wyciągnięcie danych z connect.php

        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name); 
        $zapytanie = "SELECT * FROM `tabela_samochody` ORDER BY `oc_samochodu` ASC";
        $rezultat = $polaczenie->query($zapytanie);
        */

        //$wiersz = $rezultat -> fetch_assoc();
        
        $zapytanie = "SELECT * FROM `tabela_samochody` ORDER BY `oc_samochodu` ASC";
        $rezultat=ZapytanieBazy($zapytanie);

    


        echo '<table> 
        <tr>
        <th>ID</th>
        <th>Marka</th>
        <th>Numer rej</th>
        <th>model</th>
        <th>oc</th>
        <th>kiedy kupiny</th>
        </tr>';
        
        
        while($wiersz =$rezultat->fetch_assoc()) {

            
            echo '<tr>';
            echo '<td>'.$wiersz['id'].'</td>';
            echo '<td>'.$wiersz['marka_auta'].'</td>';
            echo '<td>'.$wiersz['numer_rejestracyjny'].'</td> ';
            echo '<td>'.$wiersz['model'].'</td>';
            echo '<td><b> <font color="red">'.$wiersz['oc_samochodu'].'</font></b></td>';
            echo '<td>'.$wiersz['kiedy_kupiony'].'</td>';
            echo '</tr>';
        }
        echo '</table>';

       // foreach ($wiersz as $oc) {          
      //      echo $oc.' '; 
     //   };

        
    ?> 
       
       
    </div>





</div>

</body>  
</html