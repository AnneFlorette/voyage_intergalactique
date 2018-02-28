<?php

include 'configBdd.php';

    const KEY = "chfporndjzysthvlzpdbj25vfhg";
//retourne la Base de données
    function getPDO(){
        global $login;
        global $pass;
        try{
            return new PDO('mysql:host=localhost;dbname=bdd_faraway;charset=utf8', $login, $pass);
        }
        catch(Exception $err){
            die("Debug: problème de bdd\n" . $err);
        }
    }

//Crypte le mot de passe grâce à un clé (KEY) et le Sha256
    function cryptage($passwd){
        $passCrypt = $passwd.KEY.KEY.$passwd.KEY;
        return hash('sha256', $passCrypt, false);
    }

//retourne le 'First Name' de l'utilisateur à partir de son ID
    function getFirstName($ID){
        $bdd = getPDO();
        $name = $bdd->prepare("SELECT user_first_name FROM USERS WHERE user_ID = :ID");
        $name-> bindParam(':ID', $ID);
        $name-> execute();
        $data = $name-> fetch(PDO::FETCH_ASSOC);
        $nameTemp = $data['user_first_name'];
        return $nameTemp;
    }

//retourne le 'Last Name' de l'utilisateur à partir de son ID
    function getLastName($ID){
        $bdd = getPDO();
        $name = $bdd->prepare("SELECT user_last_name FROM USERS WHERE user_ID = :ID");
        $name-> bindParam(':ID', $ID);
        $name-> execute();
        $data = $name-> fetch(PDO::FETCH_ASSOC);
        $nameTemp = $data['user_last_name'];
        return $nameTemp;
    }

//retourne le mail de l'utilisateur à partir de son ID
    function getMail($ID){
        $bdd = getPDO();
        $name = $bdd->prepare("SELECT user_mail FROM USERS WHERE user_ID = :ID");
        $name-> bindParam(':ID', $ID);
        $name-> execute();
        $data = $name-> fetch(PDO::FETCH_ASSOC);
        $mailTemp = $data['user_mail'];
        return $mailTemp;
    }

//Lors de la connexion, l'utilisateur démarre une session start
//grâce au mail qu'il entre, on retourne son ID qui sera retenu dans le tableau $_SESSION
    function getID($mail){
        $bdd = getPDO();
        $ID = $bdd->prepare("SELECT user_ID FROM USERS WHERE user_mail = :mail");
        $ID-> bindParam(':mail', $mail);
        $ID-> execute();
        $data = $ID-> fetch(PDO::FETCH_ASSOC);
        $IDTemp = $data['user_ID'];
        return $IDTemp;
    }

////retourne le 'password' de l'utilisateur à partir de son ID
    function getMdp($ID){
        $bdd = getPDO();
        $request = $bdd -> prepare("SELECT user_password FROM USERS WHERE user_ID = :ID");
        $request -> bindParam(":ID", $ID);
        $request -> execute();
        $data = $request -> fetch(PDO::FETCH_ASSOC);
        $pwdTemp = $data['user_password'];
        return $pwdTemp;
    }

//Vérifie si le mail n'est pas déjà utilisé
//return true si le mail n'est pas encore utilisé
    function verifInscription($mail){
        $bdd = getPDO();
        $request = $bdd -> prepare("SELECT user_mail FROM USERS WHERE mail = :mail");
        $request -> bindParam(":mail", $mail);
        $request -> execute();
        $verifMail = $request->fetchAll(PDO::FETCH_ASSOC);  
        if($verifMail != null){
            return false;
        }               
        return true;
    }

//Lorsque l'inscription est valide (bon mail, mêmes mots de passe, chaque champ saisi) 
//On insert les données dans la base de données.
    function writeLog($mail, $passCrypt, $lastName, $firstName){
        $bdd = getPDO();    
        $request = $bdd-> prepare("INSERT INTO USERS (user_mail, user_password, user_first_name, user_last_name) VALUES (:mail, :passcrypt, :first_name, :last_name)");
        $request-> bindParam(':mail', $mail);
        $request-> bindParam(':passcrypt', $passCrypt);    
        $request-> bindParam(':first_name', $firstName);
        $request-> bindParam(':last_name', $lastName);
        $request-> execute();
    }

// Vérifie que le mail existe et que le mot de passe correspond
// return true si les logs entrés sont les bons
    function verifConnexion($mail, $passwd){
        $bdd = getPDO();
        $request = $bdd -> prepare("SELECT * FROM USERS WHERE user_mail = :mail AND user_password = :pass");
        $request -> bindParam(":mail", $mail);
        $request -> bindParam(":pass", $passwd);
        $request -> execute();
        $data = $request -> fetchall(PDO::FETCH_ASSOC);
        if ($data != null){
            return true;
        } else{
            return false;
        }
    }


