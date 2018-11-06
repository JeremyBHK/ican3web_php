<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CRUD</title>
  </head>
  <body>
    <form action="traitement.php" method="post">
      <input type="text" name="nom" placeholder="nom" maxlength="200"><br>
      <input type="text" name="prenom" placeholder="prenom" maxlength="200"><br>
      <input type="email" name="email" placeholder="adresse mail" maxlength="200" id="email"><br>
      <input type="password" name="password" id="password" placeholder="Mot de passe"><br>
      <br>
      <input type="submit" name="inscription" value="Inscrivez-vous">
    </form>
  </body>
</html>
