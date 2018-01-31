<?php
    include 'fonctions.php';

    const KEY = "chfporndjzysthvlzpdbj25vfhg";
    $allowedsignup = 1;

//verif inscription
    if (isset($_POST['mail']) && isset($_POST['passwd']) && isset($_POST['last_name']) && isset($_POST['first_name'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $passwd = htmlspecialchars($_POST['passwd']);
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




?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/styleLogs.css">
    <title>Log In - Sign Up</title>
</head>
<body>
        <nav>
            <ul>
                <a href="index.html"><li id="home">Home</li></a>
                <a href="ourcompany.html"><li id="company">Our company</li></a>
                <a href="ourdestinations.html"><li id="log">Our destinations</li></a>
            </ul>
        </nav>
        <div id="titleBox">
            <a href="index.html"><h1>Far Away</h1></a>
        </div>
    <div id="logs">
        <div id="signUp">
            <form action="" method="POST">
                <h3>Sign Up</h3>
                <label for="firstName">First Name</label>
                <br>
                <input type="text" name="firstName" autofocus>
                <br>
                <label for="lastName">Last Name</label>
                <br>
                <input type="text" name="lastName">
                <br>
                <label for="email">Email</label>
                <br>
                <input type="text" name="email">
                <br>
                <label for="password">Password</label>
                <br>
                <input type="password" name="password">
                <br>
                <input type="submit" value="Sign Up" class="submit">
                <br>
            </form>
        </div>
        <div id="logIn">
            <form action="" method="POST">
                <h3>Log In</h3>
                <label for="email">Email</label>
                <br>
                <input type="text" name="email">
                <br>
                <label for="password">Password</label>
                <br>
                <input type="password" name="password">
                <br>
                <input type="submit" value="Log In" class="submit">
                <br>
            </form>          
        </div>
    </div>

</body>
</html>