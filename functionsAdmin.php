<?php
    include 'configBdd.php';

    const KEY = "chfporndjzysthvlzpdbj25vfhg";

//choppe la BDD
    function getPDO(){
        global $login;
        global $pass;
        try{
            return new PDO('mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8', $login, $pass);
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
// le deuxieme total places est pour remain places car voyage neuf donc toutes les places sont libres
    function createTravel($destination, $departDate, $totalTime, $totalPlaces, $spaceshipType, $travelPresID){
        $bdd = getPDO();
        $request = $bdd -> prepare("INSERT INTO TRAVEL (travel_destination, travel_depart_date, travel_total_time, travel_total_places, travel_remain_places, travel_spaceship_type, travelpres_ID) 
        VALUES (:destination, :depart_date, :total_time, :total_places, :total_places, :spaceship_type, :travelpres_ID)");
        $request -> bindParam(":destination", $destination);
        $request -> bindParam(":depart_date", $departDate);
        $request -> bindParam(":total_time", $totalTime);
        $request -> bindParam(":total_places", $totalPlaces);
        $request -> bindParam(":spaceship_type", $spaceshipType);
        $request -> bindParam(":travelpres_ID", $travelPresID);
        $request -> execute();
    }

    //STATISTIC FUNCTIONS
    function getNbrUser(){
        $bdd = getPDO();
        $request = $bdd -> query("SELECT COUNT(user_ID) FROM users WHERE user_admin != 1") -> fetchAll(PDO::FETCH_ASSOC);
        return $request[0]["COUNT(user_ID)"];
    }

    function getDestinations(){
        $bdd = getPDO();
        $request = $bdd -> query("SELECT * FROM travelpres") -> fetchAll(PDO::FETCH_ASSOC);
        return $request;
    }

    function getTravel($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $request = $bdd -> query("SELECT * FROM travel WHERE travel_ID =" . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $request = $bdd -> query("SELECT * FROM travel") -> fetchAll(PDO::FETCH_ASSOC);
        }
        return $request;
    }

    function getNbrReservedSit($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $requests = $bdd -> query("SELECT userbooking_nbr_places FROM usersbooking WHERE EXISTS (SELECT * FROM travel WHERE travelpres_ID = ". $destinationID .")") -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $requests = $bdd -> query("SELECT userbooking_nbr_places FROM usersbooking") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $nbrPlaces = 0;
        if(count($requests) > 0){
            foreach($requests as $request){
                $nbrPlaces += $request["userbooking_nbr_places"];
            }
        }
        return $nbrPlaces;
    }

    function getPourcentSitReserved($destinationID = null){
        $nbrSit = getNbrReservedSit($destinationID);
        $travels = getTravel($destinationID);
        if($travels != null){
            $sum = 0;
            foreach ($travels as $travel){
                $sum += $travel["travel_total_places"];
            }
            return $nbrSit / $sum;
        }
    }

    function getNbrFinisedTravel($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM travel WHERE travelpres_ID = ". $destinationID ." AND ADDDATE(travel_depart_date, INTERVAL travel_total_time DAY) < CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM travel WHERE ADDDATE(travel_depart_date, INTERVAL travel_total_time DAY) < CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $finisedTravel = 0;
        if(count($requests) > 0){
            foreach($requests as $request){
                $finisedTravel += $request["COUNT(travel_ID)"];
            }
        }
        return $finisedTravel;
    }

    function getNbrCurrentTravel($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM travel WHERE travelpres_ID = ". $destinationID ." AND travel_depart_date >= CURRENT_DATE AND travel_depart_date < ADDDATE(CURRENT_DATE, INTERVAL travel_total_time DAY)") -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM travel WHERE travel_depart_date >= CURRENT_DATE AND travel_depart_date < ADDDATE(CURRENT_DATE, INTERVAL travel_total_time DAY)") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $currentTravel = 0;
        if(count($requests) > 0){
            foreach($requests as $request){
                $currentTravel += $request["COUNT(travel_ID)"];
            }
        }
        return $currentTravel;
    }

    function getNbrCommingTravel($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM travel WHERE travel_depart_date > CURRENT_DATE AND travelpres_ID = " . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);            
        } else{
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM travel WHERE travel_depart_date > CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $commingTravel = 0;
        if(count($requests) > 0){
            foreach($requests as $request){
                $commingTravel += $request["COUNT(travel_ID)"];
            }
        }
        return $commingTravel;
    }

    function getPourcentFlightCompletion($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $remainPlacesDest = $bdd -> query("SELECT travel_remain_places FROM travel WHERE travelpres_ID = " . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);
            $totalPlacesDest = $bdd -> query("SELECT travel_total_places FROM travel WHERE travelpres_ID = " . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $remainPlacesDest = $bdd -> query("SELECT travel_remain_places FROM travel") -> fetchAll(PDO::FETCH_ASSOC);
            $totalPlacesDest = $bdd -> query("SELECT travel_total_places FROM travel") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $currentPlaces = 0;
        $totalPlaces = 0;
        for($i = 0; $i < count($remainPlacesDest); $i++){
            $totalPlaces += $totalPlacesDest[$i]["travel_total_places"];
            $currentPlaces += $totalPlacesDest[$i]["travel_total_places"] - $remainPlacesDest[$i]["travel_remain_places"];
        }
        $completion = 0;
        if($totalPlaces > 0){
            $completion = round(($currentPlaces / $totalPlaces) * 100, 1);
        }
        return $completion;
    }
?>