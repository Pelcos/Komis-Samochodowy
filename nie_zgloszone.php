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
                            require_once('funkcje.php');
                            $zapytanie = "SELECT `marka_auta`, `numer_rejestracyjny`, `czy_zgloszone_kupno` ,`kiedy_kupiony`  FROM `tabela_samochody` ORDER BY `kiedy_kupiony` DESC";
                            $rezultat=ZapytanieBazy($zapytanie);

                        


                            echo '<table> 
                            <tr>
                            <th>Marka</th>
                            <th>Numer rej</th>
                            <th>kiedy kupiny</th>
                            <th> Czy zgłoszony ? </th>
                            </tr>';
                            
                            
                            while($wiersz =$rezultat->fetch_assoc()) {

                                
                                echo '<tr>';
                                echo '<td>'.$wiersz['marka_auta'].'</td>';
                                $wiersz1=$wiersz['numer_rejestracyjny'];
                                echo $wiersz1;
                                echo "<td><a href=dane_auta.php?numer_auta=$wiersz1 />$wiersz1</a></td> ";
                                echo '<td>'.$wiersz['kiedy_kupiony'].'</td>';
                                echo '<td>';
                                        if ($wiersz['czy_zgloszone_kupno'] == 0 ) {
                                            echo '<font style="color:red;"> Pojazd nie został zgłoszony !!!!</font?' ; 
                                        }
                                        else {echo 'Pojazd został zgłoszony';}
                                echo '</td>';
                                

                                echo '</tr>';
                            }
                            echo '</table>';
              ?>
               
                                  

               
            </div>


                

        </div>

    </body>  
</html>