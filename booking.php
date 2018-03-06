<?php 
    include 'functions.php';
    session_start();
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
    <body <?php getImageDestinations(getIDDestination()); ?>>
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
                <h3><?php echo getTripName(getIDDestination()) ?></h3>
                <div id="tripResume">
                    <h4>Trip's description</h4>
                    <p><?php echo getTripDescription(getIDDestination()) ?></p>
                </div>
                <div id="tripInfo">
                    <table>
                    <tr>
                    <th>travel's ID</th>
                    <th>Date</th>
                    <th>Available Places</th>
                    <th>Travel's time</th>
                    </tr>
                    <?php getNextTrip(getIDDestination());?>
                    </table>
                </div>
            </div>
            <div id="booking">
                <h3>Book a trip</h3>
                <form action="" method="POST">
                    <label for="nbAdults">Number of adults : </label>
                    <br>
                    <input type="number" name="nbAdults" required>
                    <br>           
                    <label for="nbChildren">Number of children : </label>
                    <br>
                    <input type="number" name="nbChildren" required>
                    <br>
                    <label for="tripChose">Chose your trip : </label>
                    <br>
                    <select name="tripDate" id="tripDate" required> 
                        <?php getTripOptions(getIDDestination()); ?>
                    </select>
                    <br>
                    <input id="submit" type="submit" value="Book This Trip">
                </form>
            </div>
        </section>
        
    </body>
</html>