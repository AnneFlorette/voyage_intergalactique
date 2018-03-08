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
    function createDestination($destination, $img, $description, $travelTime, $adultPrice, $childPrice){
        var_dump($destination, $img, $description, $travelTime, $adultPrice, $childPrice);
        $bdd = getPDO();
        $request = $bdd -> prepare("INSERT INTO TRAVELPRES (travelpres_destination, travelpres_img_url, travelpres_description, travelpres_days, travelpres_price_adult, travelpres_price_child) VALUES (:destination, :img_url, :descriptions, :travelTime, :adultPrice, :childPrice)");
        $request -> bindParam(":destination",$destination);
        $request -> bindParam(":img_url",$img);
        $request -> bindParam(":descriptions",$description);
        $request -> bindParam(":travelTime", $travelTime);
        $request -> bindParam(":adultPrice", $adultPrice);
        $request -> bindParam(":childPrice", $childPrice);
        $request -> execute();
    }

//création d'un nouveau voyage
// le deuxieme total places est pour remain places car voyage neuf donc toutes les places sont libres
    function createTravel($destinationID, $departDate){
        $bdd = getPDO();
        $destinationTemp = $bdd -> prepare("SELECT travelpres_destination, travelpres_total_places FROM TRAVELPRES WHERE travelpres_ID = :destination_ID");
        $destinationTemp -> bindParam(":destination_ID", $destinationID);
        $destinationTemp -> execute();
        $destination = $destinationTemp -> fetch(PDO::FETCH_ASSOC);
        $request = $bdd -> prepare("INSERT INTO TRAVEL (travel_destination, travel_depart_date, travel_remain_places, travelpres_ID) 
                                    VALUES (:destination, :depart_date, :total_places, :travelpres_ID)");
        $request -> bindParam(":destination", $destination['travelpres_destination']);
        $request -> bindParam(":depart_date", $departDate);
        $request -> bindParam(":total_places", $destination['travelpres_total_places']);
        $request -> bindParam(":travelpres_ID", $destinationID);
        $request -> execute(); 
    }

//création du select pour creation nouveau voyage
    function createOption(){
        $bdd = getPDO();
        $travels = $bdd->query('SELECT travelpres_ID, travelpres_destination FROM TRAVELPRES')->fetchall(PDO::FETCH_ASSOC);
        foreach ($travels as $travel){
            $str = "";
            $str .= '<option value="'.$travel['travelpres_ID'].'">'.$travel['travelpres_destination'].'</option>';
            echo $str;
        }
    }

// recherche des users
    function searchUsers($lastName){
        $bdd = getPDO();
        if($lastName != ""){
            $usersTemp = $bdd -> prepare('SELECT user_ID, user_first_name, user_last_name, user_mail FROM USERS WHERE user_last_name = :lastName AND user_admin != 1');
            $usersTemp -> bindParam("lastName", $lastName);
            $usersTemp -> execute();
        } else{
            $usersTemp = $bdd -> query('SELECT user_ID, user_first_name, user_last_name, user_mail FROM USERS WHERE user_admin != 1');
        }
        $users = $usersTemp -> fetchall(PDO::FETCH_ASSOC);
        $i = 0;
        foreach ($users as $user){
            $str = "";
            $str .= '<tr><td>'.$user['user_first_name']
            .'</td><td>'.$user['user_last_name']
            .'</td><td>'.$user['user_mail']
            .'</td><td><button id="'.$i.'"value="'.$user['user_ID'].'" class="delete"><i class="material-icons">delete</i></button></td></tr>';
            echo $str;
            $i++;
        }
    }

//Permet de supprimer le compte de l'utilisateur à partir de son ID
    function deleteAccount($ID){
        $bdd = getPDO();
        $request = $bdd -> prepare("DELETE FROM USERS WHERE user_ID = :ID");
        $request -> bindParam(":ID", $ID);
        $request -> execute();
    }


//afficher les 10 prochains voyages
    function getNextTravels(){
        $bdd = getPDO();
        $travels = $bdd -> query('SELECT * FROM TRAVEL WHERE travel_depart_date > CURRENT_DATE');
        foreach($travels as $travel){
            $str = "";
            $str .= '<tr><td>'.$travel['travel_ID']
            .'</td><td>'.$travel['travel_destination']
            .'</td><td>'.$travel['travel_depart_date']
            .'</td><td>'.$travel['travel_remain_places']
            .'</td></tr>';
            echo $str;
        }
    }


?>