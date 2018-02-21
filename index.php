<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <link rel="stylesheet" type="text/css" href="css/styleIndex.css">
    <title>Far Away</title>
</head>
<body>
    <nav>
        <ul>
            <a href="logInSignUp.php"><li id="log">Log In/Sign Up</li></a>
        </ul>
    </nav>
    <div id="titleBox">
        <h1>Far Away</h1>
        <p id="caption">Go deeper in Space</p>
    </div>
    <div id="buttonBox">
        <a href="ourDestinations.php"><button id="discoverTrip">Our Destinations</button></a>
        <a href="ourCompany.php"><button id="ourCompany">Our Company</button></a>
    </div>
    
</body>
</html>