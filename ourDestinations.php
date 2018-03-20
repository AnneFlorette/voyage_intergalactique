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
    <link rel="stylesheet" type="text/css" href="css/styleDestinations.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Our Destinations</title>
</head>
<body>
    <section id="front"> 
        <?php 
            changeNav();
        ?>  
        <div id="titleBox">
            <a href="index.php"><h1>Far Away</h1></a>
            <p id="caption">Go deeper in Space</p>
        </div>
        <div id="welcomeBox">
            <p id="welcomeMsg"> 
                Welcome aboard ! You're going to start an incredible journey with the Far Away Company.
            </p>
        </div>
        <div id="scrollBox">
            <a href="#firstPlanete"><button id="scroll"><i id="iconScroll" class="material-icons">keyboard_arrow_down</i></button></a>
        </div>
    </section>
    <?php createSections(); ?>
</body>
</html>