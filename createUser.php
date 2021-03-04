<?php
require_once "include.php";
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/basics.css">
    <title>Randonnées, ajout</title>
</head>
<body>

<?php
if(isset($_GET['post']) && $_GET['post'] == 1) {
    if(isset($_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['mail'])) {

        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim(password_hash($_POST['password'], PASSWORD_BCRYPT)));
        $firstname = strip_tags(trim($_POST['firstname']));
        $lastname = strip_tags(trim($_POST['lastname']));
        $mail = strip_tags(trim($_POST['mail']));

        $search = $db->prepare("
                            INSERT INTO user (username, password, firstname, lastname, email) 
                            VALUES (:username, :password, :firstname, :lastname, :mail)
                            ");
        $search->bindParam(':username', $username);
        $search->bindParam(':password', $password);
        $search->bindParam(':firstname', $firstname);
        $search->bindParam(':lastname', $lastname);
        $search->bindParam(':mail', $mail);

        if($search->execute()) {
            header("location: read.php?post=create");
        }
        else {
            header("location: createUser.php?post=notOk");
        }
    }
}

if (isset($_GET['post']) && $_GET['post'] == "notOk" ) {
    echo "<div style='background-color: red; font-weight: bold; text-align: center;'>Echec de la création de votre compte, le login ou l'email sont déjà pris!</div>";
}
?>

    <form action="createUser.php?post=1" method="POST">
        <div>
            <label for="username">Nom d'utilisateur</label>
            <label for="password">Mot de passe</label>
            <label for="firstname">Prénom</label>
            <label for="lastname">Nom</label>
            <label for="mail">Email</label>
        </div>

        <div>
            <input type="text" name="username" id="username" required>
            <input type="password" name="password" id="password" required>
            <input type="text" name="firstname" id="firstname" required>
            <input type="text" name="lastname" id="lastname" required>
            <input type="email" name="mail" id="mail" required>
            <input type="submit">
        </div>
    </form>

    <form action="read.php" method="POST">
            <input type="submit" value="Annuler">
    </form>
</body>
</html>