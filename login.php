<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
  <?php
    if(isset($_GET['error']) && $_GET['error'] === '1') {
        echo "<div style='background-color: red; font-weight: bold; text-align: center;'>Login ou mot de passe incorrect</div>";
    }
  ?>

    <form action="check_login.php" method="POST">
      <div>
        <label for="username">Identifiant</label>
        <input type="text" name="username" required>
      </div>
      <div>
        <label for="password">Mot de passe </label>
        <input type="password" name="password" required>
      </div>
      <div>
        <button type="submit" name="button">Se connecter</button>
      </div>
    </form>
  </body>
</html>
