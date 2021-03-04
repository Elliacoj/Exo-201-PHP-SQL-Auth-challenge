<?php
require_once "include.php";

if(isset($_SESSION['pseudo'], $_SESSION['password'])) { ?>

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
        if(isset($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'])) {

            $name = strip_tags(trim($_POST['name']));
            $difficulty = $_POST['difficulty'];
            $distance = $_POST['distance'];
            $duration = $_POST['duration'] . ":00";
            $heightDifference = $_POST['height_difference'];
            $available = $_POST['available'];

            $search = $db->prepare("
                                INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) 
                                VALUES (:name, :difficulty, :distance, :duration, :heightDifference, :available)
                                ");
            $search->bindParam(':name', $name);
            $search->bindParam(':difficulty', $difficulty);
            $search->bindParam(':distance', $distance);
            $search->bindParam(':duration', $duration);
            $search->bindParam(':heightDifference', $heightDifference);
            $search->bindParam(':available', $available);

            if($search->execute()) {
                header("location: read.php?post=ok");
            }
            else {
                header("location: create.php?post=notOk");
            }
        }

    }

    if (isset($_GET['post']) && $_GET['post'] == "notOk" ) {
        echo "<div style='background-color: red; font-weight: bold; text-align: center;'>Echec de la mise à jour</div>";
    }
?>

    <form action="create.php?post=1" method="POST">
        <div>
            <label for="name">Nom de la randonnée</label>
            <label for="difficulty">Difficultée</label>
            <label for="distance">Distance</label>
            <label for="duration">Durée</label>
            <label for="height_difference">Dénivelé</label>
            <label for="available">Disponible</label>
        </div>

        <div>
            <input type="text" name="name" placeholder="Nom de la randonnée" id="name" required>
            <select name="difficulty" id="difficulty" required>
                <option value="très facile">Très facile</option>
                <option value="facile">Facile</option>
                <option value="moyen">Moyen</option>
                <option value="difficile">Difficile</option>
                <option value="très difficile">Très difficile</option>
            </select>
            <input type="number" name="distance" id="distance" required step=".01"">
            <input type="time" name="duration" id="duration" required>
            <input type="number" name="height_difference" id="height_difference" required step=".01">
            <select name="available" id="available" required>
                <option value="Ok">Ok</option>
                <option value="notOk">Not ok</option>
            </select>
            <input type="submit">
        </div>
    </form>

    <form action="read.php" method="POST">
        <input type="submit" value="Annuler">
    </form>
</body>
</html>

<?php
}
else {
    header("location: login.php");
}