<?php

include 'configBdd.php';

    const KEY = "chfporndjzysthvlzpdbj25vfhg";
//retourne la Base de données
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

//check si $_GET est vide, si oui, l'utilisateur sera redirigé vers la page connexion
    function checkGet(){
        if(empty($_GET)){
            return true;
        }
        return false;
    }
//PROFIL FUNCTIONS

    function getNextTrips($userID){
        $bdd = getPDO();
        /*$request = $bdd -> prepare("SELECT * FROM USERSBOOKING WHERE user_ID = :ID AND userbooking_booking_date >= CURRENT_DATE");
        $request -> bindParam(":ID", $userID);
        $request -> execute() -> fetchAll(PDO::FETCH_ASSOC);
        return $request ; */
        return $bdd -> query("SELECT * FROM USERSBOOKING WHERE user_ID = ". $userID ." AND userbooking_booking_date >= CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
    }

    function getOldTrips($userID){
        $bdd = getPDO();
        /*$request = $bdd -> prepare("SELECT * FROM `usersbooking` WHERE user_ID = :ID AND userbooking_booking_date < CURRENT_DATE");
        $request -> bindParam(":ID", $userID);
        $result = $request -> execute();
        return $result -> fetchAll(PDO::FETCH_ASSOC); */
        return $bdd -> query("SELECT * FROM USERSBOOKING WHERE user_ID = ". $userID ." AND userbooking_booking_date < CURRENT_DATE") -> fetchAll(PDO::FETCH_ASSOC);
    }

    function getDestination($travelID){
        $bdd = getPDO();
        return $bdd -> query("SELECT travel_Destination FROM TRAVEL WHERE travel_ID = " . $travelID) -> fetchAll(PDO::FETCH_ASSOC);
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
                        <a href= 'booking.php?ID=".$travel['travelpres_ID']."'><button class='booking'>Book this trip</button></a>
                        </div>
                        </section>";
            echo $str;
        }
   }

//retourne l'ID de la destination stocké dans l'url
    function getIDDestination(){
       $IDDestination = $_GET['ID'];
       return $IDDestination;
    }

//retourne la description de la destination
    function getTripDescription($ID){
        $bdd = getPDO();
        $descriptionTemp = $bdd -> prepare('SELECT travelpres_description FROM TRAVELPRES WHERE travelpres_ID = :ID');
        $descriptionTemp -> bindParam(':ID', $ID);
        $descriptionTemp -> execute();
        $description = $descriptionTemp -> fetch(PDO::FETCH_ASSOC);
        return $description['travelpres_description'];
    }

//retourne l'image de la destination
    function getTripImage($ID){
        $bdd = getPDO();
        $imageTemp = $bdd -> prepare('SELECT travelpres_img_url FROM TRAVELPRES WHERE travelpres_ID = :ID');
        $imageTemp -> bindParam(':ID', $ID);
        $imageTemp -> execute();
        $image = $imageTemp -> fetch(PDO::FETCH_ASSOC);
        return $image;
    }

//retourne le nom de la destination
    function getTripName($ID){
        $bdd = getPDO();
        $nameTemp = $bdd -> prepare('SELECT travelpres_destination FROM TRAVELPRES WHERE travelpres_ID = :ID');
        $nameTemp -> bindParam(':ID', $ID);
        $nameTemp -> execute();
        $name = $nameTemp -> fetch(PDO::FETCH_ASSOC);
        return $name['travelpres_destination'];
    }

//retourne le tableau des prochains vols par l'ID de la destination
    function getNextTrip($ID){
        $bdd = getPDO();
        $infoTemp = $bdd -> prepare('SELECT t1.travel_ID ,t1.travel_depart_date, t2.travelpres_days, t2.travelpres_price_adult, t2.travelpres_price_child, t1.travel_remain_places FROM TRAVEL t1 JOIN TRAVELPRES t2 ON t1.travelpres_ID = t2.travelpres_ID WHERE t1.travelpres_ID = :ID');
        $infoTemp -> bindParam(':ID', $ID);
        $infoTemp -> execute();
        $infos = $infoTemp -> fetchAll(PDO::FETCH_ASSOC);
        
        foreach($infos as $info){
            $str = '';
            $str .= '<tr><td>'.$info['travel_ID'].'</td>
                    <td>'.$info['travel_depart_date'].'</td>
                    <td>'.$info['travel_remain_places'].'</td>
                    <td>'.$info['travelpres_days'].' days </td>
                    <td>'.$info['travelpres_price_adult'].' €</td>
                    <td>'.$info['travelpres_price_child'].' €</td></tr>';
            
            echo $str;
        } 
        
    }

