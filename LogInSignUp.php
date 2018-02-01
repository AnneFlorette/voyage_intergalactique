<?php
    include 'fonctions.php';

    $allowedsignup = 1;

//verif inscription
    if (isset($_POST['mailsignup']) && htmlspecialchars($_POST['mailsignup']) != "" &&
        isset($_POST['passwdsignup']) && htmlspecialchars($_POST['passwdsignup']) != "" &&
        isset($_POST['last_name']) && htmlspecialchars($_POST['last_name']) != "" &&
        isset($_POST['first_name']) htmlspecialchars($_POST['first_name']) != "") {
        $mail = htmlspecialchars($_POST['mailsignup']);
        $passwd = htmlspecialchars($_POST['passwdsignup']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $first_name = htmlspecialchars($_POST['first_name']);

        $allowedsignup = verifInscription($mail);

        if ($allowedsignup == 1){
            $passcrypt = cryptage($mail, $passwd);
            writeLog($mail, $passcrypt, $last_name, $first_name);
            setcookie('logIn', $mail, time() + 30*24*3600, null, null, false ,true);
            //header('location: LogInSignUp.html');
        }
    }

    $allowedlogin = 0;
//verif connexion
    if (isset($_POST['maillogin']) && htmlspecialchars($_POST['maillogin']) != "" &&
        isset($_POST['passwdlogin']) && htmlspecialchars($_POST['passwdlogin']) != "") {
        $mail = htmlspecialchars($_POST['maillogin']);
        $passwd = htmlspecialchars($_POST['passwdlogin']);
        echo "<script>console.log( 'Debug Objects: ça marche1' );</script>";
        $logcrypt = cryptage($mail, $passwd);
        echo "<script>console.log( 'Debug Objects: ça marche10' );</script>";
        $allowedlogin = verifConnexion($mail, $logcrypt);
        if($allowedlogin == 1){
            $name = getName($mail);
            echo "<script>console.log( 'Debug Objects: ça marche100' );</script>";
            $_SESSION['name'] = $name;
            setcookie('logIn', $mail, time() + 30*24*3600, null, null, false ,true);
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
        <nav>
            <ul>
                <a href="index.php"><li id="home">Home</li></a>
                <a href="ourcompany.php"><li id="company">Our company</li></a>
                <a href="ourdestinations.php"><li id="log">Our destinations</li></a>
            </ul>
        </nav>
        <div id="titleBox">
            <a href="index.php"><h1>Far Away</h1></a>
        </div>
    <div id="logs">
        <div id="signUp">
            <form action="" method="POST">
                <h3>Sign Up</h3>
                <label for="first_name">First Name</label>
                <br>
                <input type="text" name="first_name" autofocus>
                <br>
                <label for="last_name">Last Name</label>
                <br>
                <input type="text" name="last_name">
                <br>
                <label for="mailsignup">Email</label>
                <br>
                <input type="text" name="mailsignup">
                <br>
                <label for="passwdsignup">Password</label>
                <br>
                <input type="password" name="passwdsignup">
                <br>
                <input type="submit" value="Sign Up" class="submit">
                <br>
            </form>
        </div>
        <div id="logIn">
            <form action="" method="POST">
                <h3>Log In</h3>
                <label for="maillogin">Email</label>
                <br>
                <input type="text" name="maillogin">
                <br>
                <label for="passwdlogin">Password</label>
                <br>
                <input type="password" name="passwdlogin">
                <br>
                <input type="submit" value="Log In" class="submit">
                <br>
            </form>          
        </div>
    </div>

</body>
</html>