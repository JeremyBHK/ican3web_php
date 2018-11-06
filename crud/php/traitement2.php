<?php

include('./includes/connexion.inc.php');

if (isset($_POST['inscription']))
{
   $nom    = trim($_POST['nom']);
   $prenom = trim($_POST['prenom']);
   $email  = trim($_POST['email']);

   $request = $connexion->prepare("INSERT INTO crud_table (nom, prenom, mail) VALUES (:paramNom, :paramPrenom, :paramEmail)");

   $request->bindParam(':paramNom', $nom);
   $request->bindParam(':paramPrenom', $prenom);
   $request->bindParam(':paramEmail', $email);

   if($request->execute())
   {
      header('Location: liste.php');
   }
   else
   {
      header('Location: 404.php');
   }
}

?>