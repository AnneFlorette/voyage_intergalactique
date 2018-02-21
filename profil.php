<?php include('functions.php') ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleProfil.css">
    <title>Profil</title>
</head>
<body>
    <section id="top">
        <!-- Logo de la company -->
        <div id="logo">    
            <a href="index.php"><img src="img/logo_blanc.png" alt="Logo of the Far Away Company"></a>
        </div>
        <!-- Menu à droite -->
        <nav>
            <ul>
                <a href="index.php"><li id="home">Home</li></a>
                <a href="ourDestinations.php"><li id="destination">Our Destinations</li></a>
                <a href="ourCompany.php"><li id="log">Our Company</li></a>
            </ul>
        </nav>
        <!-- Message de bienvenue à l'utilisateur (avec son $first_name) -->
    </section>
    <div>
        <h3>Welcome <?php echo 'user' ?> ! </h3>
    </div>
    <section id="user">
        <div id="information">
            <h5>Mettre le nom de l'utilisateur</h5>
            <!-- Possiblité de changer les informations dans cette div -->
        </div>
    </section>
    <section id="myTrip">
        <div id="futureTrip">
            <h5>My Next Trips</h5>
        </div>
        <div id="pastTrip">
            <h5>My Old Trips</h5>
        </div>
    </section>

</body>
</html>