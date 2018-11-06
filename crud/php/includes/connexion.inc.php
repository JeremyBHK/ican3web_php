<?php
  define('SERVER', 'localhost:8889');
  define('DB', 'crud_yoann');
  define('USER', 'root');
  define('PWD', 'root');

  $connexion = new PDO('mysql:host='.SERVER.';dbname='.DB,USER,PWD);
?>
