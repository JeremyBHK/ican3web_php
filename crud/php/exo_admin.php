<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion / Inscription</title>
  </head>
  <body>
    <fieldset>
      <legend>Inscription</legend>
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="">
        <br>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" value="">
        <br>
        <input type="submit" name="inscription" value="Inscription">
      </form>
    </fieldset>
    <fieldset>
      <legend>Connexion</legend>
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="">
        <br>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" value="">
        <br>
        <input type="submit" name="connexion" value="Connexion">
      </form>
    </fieldset>

    <?php
      require_once 'correction_connexion.php';
      // require / include = require bloque le traitement s'il ne trouve pas le fichier
      // require/include= require ne vas charger que le fichier que s'il en a besoin alors que le include fait comme un "copier/coller" du code appelé

      if(isset($_POST['inscription'])){
        // prepare-> permet d'échapper automatiquement les injections SQL sur un execute(array());
        $existe = $bdd->prepare('SELECT id FROM crud_table WHERE email = :email');
        $existe->execute(array(
          'email' => $_POST['email']
        ));

        $resulats = $existe->fetchAll();
        if(empty($resulats)){
          // test si le mail est ok
          if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            // insertion
            echo '1';
            $date = new DateTime('now');
            echo '2';

            $ajout = $bdd->prepare('INSERT INTO crud_table(email, mdp, date_user) VALUES(:e, :m, :i)');
            $ajout->execute(array(
              'e' => $_POST['email'],
              'm' => md5($_POST['mdp']),
              'i' => $date->format('Y-m-d H:i:s')
            ));

            $_SESSION['email'] = $_POST['email'];
            ?>
            <script type="text/javascript">
              window.location.href = 'mon-compte.php';
            </script>
            <?php
          }
          else{
            echo 'Mauvais mail';
          }
        }
        else{
          echo 'existe';
        }
      }

      if(isset($_REQUEST['connexion'])){
        $getuser = $bdd->prepare('SELECT id FROM crud_table WHERE email = :email AND mdp = :mdp AND role = :role');
        $getuser->execute(array(
          'email' => $_POST['email'],
          'mdp' => md5($_POST['mdp'])
        ));

        $user = $getuser->fetchAll();
        if(!empty($user)){
          // l'utilisateur existe et son mdp est bon
          $_SESSION['email'] = $_POST['email'];
          ?>
          <script type="text/javascript">
            window.location.href = 'mon-compte.php';
          </script>
          <?php
        }else{
          echo 'Mauvais email ou mdp';
        }
      }
    ?>
  </body>
</html>
