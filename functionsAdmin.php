<?php
    include 'configBdd.php';

    const KEY = "chfporndjzysthvlzpdbj25vfhg";

//choppe la BDD
    function getPDO(){
        global $host;
        global $name;
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
        $user = $request -> fetch(PDO::FETCH_ASSOC);
        if ($user['user_admin'] == 1){
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
        $user = $request -> fetchall(PDO::FETCH_ASSOC);
        if ($user != null){
            return true;
        } else{
            return false;
        }
    }

//retourne l'ID de l'utilisateur
    function getID($mail){
        $bdd = getPDO();
        $request = $bdd->prepare("SELECT user_ID FROM USERS WHERE user_mail = :mail");
        $request-> bindParam(':mail', $mail);
        $request-> execute();
        $userID = $request-> fetch(PDO::FETCH_ASSOC);
        return $userID['user_ID'];
    }

//retourne le 'First Name' de l'utilisateur à partir de son ID
    function getFirstName($ID){
        $bdd = getPDO();
        $request = $bdd->prepare("SELECT user_first_name FROM USERS WHERE user_ID = :ID");
        $request-> bindParam(':ID', $ID);
        $request-> execute();
        $userFirstName = $request-> fetch(PDO::FETCH_ASSOC);
        return $userFirstName['user_first_name'];
    }

    function checkAdminSession(){
        if(checkSession()){
            $bdd = getPDO();
            $request = $bdd -> prepare('SELECT user_admin FROM USERS WHERE user_ID =:ID');
            $request -> bindParam(':ID', $_SESSION['ID']);
            $request -> execute();
            $userAdmin = $request -> fetch(PDO::FETCH_ASSOC);
            if($userAdmin['user_admin'] == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

//Vérifie s'il y a une session active (quelqu'un de connecté)
//return true si une session est bien active
    function checkSession(){
        if(isset($_SESSION['ID']) && $_SESSION['ID'] !== ''){
            return true;
        }
        return false;
    }     

//change le nav suivant le statut de la personne connectée
    function changeNav(){
        if(checkSession()){
            $firstName = getFirstName($_SESSION['ID']);
                if(checkAdminSession()){
                    echo '  <nav>
                                <ul>
                                    <a href="index.php"><li id="home">Home</li></a>
                                    <a href="ourDestinations.php"><li id="destination">Our Destinations</li></a>
                                    <a href="ourCompany.php"><li id="company">Our Company</li></a>
                                    <a href="admin.php"><li id="admin">Dashboard</li></a>
                                    <a href="statistics.php"><li id="statistics">Statistics</li></a>
                                    <li id="profil">' .$firstName. '
                                        <ul id="subNav">
                                            <a href="profil.php"><li class="subItem">Profil</li></a>
                                            <a href="logOut.php"><li class="subItem">Log Out</li></a>
                                        </ul>
                                    </li>
                                </ul> 
                            </nav>
                     ';
                     return;
                }else if(!checkAdminSession()){
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
                    return;
                } 
        }else{
            echo '  <nav>
                        <ul>
                            <a href="adminConnexion.php"><li id="log">Log In / Sign Up</li></a>
                        </ul>
                    </nav>
            ';
            return;
        }
    }

//création d'une destination
    function createDestination($destination, $img, $description, $travelTime, $adultPrice, $childPrice){
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
        $request = $bdd -> prepare("SELECT travelpres_destination, travelpres_total_places FROM TRAVELPRES WHERE travelpres_ID = :destination_ID");
        $request -> bindParam(":destination_ID", $destinationID);
        $request -> execute();
        $destination = $request -> fetch(PDO::FETCH_ASSOC);
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
        $travels = $bdd -> query('SELECT travelpres_ID, travelpres_destination FROM TRAVELPRES')->fetchall(PDO::FETCH_ASSOC);
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
            $request = $bdd -> prepare('SELECT user_ID, user_first_name, user_last_name, user_mail FROM USERS WHERE user_last_name = :lastName AND user_admin != 1');
            $request -> bindParam("lastName", $lastName);
            $request -> execute();
        } else{
            $request = $bdd -> query('SELECT user_ID, user_first_name, user_last_name, user_mail FROM USERS WHERE user_admin != 1');
        }
        $users = $request -> fetchall(PDO::FETCH_ASSOC);
        $i = 0;
        foreach ($users as $user){
            $str = "";
            $str .= '<tr class="trUsers"><td>'.$user['user_first_name']
            .'</td><td>'.$user['user_last_name']
            .'</td><td>'.$user['user_mail']
            .'</td><td><button id="'.$i.'"value="'.$user['user_ID'].'" class="delete"><i class="material-icons iconBin">delete</i></button></td></tr>';
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

//afficher les prochains voyages
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

    //STATISTIC FUNCTIONS
    function getNbrUser(){
        $bdd = getPDO();
        $request = $bdd -> query("SELECT COUNT(user_ID) FROM USERS WHERE user_admin != 1") -> fetchAll(PDO::FETCH_ASSOC);
        return $request[0]["COUNT(user_ID)"];
    }

    function getDestinations(){
        $bdd = getPDO();
        $request = $bdd -> query("SELECT * FROM TRAVELPRES") -> fetchAll(PDO::FETCH_ASSOC);
        return $request;
    }

    function getTotalPlaceDestination($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $request = $bdd -> query("SELECT travelpres_total_places FROM `TRAVELPRES` WHERE travelpres_ID =" . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $request = $bdd -> query("SELECT travelpres_total_places FROM `TRAVELPRES`") -> fetchAll(PDO::FETCH_ASSOC);
        }
        return $request;
    }

    function getNbrReservedSit($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $requests = $bdd -> query("SELECT userbooking_child_places, userbooking_adult_places FROM USERSBOOKING u JOIN TRAVEL t ON u.travel_ID = t.travel_ID WHERE t.travelpres_ID = " . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $requests = $bdd -> query("SELECT userbooking_child_places, userbooking_adult_places FROM USERSBOOKING") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $nbrPlaces = 0;
        if(count($requests) > 0){
            foreach($requests as $request){
                $nbrPlaces += $request["userbooking_child_places"] + $request["userbooking_adult_places"];
            }
        }
        return $nbrPlaces;
    }

    function getPourcentSitReserved($destinationID = null){
        $nbrSit = getNbrReservedSit($destinationID);
        $totalPlaceDestinations = getTotalPlaceDestination($destinationID);
        if($totalPlaceDestinations != null){
            $sum = 0;
            foreach ($totalPlaceDestinations as $totalPlaceDestination){
                $sum += $totalPlaceDestination["travelpres_total_places"];
            }
            return $nbrSit / $sum;
        }
    }

    function getNbrFinisedTravel($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $requests = $bdd -> query("SELECT COUNT(t1.travel_ID) FROM TRAVEL t1 JOIN TRAVELPRES t2 ON t1.travelpres_ID = t2.travelpres_ID WHERE t2.travelpres_ID = ". $destinationID ." AND ADDDATE(t1.travel_depart_date, INTERVAL t2.travelpres_days DAY) < CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $requests = $bdd -> query("SELECT COUNT(t1.travel_ID) FROM TRAVEL t1 JOIN TRAVELPRES t2 ON t1.travelpres_ID = t2.travelpres_ID WHERE ADDDATE(t1.travel_depart_date, INTERVAL t2.travelpres_days DAY) < CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $finisedTravel = 0;
        if(count($requests) > 0){
            foreach($requests as $request){
                $finisedTravel += $request["COUNT(t1.travel_ID)"];
            }
        }
        return $finisedTravel;
    }

    function getIncome(){
        $bdd = getPDO();
        $request = $bdd -> prepare('SELECT SUM(userbooking_total_price) AS income FROM USERSBOOKING');
        $request -> execute();
        $income = $request -> fetch(PDO::FETCH_ASSOC);
        return $income['income'];
    }

    function getNbrCurrentTravel($destinationID = null){
        $bdd = getPDO();
        if($destinationID != null){
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM TRAVEL WHERE travelpres_ID = ". $destinationID ." AND travel_depart_date >= CURRENT_DATE AND travel_depart_date < ADDDATE(CURRENT_DATE, INTERVAL travel_total_time DAY)") -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM TRAVEL WHERE travel_depart_date >= CURRENT_DATE AND travel_depart_date < ADDDATE(CURRENT_DATE, INTERVAL travel_total_time DAY)") -> fetchAll(PDO::FETCH_ASSOC);
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
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM TRAVEL WHERE travel_depart_date > CURRENT_DATE AND travelpres_ID = " . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);            
        } else{
            $requests = $bdd -> query("SELECT COUNT(travel_ID) FROM TRAVEL WHERE travel_depart_date > CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
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
            $remainPlacesDest = $bdd -> query("SELECT SUM(travel_remain_places), COUNT(travel_ID) FROM TRAVEL WHERE travelpres_ID = " . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);
            $totalPlacesDest = $bdd -> query("SELECT SUM(travelpres_total_places) FROM TRAVELPRES WHERE travelpres_ID = " . $destinationID) -> fetchAll(PDO::FETCH_ASSOC);
        } else{
            $remainPlacesDest = $bdd -> query("SELECT SUM(travel_remain_places), COUNT(travel_ID) FROM TRAVEL") -> fetchAll(PDO::FETCH_ASSOC);
            $totalPlacesDest = $bdd -> query("SELECT SUM(travelpres_total_places) FROM TRAVELPRES") -> fetchAll(PDO::FETCH_ASSOC);
        }
        $totalPlaces = $totalPlacesDest[0]["SUM(travelpres_total_places)"] * $remainPlacesDest[0]["COUNT(travel_ID)"];
        $currentPlaces = $remainPlacesDest[0]["SUM(travel_remain_places)"];
        $completion = 0;
        if($totalPlaces > 0){
            $completion = round(($totalPlaces / $currentPlaces), 1);
        }
        return $completion;
    }
?>