<?php 
    include 'functions.php'; 
    session_start();

    // Changement d'informations
    if  ((isset($_POST['firstName']) && $_POST['firstName'] != "") &&
        (isset($_POST['lastName']) && $_POST['lastName'] != "") &&
        (isset($_POST['mail']) && $_POST['mail'] != "")){
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $mail = htmlspecialchars($_POST['mail']);

            modifData(($_SESSION['ID']), $firstName, $lastName, $mail);
            echo "<script>popUpInfo.style.display = 'none'</script>";
            echo'<meta http-equiv="refresh" content="0; URL=profil.php">';
        }



    // Changement mot de passe
        if  ((isset($_POST['currentPwd']) && $_POST['currentPwd'] != "") &&
            (isset($_POST['newPwd']) && $_POST['newPwd'] != "") &&
            (isset($_POST['checkNewPwd']) && $_POST['checkNewPwd'] != "")){
            if  ((verifPwd($_SESSION['ID'], $_POST['currentPwd']) == true) && 
                (htmlspecialchars($_POST['newPwd']) == htmlspecialchars($_POST['checkNewPwd']))){
                $newPwd = htmlspecialchars($_POST['newPwd']);
                modifPwd($_SESSION['ID'], $newPwd);
            }
        }
    // Suppression du compte
    if(isset($_POST['delete']) && $_POST['delete'] == "YES"){
        deleteAccount($_SESSION['ID']);
        echo'<meta http-equiv="refresh" content="0; URL=logOut.php">';
    } else if(isset($_POST['notDelete']) && $_POST['notDelete'] == "NO"){
        echo "<script>popUpDeleteAccount.style.display = 'none'</script>";
    }
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
                <div id="buttonBox">
                    <button id="btnPopUpInfo">Modify informations</button>
                    <button id="btnPopUpPassword">Modify password</button>
                    <button id="btnPopUpDeleteAccount">Delete account</button>
                </div>
                
                <!-- PopUp pour modifier les informations -->
                <div id="popUpInfo">
                    <div class="popUp_block">
                        <i id="clearInfo" class="material-icons">clear</i>
                        <form action="" method="POST">
                            <label for="firstName">First Name</label>
                            <br>
                            <input type="text" name="firstName" class="input" value="<?php echo getFirstName($_SESSION['ID']) ?>" max="40" autofocus required>
                            <br>
                            <label for="lastName">Last Name</label>
                            <br>
                            <input type="text" name="lastName" class="input" value="<?php echo getLastName($_SESSION['ID']) ?>" max="40" required>
                            <br>
                            <label for="mail">Email</label>
                            <br>
                            <input type="email" name="mail" class="input" value="<?php echo getMail($_SESSION['ID']) ?>" max="64" required>
                            <br>
                            <input id="submit" type="submit" value="Send Modifications">
                        </form>
                    </div>
                </div>
                <div id="popUpPassword">
                    <div class="popUp_block">
                        <i id="clearPassword" class="material-icons">clear</i>
                        <form action="" method="POST">
                            <label for="currentPwd">Current Password</label>
                            <br>
                            <input type="password" name="currentPwd" class="input" autofocus required>
                            <br>
                            <label for="newPwd">New Password</label>
                            <br>
                            <input type="password" name="newPwd" class="input" min="8" max="20" required>
                            <br>
                            <label for="checkNewPwd">Check New Password</label>
                            <br>
                            <input type="password" name="checkNewPwd" class="input" min="8" max="20" required>
                            <br>
                            <input id="submit" type="submit" value="Send Modifications">
                        </form>
                    </div>
                </div>
                <div id="popUpDeleteAccount">
                    <div class="popUp_block">
                        <i id="clearDeleteAccount" class="material-icons">clear</i>
                        <form action="" method="POST">
                            <p>Warning ! You're about to delete your account. Are you sure ?</p>
                            <input type="submit" class="btnYesNo" name="delete" value="YES">
                            <input type="submit" class="btnYesNo" name="notDelete" value="NO">
                        </form>
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
        const popUpInfo = document.getElementById('popUpInfo')
        const popUpPassword = document.getElementById('popUpPassword')
        const popUpDeleteAccount = document.getElementById('popUpDeleteAccount')
        const btnPopUpInfo = document.getElementById('btnPopUpInfo')
        const btnPopUpPassword = document.getElementById('btnPopUpPassword')
        const btnPopUpDeleteAccount = document.getElementById('btnPopUpDeleteAccount')
        const iconClearInfo = document.getElementById('clearInfo')
        const iconClearPassword = document.getElementById('clearPassword')
        const iconClearDeleteAccount = document.getElementById('clearDeleteAccount')
        
        btnPopUpInfo.addEventListener('click', function() {displayPopUp(popUpInfo)}, false)
        btnPopUpPassword.addEventListener('click', function() {displayPopUp(popUpPassword)}, false)
        btnPopUpDeleteAccount.addEventListener('click', function() {displayPopUp(popUpDeleteAccount)}, false)
        iconClearInfo.addEventListener('click', function() {clearPopUp(popUpInfo)}, false)
        iconClearPassword.addEventListener('click', function() {clearPopUp(popUpPassword)}, false)
        iconClearDeleteAccount.addEventListener('click', function() {clearPopUp(popUpDeleteAccount)}, false)
        
        function displayPopUp(popUp){
            popUp.style.display = 'block'
        }

        function clearPopUp(popUp){
            popUp.style.display = 'none'
        }
    </script>

</body>
</html>