//Dans la page profil, modification des informations (First Name, Last Name et le mail)
//On les modifie dans la base de données
    function modifData($ID, $firstName, $lastName, $mail){
        $bdd = getPDO();
        $request = $bdd -> prepare("UPDATE USERS SET user_first_name = :firstName, user_last_name = :lastName, user_mail = :mail WHERE user_ID = :ID");
        $request -> bindParam(":firstName", $firstName);
        $request -> bindParam(":lastName", $lastName);
        $request -> bindParam(":mail", $mail);
        $request -> bindParam(":ID", $ID);
        $request -> execute();
    }

//Modification du mot de passe.
//On vérifie que le mot de passe crypté dans la base de données est le même que celui qu'on donne en argument
//Utilisé dans la page profil pour modifier le mot de passe
//on vérifie d'abord si 'currentPwd' est bien le même que celui dans la base de données
    function verifPwd($ID, $mdp){
        $mdpVerif = getMdp($ID);
        $mdpCheck = cryptage($mdp);
        if($mdpCheck == $mdpVerif){
            return true;
        }
        return false;
    }

//Page profil pour la modification du mot de passe
//Après la vérification du mot de passe actuel
//l'utilisateur va entrer son nouveau mot de passe et on l'insert dans la base de données
    function modifPwd($ID, $mdp){
        $bdd = getPDO();
        $request = $bdd -> prepare("UPDATE USERS SET user_password = :mdp WHERE user_ID = :ID");
        $request -> bindParam(":mdp", $mdp);
        $request -> bindParam(":ID", $ID);
        $request -> execute();
    }

//Page Profil, il peut supprimer son compte
//Permet de supprimer le compte de l'utilisateur à partir de son ID
    function deleteAccount($ID){
        $bdd = getPDO();
        $request = $bdd -> prepare("DELETE FROM USERS WHERE user_ID = :ID");
        $request -> bindParam(":ID", $ID);
        $request -> execute();
    }

//Vérifie s'il y a une session active (quelqu'un de connecté)
//return true si une session est bien active
    function checkSession(){
        if(isset($_SESSION['ID']) && $_SESSION['ID'] !== ''){
            return true;
        }
        return false;
    }

//Vérifie qu'une session est active
//Si oui, la navbar propose d'accéder à son profil et de se déconnecter
//Si non, navbar proposant de se connecter ou s'inscrire
//POUR TOUTES LES PAGES SAUF L'INDEX
    function changeNav(){
        if(checkSession()){
            $firstName = getFirstName($_SESSION['ID']);
            echo '  <nav>
                        <ul>
                            <a href="index.php"><li id="home">Home</li></a>
                            <a href="ourDestinations.php"><li id="destination">Our Destinations</li></a>
                            <a href="ourCompany.php"><li id="company">Our Company</li></a>
                            <li id="profil">' .$firstName. '
                                <ul id="subNav">
                                    <a href="profil.php"><li class="subItem">Profil</li></a>
                                    <a href="logOut.php"><li class="subItem">Log Out</li></a>
                                </ul>
                            </li>
                        </ul> 
                    </nav>
            ';
        }else{
            echo '  <nav>
                        <ul>
                            <a href="index.php"><li id="home">Home</li></a>
                            <a href="ourDestinations.php"><li id="log">Our Destinations</li></a>
                            <a href="ourCompany.php"><li id="company">Our Company</li></a>
                            <a href="logInSignUp.php"><li id="log">Log In / Sign Up</li></a>
                        </ul>
                    </nav>
            ';
        }
    }

//Vérifie qu'une session est active
//Si oui, la navbar propose d'accéder à son profil et de se déconnecter
//Si non, navbar proposant de se connecter ou s'inscrire
//UNIQUEMENT POUR L'INDEX
    function changeNavIndex(){
        if(checkSession()){
            $firstName = getFirstName($_SESSION['ID']);
            echo '  <nav>
                        <ul>
                            <li id="profil">' .$firstName. '
                                <ul id="subNav">
                                    <a href="profil.php"><li class="subItem">Profil</li></a>
                                    <a href="logOut.php"><li class="subItem">Log Out</li></a>
                                </ul>
                            </li>
                        </ul> 
                    </nav>
            ';
        }else{
            echo '  <nav>
                        <ul>
                            <a href="logInSignUp.php"><li id="log">Log In / Sign Up</li></a>
                        </ul>
                    </nav>
            ';
        }
    }


//ourDestinations.php
//Création des sections (travel_pres) pour présenter chaque planète dynamiquement
    function createSections(){
        $bd_log = getPDO();
       $travels = $bd_log -> query("SELECT * FROM TRAVELPRES") -> fetchall(PDO::FETCH_ASSOC);

       $index = 0;
       foreach($travels as $travel){
           $str = "";
           $str .= "  <section class='planete' style='background-image: url(". $travel['travelpres_img_url'] .");' ";
           if ($index === 0){
               $str .= "id=firstPlanete";
           }
           $str .= "   ><div class='left'><h4>" . $travel['travelpres_destination'] . "</h4>
                        <p>" . $travel['travelpres_description'] . "</p>
                        <p>" . $travel['travelpres_destination_time'] . "H</p>
                        <a href= 'booking.php?ID=".$travel['travelpres_ID']."'><button class='booking'>Book this trip</button></a>
                        </div>
                        </section>";
           echo $str;
       }
   }
?>