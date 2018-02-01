<?php

    const KEY = "chfporndjzysthvlzpdbj25vfhg";
//choppe la BDD
    function getPDO(){
        try{
            return new PDO('mysql:host=sql11.freesqldatabase.com;dbname=sql11218946;charset=utf8', 'sql11218946', 'E2JMCvThBA');
        }
        catch(Exception $err){
            die("Debug: problème de bdd\n" . $err);
        }
    }

//il faudra peut etre enlever les '' autour de sha256
    function cryptage($mail, $passwd){
        $passcrypt = $mail.KEY.KEY.$passwd.KEY;
        return hash('sha256', $passcrypt, false);
    }

//Vérifie que l'email existe et que le mot de passe correspond
// return 1 = utilisateur existant et bon logs
    function verifConnexion($mail, $passwd){
        $bdd = getPDO();
        $requete = $bdd->prepare('SELECT * FROM users WHERE user_mail = :mail and user_password = :pass');
        $requete-> bindParam(':mail', $mail);
        $requete-> bindParam(':pass', $passwd);
        $requete-> execute();
        $verifmail = $requete->fetchAll(PDO::FETCH_ASSOC);      
        if(count($verifmail) > 0){
            return 1;
        } else {
            return 2;
        }
    }

//Ecris dans la bdd si identifiants allowed (inscription)
    function writeLog($mail, $passcrypt, $last_name, $first_name){
        var_dump($mail);
        var_dump($passcrypt);
        var_dump($last_name);
        var_dump($first_name);
        $bdd = getPDO();
        $requete = $bdd->prepare('INSERT INTO users (user_mail, user_password, user_last_name, user_first_name) VALUES (:mail, :passcrypt, :last_name, :first_name)');
        $requete-> bindParam(':mail', $mail);
        $requete-> bindParam(':passcrypt', $passcrypt);    
        $requete-> bindParam(':last_name', $last_name);
        $requete-> bindParam(':first_name', $first_name);
        $requete-> execute();      
    }

//Vérifie si le mail n'est pas déjà utilisé
//si return isvalid = 1 le mail est inutilisé donc bon
    function verifInscription($mail){
        $bdd = getPDO();
        $mailtemp = $bdd->query('SELECT user_mail FROM users');
        $verifmail = $mailtemp->fetchAll(PDO::FETCH_ASSOC);  
        foreach($verifmail as $value){
            if($mail == $value['user_mail']){
                return 2;
            }               
        }
        return 1;
    }

?>