<?php

include 'configBdd.php';

    const KEY = "chfporndjzysthvlzpdbj25vfhg";
//choppe la BDD
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

//il faudra peut etre enlever les '' autour de sha256
    function cryptage($passwd){
        $passCrypt = $passwd.KEY.KEY.$passwd.KEY;
        return hash('sha256', $passCrypt, false);
    }

//Vérifie que l'email existe et que le mot de passe correspond
// return true = utilisateur existant et bon logs
    function verifConnexion($mail, $passwd){
        $bdd = getPDO();
        $requete = $bdd -> prepare("SELECT * FROM USERS WHERE user_mail = :mail AND user_password = :pass");
        $requete -> bindParam(":mail", $mail);
        $requete -> bindParam(":pass", $passwd);
        $requete -> execute();
        $data = $requete -> fetchall(PDO::FETCH_ASSOC);
        if ($data != null){
            return true;
        } else{
            return false;
        }
    }

//Ecris dans la bdd si identifiants allowed (inscription)
    function writeLog($mail, $passCrypt, $lastName, $firstName){
        $bdd = getPDO();    
        $requete = $bdd-> prepare("INSERT INTO USERS (user_mail, user_password, user_first_name, user_last_name) VALUES (:mail, :passcrypt, :first_name, :last_name)");
        $requete-> bindParam(':mail', $mail);
        $requete-> bindParam(':passcrypt', $passCrypt);    
        $requete-> bindParam(':first_name', $firstName);
        $requete-> bindParam(':last_name', $lastName);
        $requete-> execute();
    }

//Vérifie si le mail n'est pas déjà utilisé
//si return isvalid = true le mail est inutilisé donc bon
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

//modification des données
    function modifData($ID, $firstName, $lastName, $mail){
        $bdd = getPDO();
        $request = $bdd -> prepare("UPDATE USERS SET user_first_name = :firstName, user_last_name = :lastName, user_mail = :mail WHERE user_ID = :ID");
        $request -> bindParam(":firstName", $firstName);
        $request -> bindParam(":lastName", $lastName);
        $request -> bindParam(":mail", $mail);
        $request -> bindParam(":ID", $ID);
        $request -> execute();
    }

//vérification mdp
    function verifPwd($ID, $mdp){
        $mdpVerif = getMdp($ID);
        $mdpCheck = cryptage($mdp);
        if($mdpCheck == $mdpVerif){
            return true;
        }
        return false;
    }


//modification mdp
    function modifPwd($ID, $mdp){
        $bdd = getPDO();
        $request = $bdd -> prepare("UPDATE USERS SET user_password = :mdp WHERE user_ID = :ID");
        $request -> bindParam(":mdp", $mdp);
        $request -> bindParam(":ID", $ID);
        $request -> execute();
    }

//suppression du compte
    function deleteAccount($ID){
        $bdd = getPDO();
        $request = $bdd -> prepare("DELETE FROM USERS WHERE user_ID = :ID");
        $request -> bindParam(":ID", $ID);
        $request -> execute();
    }

//retourne le nom dans la bdd
    function getFirstName($ID){
        $bdd = getPDO();
        $name = $bdd->prepare("SELECT user_first_name FROM USERS WHERE user_ID = :ID");
        $name-> bindParam(':ID', $ID);
        $name-> execute();
        $data = $name-> fetch(PDO::FETCH_ASSOC);
        $nameTemp = $data['user_first_name'];
        return $nameTemp;
    }

//retourne le nom dans la bdd
    function getLastName($ID){
        $bdd = getPDO();
        $name = $bdd->prepare("SELECT user_last_name FROM USERS WHERE user_ID = :ID");
        $name-> bindParam(':ID', $ID);
        $name-> execute();
        $data = $name-> fetch(PDO::FETCH_ASSOC);
        $nameTemp = $data['user_last_name'];
        return $nameTemp;
    }

//retourne le nom dans la bdd
    function getMail($ID){
        $bdd = getPDO();
        $name = $bdd->prepare("SELECT user_mail FROM USERS WHERE user_ID = :ID");
        $name-> bindParam(':ID', $ID);
        $name-> execute();
        $data = $name-> fetch(PDO::FETCH_ASSOC);
        $mailTemp = $data['user_mail'];
        return $mailTemp;
    }

//retourne l'ID de l'utilisateur
    function getID($mail){
        $bdd = getPDO();
        $ID = $bdd->prepare("SELECT user_ID FROM USERS WHERE user_mail = :mail");
        $ID-> bindParam(':mail', $mail);
        $ID-> execute();
        $data = $ID-> fetch(PDO::FETCH_ASSOC);
        $IDTemp = $data['user_ID'];
        return $IDTemp;
    }

//retourne le mdp de l'utilisateur
    function getMdp($ID){
        $bdd = getPDO();
        $request = $bdd -> prepare("SELECT user_password FROM USERS WHERE user_ID = :ID");
        $request -> bindParam(":ID", $ID);
        $request -> execute();
        $data = $request -> fetch(PDO::FETCH_ASSOC);
        $mdpTemp = $data['user_password'];
        return $mdpTemp;
    }

//vérification Session en cours
    function checkSession(){
        if(isset($_SESSION['ID']) && $_SESSION['ID'] !== ''){
            return true;
        }
        return false;
    }

//change le menu dynamiquement 
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

//change menu de l'index
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

//Création de sections pour la page ourDestinations.php
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