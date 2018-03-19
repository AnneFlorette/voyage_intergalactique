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
    <link rel="stylesheet" href="css/styleCompany.css">
    <link rel="stylesheet" href="css/styleOurTeam.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Our company</title>
</head>


<body>
    <script type="text/javascript" src="teamMate.js"></script>

    <section id="front">

        <?php 
            changeNav();
        ?>  

        <div id="titleBox">
            <a href="index.php"><h1>Far Away</h1></a>
            <p id="caption">Go deeper in Space</p>   
        </div>
            <img id="logo" src="img/logo_blanc.png" alt="Logo of the Far Away Company">
        <div id="scrollBox">
            <a href="#city"><button id="scroll"><i id="iconScroll" class="material-icons">keyboard_arrow_down</i></button></a>
        </div>
    </section>


    <section id="city">
        <div class="left">
            <h4>Our Headquarter</h4>
            <p id="intro"> 
                As you can see, we take care of every details to make everything incredible. Our headquarter is the most modern building ever created by humans. We're constantly in search of creative and innovative ideas.
            </p>
        </div>   
    </section>


    <section id="ship">
        <div class="left">
            <h4>Our space ship</h4>
            <p id= "intro"> 
                Our Space ship is equipped with the best innovative technologies in the galaxy. During your trip you will find everything you need because Far Away will provide you the comfort you deserve.
                <br>
                <br>
                We do our best to make sure that your journey will be incredible and unforgettable. Staff members will be at your disposal through the entire trip.
            </p>
        </div> 
    </section>

    <section id="ourTeam">
        <div class="left">
            <h4>Our team</h4>
            <p id= "intro">Click on us to learn more about us</p>
            <div id="teamMate"></div>
        </div>
        <div id="container">
            <ul class="wrapper">
                <div class="logo">
                    <div class="star"></div>
                </div>
                <div class="anneflo" onclick="testFunction('Anne Flore')">
                    <div class="text"><div class="name">Anne Flore</div></div>
                    <div class="planet"></div>
                </div>
                <div class="cyrille" onclick="testFunction('Cyrille')">
                <div class="text"><div class="name">Cyrille</div></div>
                    <div class="planet"></div>
                </div>
                <div class="hugo" onclick="testFunction('Hugo')">
                <div class="text"><div class="name">Hugo</div></div>
                    <div class="planet"></div>
                </div>
            </ul>
        </div>
    </section>

</body>
</html>