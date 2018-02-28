<?php
    include 'functionsAdmin.php';
    session_start();
    $_SESSION['ID'] = "";


    $allowedLogIn = false;
    $admin = false;
//verif connexion
    if (isset($_POST['mailLogIn']) && htmlspecialchars($_POST['mailLogIn']) != "" &&
        isset($_POST['passwdLogIn']) && htmlspecialchars($_POST['passwdLogIn']) != "") {
        $mail = htmlspecialchars($_POST['mailLogIn']);
        $passwd = htmlspecialchars($_POST['passwdLogIn']);
        $logCrypt = cryptage($passwd);
        $allowedLogin = verifConnexion($mail, $logCrypt);
        $admin = isAdmin($mail);
        if($allowedLogin == true && $admin == true){
            $ID = getID($mail);
            $_SESSION['ID'] = $ID;
            header('location: admin.php');
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
</body>
</html>