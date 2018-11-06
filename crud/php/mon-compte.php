<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mon compte</title>
  </head>
  <body>
    <?php
      if(isset($_SESSION['email'])){
        // la personne est connectée
        ?>

        <fieldset>
          <legend>Modification du compte</legend>
          <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $_SESSION['email']; ?>">
            <br>
            <input type="submit" name="modif" value="Modifier">
          </form>
        </fieldset>

        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
          <input type="submit" name="del" value="Supprimer">
        </form>

        <?php
          require_once 'correction_connexion.php';

          if (isset($_POST['modif'])) {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
              $modif = $bdd->prepare('UPDATE crud_table SET email = :email WHERE email = :ancien_email');
              $modif->execute(array(
                'email' => $_POST['email'],
                'ancien_email' => $_SESSION['email']
              ));

              if($modif->rowCount() > 0) {
                echo 'compte mis à jour';
                $_SESSION['email'] = $_POST['email'];
              }else{
                echo 'erreur modif email';
              }
            }else{
              echo 'erreur de syntaxe';
            }
          }

          if(isset($_POST['del'])) {
            $del = $bdd->prepare('DELETE FROM crud_table WHERE email = :email');
            $del->execute(array(
              'email' => $_SESSION['email']
            ));

            if($del->rowCount() > 0){
              // deconnexion
              ?>
              <script type="text/javascript">
                window.location.href = 'correction_connexion_inscription.php';
              </script>
              <?php
            }else{
              echo 'erreur de deconnexion';
            }
          }

          $users = $bdd->prepare('SELECT * FROM crud_table');
          $users->execute();
          ?>
          <table>
            <thead>
              <tr>
                <th>email</th>
                <th>date inscription</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while($user = $users->fetch()){
                  ?>
                  <tr>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['date_user']; ?></td>
                  </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
          <?php
      }
    ?>
  </body>

  <!--
    Vous devez gérez des droits

    Certains utilisateurs doivent être administrateurs et seuls eux doivent :
    - voir le tableau d'utilisateurs sur leur compte,
    
  -->
</html>
