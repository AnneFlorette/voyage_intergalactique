<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleBooking.css">
    <title>Booking a trip</title>
</head>
<body>
    <section id="top">
        <div id="logo">    
            <a href="index.php"><img src="img/logo_blanc.png" alt="Logo of the Far Away Company"></a>
        </div>
        <nav>
            <ul>
                <a href="index.php"><li id="home">Home</li></a>
                <a href="ourDestinations.php"><li id="destination">Our Destinations</li></a>
                <a href="ourCompany.php"><li id="company">Our Company</li></a>
                <a href="logInSignUp.php"><li id="log">Log In/Sign Up</li></a>
            </ul>
        </nav>
    </section>
    <h1>Welcome aboard !</h1>
    <section id="content">
        
        <div id="resume">
            <h3>Name of the planet</h3>
            <br>
            <div id="tripResume">Trip's resume</div>
            <div id="tripInfo"> availables places <br> date of trip</div>
            <div id="opinion">User's Opinion</div>
        </div>
        <div id="booking">
            <h3>Book a trip</h3>
            <br>
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
                    <option value="tripID"> Date of the trip in database </option>
                </select>
                <br>
                <input id="submit" type="submit" value="Book This Trip">
            </form>
        </div>
    </section>
    
</body>
</html>