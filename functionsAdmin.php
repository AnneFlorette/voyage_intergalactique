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

//Verifie que l'utilisateur est un admin
    function isAdmin($mail){
        $bdd = getPDO();
        $request = $bdd -> prepare("SELECT user_admin FROM USERS WHERE user_mail = :mail");
        $request -> bindParam(":mail", $mail);
        $request -> execute();
        $data = $request -> fetch(PDO::FETCH_ASSOC);
        if ($data != null){
            return true;
        } else{
            return false;
        }
    }

//Vérifie que l'email existe et que le mot de passe correspond
// return true = utilisateur existant et bon logs
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

//création d'une destination
    function createDestination($destination, $img, $description){
        $bdd = getPDO();
        $request = $bdd -> prepare("INSERT INTO TRAVELPRES (travelpres_destination, travelpres_img_url, travelpres_description) VALUES (:destination, :img_url, :descriptions)");
        $request -> bindParam(":destination",$destination);
        $request -> bindParam(":img_url",$img);
        $request -> bindParam(":descriptions",$description);
        $request -> execute();
    }

//création d'un nouveau voyage
    function createTravel($destination, $departTime, $totalPlaces, $remainPlaces, $spaceshipType, $totalTime, $travelPresID){
        $bdd = getPDO();
        $request = $bdd -> prepare("INSERT INTO TRAVEL (travel_destination, travel_depart_date, travel_total_places, travel_remain_places, travel_spaceship_type, travel_total_time, travelpres_ID) 
        VALUES (:destination, :depart_time, :total_places, :remain_places, :spaceship_type, :total_time, :travelpres_ID)");
        $request -> bindParam(":destination", $destination);
        $request -> bindParam(":depart_time", $departTime);
        $request -> bindParam(":total_places", $totalPlaces);
        $request -> bindParam(":remain_places", $remainPlaces);
        $request -> bindParam(":spaceship_type", $spaceshipType);
        $request -> bindParam(":total_time", $totalTime);
        $request -> bindParam(":travelpres_ID", $travelPresID);
        $request -> execute();
    }
?>