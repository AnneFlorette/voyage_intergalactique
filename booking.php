<?php 
    include 'functions.php';
    session_start();

//Si le $_GET est vide (donc pas destination choisi)
//redirection vers les destinations
    if(checkGet()){
        header('location: ourDestinations.php');
    }


//vérification que les places sont disponible et renvoi vers la page approprié suivant
    if(isset($_POST['nbAdults']) && isset($_POST['nbChildren']) && isset($_POST['tripDate'])){
        $travelID = htmlspecialchars($_POST['tripDate']);
        $nbPlaces = htmlspecialchars($_POST['nbAdults']) + htmlspecialchars($_POST['nbChildren']);

        $available = areAvailable($nbPlaces, $travelID);

        if($available){
        $_SESSION['nbAdults'] = htmlspecialchars($_POST['nbAdults']);
        $_SESSION['nbChildren'] = htmlspecialchars($_POST['nbChildren']);
        $_SESSION['travelID'] = htmlspecialchars($_POST['tripDate']);
        header('location: validatePayment.php');
        }
        // petitrobot : nombre de places non disponible 
    }

    if(isset($_POST['connexion']) && $_POST['connexion'] == "Connexion"){
        header('location: logInSignUp.php');
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/styleBooking.css">
        <title>Booking a trip</title>
    </head>
    <body <?php getImageDestinations(getDestinationIDByURL()); ?>>
        <section id="top">
            <div id="logo">    
                <a href="index.php"><img src="img/logo_blanc.png" alt="Logo of the Far Away Company"></a>
            </div>
            <?php
                changeNav();
            ?>
        </section>
        <h1>Welcome aboard !</h1>
        <section id="content">
            
            <div id="resume">
                <h3><?php echo getTripName(getDestinationIDByURL()) ?></h3>
                <div id="tripResume">
                    <h4>Trip's description</h4>
                    <p><?php echo getTripDescription(getDestinationIDByURL()) ?></p>
                </div>
                <div id="tripInfo">
                    <table>
                    <tr>
                    <th>Travel's ID</th>
                    <th>Date</th>
                    <th>Available Places</th>
                    <th>Travel's time</th>
                    <th>Adult price</th>
                    <th>Child price</th>
                    </tr>
                    <?php getNextTrip(getDestinationIDByURL());?>
                    </table>
                </div>
            </div>
            <div id="booking">
                <h3>Book a trip</h3>
                <div id="bookingDiv">
                    <form action="" method="POST">
                        <label for="nbAdults">Number of adults : </label>
                        <br>
                        <input type="number" name="nbAdults" min="0" required>
                        <br>           
                        <label for="nbChildren">Number of children : </label>
                        <br>
                        <input type="number" name="nbChildren" min="0" required>
                        <br>
                        <label for="tripChose">Chose your trip : </label>
                        <br>
                        <select name="tripDate" id="tripDate" required> 
                            <?php getTripOptions(getDestinationIDByURL()); ?>
                        </select>
                        <br>
                        <input id="submit" type="submit" value="Book This Trip">
                    </form>
                </div>
                <div id="connexionDiv">
                    <form action="" method="POST">
                        <input id="logIn" type="submit" name="connexion" value="Connexion">
                    </form>
                </div>
            </div>
        </section>
        
        <script>
            const bookingDiv = document.getElementById("bookingDiv")
            const connexionDiv = document.getElementById("connexionDiv")
        </script>

        <?php
            if(checkSession()){
                echo '<script>bookingDiv.style.display = "block";
                            connexionDiv.style.display = "none";
                    </script>';
            }
        ?>

    </body>
</html>