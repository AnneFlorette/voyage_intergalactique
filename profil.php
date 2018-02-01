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
        <div>    
            <img src="" alt="Logo of the Far Away Company">
        </div>
        <!-- Menu à droite -->
        <nav>
            <ul>
                <a href="index.php"><li id="home">Home</li></a>
                <a href="ourdestinations.php"><li id="destination">Our destinations</li></a>
                <a href="ourcompany.php"><li id="log">Our company</li></a>
            </ul>
        </nav>
        <!-- Message de bienvenue à l'utilisateur (avec son $first_name) -->
        <div>
            <h3>Bienvenue <?php ?> ! </h3>
        </div>
    </section>

    <section id="informations">
        <div>
            <!-- <h5>Mettre le nom de l'utilisateur</h5> -->
            <!-- Possiblité de changer les informations dans cette div -->
        </div>
    </section>
    <section id="myTrip">
        <div id="futureTrip"></div>
        <div id="pastTrip"></div>
    </section>

</body>
</html>