<?php
    include 'functionsAdmin.php';
    session_start();


//création nouvelle destination
    if ((isset($_POST['destination']) && $_POST['destination'] != "") &&
        (isset($_POST['img_url']) && $_POST['img_url'] != "") &&
        (isset($_POST['description']) && $_POST['description'] != "")){
            $destination = htmlspecialchars($_POST['destination']);
            $img = 'img/'.htmlspecialchars($_POST['img_url']);
            $description = htmlspecialchars($_POST['description']);
            createDestination($destination, $img, $description);
        }

//création nouveau voyage
        if ((isset($_POST['destinations']) && $_POST['destinations'] != "") &&
            (isset($_POST['depart_date']) && $_POST['depart_date'] != "") &&
            (isset($_POST['total_time']) && $_POST['total_time'] != "") &&
            (isset($_POST['total_places']) && $_POST['total_places'] != "") &&
            (isset($_POST['spaceship_type']) && $_POST['spaceship_type'] != "")){
                $destinationID = htmlspecialchars($_POST['destinations']);
                $departDate = htmlspecialchars($_POST['depart_date']);
                $totalPlaces = htmlspecialchars($_POST['total_places']);
                $spaceshipType = htmlspecialchars($_POST['spaceship_type']);
                $totalTime = htmlspecialchars($_POST['total_time']);
                createTravel($destinationID, $departDate, $totalTime, $totalPlaces, $spaceshipType);
            }
//affichage de différentes stats

//gestion des utilisateurs

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="createDestination">
        <form action="" method="POST">
            <h3>Create a new destination</h3>
            <label for="destination">Name of the destination</label>
            <br>
            <input type="text" name="destination" class="input" autofocus max="40" required>
            <br>
            <label for="img_url">Url of the image</label>
            <br>
            <input type="file" name="img_url" class="input" max="40" required>
            <br>
            <label for="description">Description of the destination</label>
            <br>
            <textarea rows="8" cols="70" name="description" class="textarea" maxlength="500" required></textarea>
            <br>
            <input type="submit" value="Envoyer">
            <br>
        </form>
    </div>
    <div>
        <form action="" method="POST">
            <h3>Create a new trip</h3>
            <label for="destinations">Name of the destination</label>
            <br>
            <select name="destinations" id="destinationSelect">
                <?php
                    createOption();
                ?>
            </select>
            <br>
            <label for="depart_date">Date of departure</label>
            <br>
            <input type="date" name="depart_date" class="input" required>
            <br>
            <label for="total_time">Time of the travel</label>
            <br>
            <input type="number" name="total_time" required>
            <br>
            <label for="total_places">Total places aboard</label>
            <br>
            <input type="number" name="total_places" class="input" required>
            <br>
            <label for="spaceship_type">Spaceship type</label>
            <br>
            <input type="text" name="spaceship_type" class="input" max="25" required>
            <br>
            <input type="submit" value="Envoyer">
            <br>
        </form>  
    </div>
</body>
</html>