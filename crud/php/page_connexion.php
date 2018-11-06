<?php
  session_start();
  include('./includes/connexion.inc.php');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page de connexion</title>
  </head>
  <body>
    <?php
      if(isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['password']) && $_POST['password'] != "") {
        $mail = trim($_POST['email']);
        $pwd = trim($_POST['password']);
        $pwd = hash("SHA256", $pwd);

        $request = "SELECT * FROM crud_table WHERE mail = '".$mail."' AND password = '".$pwd."'";
        foreach  ($connexion->query($request) as $row){
          $_SESSION['mail'] = $mail;
          echo "Connexion réussie.";
        }
      }
    ?>
    <p>Veuillez vous connecter</p>
    <form action="page_connexion.php" method="POST">
      <p><input type="email" name="email" id="email" placeholder="Adresse mail"></p>
      <p><input type="password" name="password" id="password" placeholder="Mot de passe"></p>
      <p><input type="submit" value="Connexion" id="connexion"></p>
    </form>
  </body>
</html>
