<?php
    include 'functions.php';
    session_start();
    $_SESSION['ID'] = "";

    $allowedSignUp = true;

//verif inscription
    if (isset($_POST['mailSignUp']) && htmlspecialchars($_POST['mailSignUp']) != "" &&
        isset($_POST['passwdSignUp']) && htmlspecialchars($_POST['passwdSignUp']) != "" &&
        isset($_POST['lastName']) && htmlspecialchars($_POST['lastName']) != "" &&
        isset($_POST['firstName']) && htmlspecialchars($_POST['firstName']) != "" &&
        htmlspecialchars($_POST['passwdSignUpVerif']) == htmlspecialchars($_POST['passwdSignUp'])) {
        $mail = htmlspecialchars($_POST['mailSignUp']);
        $passwd = htmlspecialchars($_POST['passwdSignUp']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $firstName = htmlspecialchars($_POST['firstName']);

        $allowedSignUp = verifInscription($mail);

        if ($allowedSignUp == true){
            $passCrypt = cryptage($mail, $passwd);
            writeLog($mail, $passCrypt, $lastName, $firstName);
            header('location: logInSignUp.php');
        }
    }

    $allowedLogIn = false;
//verif connexion
    if (isset($_POST['mailLogIn']) && htmlspecialchars($_POST['mailLogIn']) != "" &&
        isset($_POST['passwdLogIn']) && htmlspecialchars($_POST['passwdLogIn']) != "") {
        $mail = htmlspecialchars($_POST['mailLogIn']);
        $passwd = htmlspecialchars($_POST['passwdLogIn']);
        $logCrypt = cryptage($mail, $passwd);
        $allowedLogin = verifConnexion($mail, $logCrypt);
        if($allowedLogin == true){
            $ID = getID($mail);
            $_SESSION['ID'] = $ID;
            setcookie('logIn', $mail, time() + 30*24*3600, null, null, false ,true);
            header('location: profil.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/styleLogs.css">
    <title>Log In - Sign Up</title>
</head>
<body>
    <!-- Création du menu dynamiquement -->
    <?php 
        changeNav();
    ?>
        <div id="titleBox">
            <a href="index.php"><h1>Far Away</h1></a>
        </div>
    <div id="logs">
        <div id="signUp">
            <form action="" method="POST">
                <h3>Sign Up</h3>
                <label for="firstName">First Name</label>
                <br>
                <input type="text" name="firstName" class="input" autofocus max="40" required>
                <br>
                <label for="lastName">Last Name</label>
                <br>
                <input type="text" name="lastName" class="input" max="40" required>
                <br>
                <label for="mailSignUp">Email</label>
                <br>
                <input type="email" name="mailSignUp" class="input" max="64" required>
                <br>
                <label for="passwdSignUp">Password</label>
                <br>
                <input type="password" name="passwdSignUp" class="input" min="8" max="20" required>
                <br>
                <label for="passwdSignUpVerif">Password Check</label>
                <br>
                <input type="password" name="passwdSignUpVerif" class="input" required>
                <br>
                <input type="submit" value="Sign Up" class="submit">
                <br>
            </form>
        </div>
        <div id="logIn">
            <form action="" method="POST">
                <h3>Log In</h3>
                <label for="mailLogIn">Email</label>
                <br>
                <input type="email" name="mailLogIn" class="input" required>
                <br>
                <label for="passwdLogIn">Password</label>
                <br>
                <input type="password" name="passwdLogIn" class="input" required>
                <br>
                <input type="submit" value="Log In" class="submit">
                <br>
            </form>          
        </div>
    </div>

</body>
</html>