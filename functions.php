<?php

    const KEY = "chfporndjzysthvlzpdbj25vfhg";
//choppe la BDD
    function getPDO(){
        try{
            return new PDO('mysql:host=localhost;dbname=id4821353_faraway;charset=utf8', 'id4821353_farawayintergalactique', 'Farawayinter');
        }
        catch(Exception $err){
            die("Debug: problème de bdd\n" . $err);
        }
    }

//il faudra peut etre enlever les '' autour de sha256
    function cryptage($mail, $passwd){
        $passCrypt = $mail.KEY.KEY.$passwd.KEY;
        return hash('sha256', $passCrypt, false);
    }

//Vérifie que l'email existe et que le mot de passe correspond
// return true = utilisateur existant et bon logs
    function verifConnexion($mail, $passwd){
        $bdd = getPDO();

        echo "<script>console.log( 'Debug Objects:" . $passwd . "' );</script>";


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
        $requete = $bdd->prepare('INSERT INTO USERS (user_mail, user_password, user_last_name, user_first_name) VALUES (:mail, :passcrypt, :last_name, :first_name)');
        $requete-> bindParam(':mail', $mail);
        $requete-> bindParam(':passcrypt', $passCrypt);    
        $requete-> bindParam(':last_name', $lastName);
        $requete-> bindParam(':first_name', $firstName);
        $requete-> execute();      
    }

//Vérifie si le mail n'est pas déjà utilisé
//si return isvalid = 1 le mail est inutilisé donc bon
    function verifInscription($mail){
        $bdd = getPDO();
        $mailTemp = $bdd->query('SELECT user_mail FROM USERS');
        $verifMail = $mailTemp->fetchAll(PDO::FETCH_ASSOC);  
        foreach($verifMail as $value){
            if($mail == $value['user_mail']){
                return false;
            }               
        }
        return true;
    }

    function getName($mail){
        $bdd = getPDO();
        $name = $bdd->prepare('SELECT (user_last_name, user_first_name) FROM USERS WHERE mail = :mail');
        $name-> bindParam(':mail', $mail);
        $name-> execute();
        $data = $name-> fetch(PDO::FETCH_ASSOC);
        $nameTemp = $data['user_last_name']. ' ' .$data['user_first_name'];
        return $nameTemp;
    }
?>