//retourne l'id du vol et sa date de départ pour la sélection de l'utilisateur dans booking
    function getTripOptions($IDDestination){
        $bdd = getPDO();
        $optionInfos = $bdd -> prepare('SELECT travel_ID, travel_depart_date FROM TRAVEL WHERE travelpres_ID = :ID');
        $optionInfos -> bindParam(':ID', $IDDestination);
        $optionInfos -> execute();
        $options = $optionInfos -> fetchAll(PDO::FETCH_ASSOC);
        foreach($options as $option){
            $str = '';
            $str .= '<option value="'.$option['travel_ID'].'">'.$option['travel_ID'].', '.$option['travel_depart_date'].'</option>';
            echo $str;
        }
    }

//retourne l'image de la destination pour le fond de booking suivant la destination choisie
    function getImageDestinations($IDDestination){
        $bdd = getPDO();
        $imgDestination = $bdd -> prepare('SELECT travelpres_img_url FROM TRAVELPRES WHERE travelpres_ID = :ID');
        $imgDestination -> bindParam(':ID', $IDDestination);
        $imgDestination -> execute();
        $imgURL = $imgDestination -> fetch(PDO::FETCH_ASSOC);
        echo 'background="'.$imgURL['travelpres_img_url'].'"';
    }

//vérification nombre de places réservées sont dispo
    function areAvailable($totalPlaces, $travelID){
        $bdd = getPDO();
        $getPlaces = $bdd -> prepare('SELECT travel_remain_places FROM TRAVEL WHERE travel_ID = :travelID');
        $getPlaces -> bindParam(":travelID", $travelID);
        $getPlaces -> execute();
        $placesTemp = $getPlaces -> fetch(PDO::FETCH_ASSOC);

        $places = $placesTemp - $totalPlaces;
        if($places >= 0){
            return true;
        }
        return false;
    }

//calcul du prix total que l'utilisateur doit payer
    function getPrice($nbAdults, $nbChildren, $travelID){
        $bdd = getPDO();
        $getDestinationID = $bdd -> prepare('SELECT travelpres_ID FROM TRAVEL WHERE travel_ID = :travelID');
        $getDestinationID -> bindParam(":travelID", $travelID);
        $getDestinationID -> execute();
        $destinationID = $getDestinationID -> fetch(PDO::FETCH_ASSOC);

        $getPrices = $bdd -> prepare('SELECT travelpres_price_child, travelpres_price_adult FROM TRAVELPRES WHERE travelpres_ID = :destinationID');
        $getPrices -> bindParam(":destinationID", $destinationID['travelpres_ID']);
        $getPrices -> execute();
        $prices = $getPrices -> fetch(PDO::FETCH_ASSOC);

        $childPrice = $prices['travelpres_price_child'] * $nbChildren;
        $adultPrice = $prices['travelpres_price_adult'] * $nbAdults;

        $totalPrice = $childPrice + $adultPrice;

        return $totalPrice;
    }

//réservation des places
    function bookTrip($totalPlaces, $travelID){
        $bdd = getPDO();
        $getPlaces = $bdd -> prepare('SELECT travel_remain_places FROM TRAVEL WHERE travel_ID = :travelID');
        $getPlaces -> bindParam(":travelID", $travelID);
        $getPlaces -> execute();
        $placesTemp = $getPlaces -> fetch(PDO::FETCH_ASSOC);

        $places = $placesTemp['travel_remain_places'] - $totalPlaces;

        $request = $bdd -> prepare('UPDATE TRAVEL SET travel_remain_places = :places WHERE travel_ID = :travelID');
        $request -> bindParam(":places", $places);
        $request -> bindParam("travelID", $travelID);
        $request -> execute();
    }

//ajoute le voyage réservé à l'utilisateur
    function addTripToUser($userID, $travelID, $totalPlaces){
        $bdd = getPDO();
        $request = $bdd -> prepare('INSERT INTO USERSBOOKING (userbooking_booking_date, userbooking_nbr_places, user_ID, travel_ID) VALUES (CURRENT_DATE, :places, :userID, :travelID)');
        $request -> bindParam(":places", $totalPlaces);
        $request -> bindParam(":userID", $userID);
        $request -> bindParam(":travelID", $travelID);
        $request -> execute();
    }

//retourne l'ID de la destination a partir de l'ID du voyage
    function getDestinationID($travelID){
        $bdd = getPDO();
        $destination = $bdd -> prepare('SELECT travelpres_ID FROM TRAVEL WHERE travel_ID = :ID');
        $destination -> bindParam(':ID', $travelID);
        $destination -> execute();
        $destinationID = $destination -> fetch(PDO::FETCH_ASSOC);
        return $destinationID['travelpres_ID'];
    }

?>