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
    <link rel="stylesheet" href="css/styleProfil.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            
    <title>Profil</title>
</head>
<body>
    <section id="top">
        <!-- Logo de la company -->
        <div id="logo">    
            <a href="index.php"><img src="img/logo_blanc.png" alt="Logo of the Far Away Company"></a>
        </div>
        <!-- Menu à droite -->
        <?php 
            changeNav();
        ?>
        <!-- Message de bienvenue à l'utilisateur (avec son $first_name) -->
    </section>
    <div>
        <h3>Welcome <?php echo getFirstName($_SESSION['ID']) ?> ! </h3>
    </div>
    <section id="user">
        <div id="information">
            <h4>Your personal details</h4>
                <p>First Name : <?php echo getFirstName($_SESSION['ID']) ?></p>
                <p>Last Name : <?php echo getLastName($_SESSION['ID']) ?></p>
                <p>Mail : <?php echo getMail($_SESSION['ID']) ?></p>
                <button id="btnPopUp">Modify informations</button>
                <!-- PopUp pour modifier les informations -->
                <div id="popUp">
                    <div class="popUp_block">
                        <button><i id="clear" class="material-icons">clear</i></button>
                        <label for="firstName">First Name</label>
                        <br>
                        <input type="text" name="firstName" class="input" autofocus required>
                        <br>
                        <label for="lastName">Last Name</label>
                        <br>
                        <input type="text" name="lastName" class="input" required>
                        <br>
                        <label for="mailSignUp">Email</label>
                        <br>
                        <input type="email" name="mailSignUp" class="input" required>
                        <br>
                        <input type="submit" value="Send Modifications">
                    </div>
                </div>
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

    <script>
        const btnPopUp = document.getElementById('btnPopUp').addEventListener('click', displayPopUp, false)
        const btnClear = document.getElementbyId('clear').addEventListener('click', clearPopUp, false)
        const popUp = document.getElementById('popUp')
        
        function displayPopUp(){
            popUp.style.display = 'block'
        }

        function clearPopUp(){
            popUp.style.display= 'none'
        }
    </script>

</body>
</html>