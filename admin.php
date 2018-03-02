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
//affichage des 10 prochains vols

// Suppression du compte
    if(isset($_POST['delete']) && $_POST['delete'] != ""){
        $ID = htmlspecialchars($_POST['delete']);
        deleteAccount($ID);
        echo'<meta http-equiv="refresh" content="0; URL=admin.php">';
    } else if(isset($_POST['notDelete'])) {
        echo "<script>popUp.style.display = 'none'</script>";
    }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            <input type="submit" value="Send">
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
            <br>
            <input type="submit" value="Send">
            <br>
        </form>  
    </div>
    <div>
        <form action="" method="POST">
            <h3>Search a user</h3>
                <label for="search">Enter a user's last name</label>
                <br>
                <input type="text" name="search" class="input" max="40">
                <br>
                <br>
                <input type="submit" value="Send" id="sendUsers">
                <br>
        </form>
        <?php
            if(isset($_POST['search'])){
                $search = htmlspecialchars($_POST['search']);
                echo '<table id="table">';
                searchUsers($search);
                echo '</table>';
            }
        ?> 
    </div>
    <div id="popUp">
        <div class="popUp_block">
            <form action="" method="POST">
                <p>Warning ! You're about to delete an account. Are you sure ?</p>
                <button type="submit" id="yes" class="btnYesNo" name="delete" value="">YES</button>
                <button type="submit" class="btnYesNo" name="notDelete" value="">NO</button>
            </form>
        </div>
    </div>
    <script>
        const sendUsers = document.getElementById('sendUsers')
        const popUp = document.getElementById('popUp')
        const btnYes = document.getElementById('yes')
        let nbRow = 0

        function display() {
            let btnDeleteValue = document.getElementsByClassName('delete').value
            popUp.style.display = 'block'
            btnYes.value = btnDeleteValue
        }
        
        sendUsers.addEventListener('click', function() {
            nbRow = document.getElementById('table').rows.length
            return nbRow
        }, false)

        for(i = 0; i < nbRow; i++){
            document.getElementsByClassName('delete')[i].addEventListener('click', display, false)
        }
        

        
    </script>
</body>
</html>