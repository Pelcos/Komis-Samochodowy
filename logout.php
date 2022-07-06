<?php
session_start();

session_unset(); // usuwa wszystkie zmienne związane z sesją 

header("location:index.php");


?>