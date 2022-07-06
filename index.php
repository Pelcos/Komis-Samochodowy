<?php session_start(); 

if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true) {   /// jak zalogowany to przenosi do strglw

  header("Location:strglw.php");  
}


?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styl_login.css">
  </head>
  <body>
    <div id="login">
  <?php 
  if (isset($_SESSION['zly_login'])) {    // pokaże zawarotśc zmiennej JESLI TAKA INSTNIEJE, jesli nie to do elsa.
    $_SESSION['zly_login'];
  }
  
  ?>
        <div id="userpass">
          <span color="red" size="15">
           
            <?php 
              if (isset($_SESSION['zly_login'])) {   // jak istnieje zmienna to wyświetl, jak nie instnieje to nie :) 
                echo $_SESSION['zly_login']; 
              }
           
            ?>

          <form action="login.php" method="post">
            <input type="text" name="login"> Login
            <br>     <br>
            <input type="password" name="haslo"> Hasło
            <br><br>

           <input type="submit" id="zaloguj" value="Zaloguj">
           </form>
        </div>

   


    </div>
    

  </body>  
  </html>