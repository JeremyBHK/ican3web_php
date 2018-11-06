<?php
  $bdd = 'crud_yoann';
  $user = 'root';
  $pwd = 'root';

  try{
    $bdd = new PDO('mysql:host=localhost:8889;dbname='.$bdd,$user,$pwd);
  }
  catch(Exception $e){
    /* variable $e qui récupère une exception dans laquelle on envoie un message php */
    die('Erreur connexion : '. $e->getMessage());
  }
?>
