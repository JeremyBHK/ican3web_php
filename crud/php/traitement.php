<?php
  include('./includes/connexion.inc.php');

  if (isset($_POST['inscription'])){
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $mail = trim($_POST['email']);
    $pwd = hash("SHA256", $_POST['password']);

    $requete = $connexion->prepare('INSERT INTO crud_table (nom,prenom,mail,password) VALUES (:paramNom,:paramPrenom,:paramEmail,:paramPassword)');

    $requete->bindParam(':paramNom', $nom);
    $requete->bindParam(':paramPrenom', $prenom);
    $requete->bindParam(':paramEmail', $mail);
    $requete->bindParam(':paramPassword', $pwd);

    if($requete->execute()){
      header('location:page_connexion.php');
    }else {
      header('location:404.php');
    }
  }
?>
