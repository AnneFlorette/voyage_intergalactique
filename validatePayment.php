<?php
    include 'functions.php';
    session_start();

//Verification qu'il y a bien une session active'
    if(!checkSession()){
            header('location: index.php');
        }
        
//validation du paiement et validation réservation des places
    $nbAdults = $_SESSION['nbAdults']; 
    $nbChildren = $_SESSION['nbChildren'];
    $travelID = $_SESSION['travelID'];

    $price = getPrice($nbAdults, $nbChildren, $travelID);
    $destinationID = getDestinationIDByBDD($travelID);
    $totalPlaces = $nbAdults + $nbChildren;

    if(isset($_GET['validate'])){
        bookTrip($totalPlaces, $travelID);
        addTripToUser($_SESSION['ID'], $travelID, $nbAdults, $nbChildren, $price);
        //faire popUp de validation de paiement
        header('location: profil.php');
    }else if(isset($_GET['cancel'])){
        header('location: booking.php?ID='.$destinationID);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleValidatePayment.css">
    <title>Validate Payment</title>
</head>
<body <?php getImageDestinations(getDestinationIDByBDD($_SESSION['travelID'])); ?>>
    <div id="validation">
        <table id="validationTable">        
            <tr><td>Last name:</td><td><?php echo ' '.getLastName($_SESSION['ID']); ?></td></tr>
            <tr><td>First name:</td><td><?php echo ' '.getFirstName($_SESSION['ID']); ?></td></tr>
            <tr><td>Booking's date:</td><td><?php echo ' '.date("Y-m-d"); ?></td></tr>
            <tr><td>Departure's date:</td><td><?php echo ' '.getTripDate($_SESSION['travelID']); ?></td></tr>
            <tr><td>Travel's time:</td><td><?php echo ' '.getTravelTime(getDestinationIDByBDD($travelID)).' days'; ?></td></tr>
            <tr><td>Number of adult places:</td><td><?php echo ' '.$_SESSION['nbAdults']; ?></td></tr>
            <tr><td>Number of child places:</td><td><?php echo ' '.$_SESSION['nbChildren']; ?></td></tr>
            <tr><td>Total price:</td><td><?php echo ' '.$price.' €'; ?></td></tr>
        </table>
        <input id="validate" type="submit" class="btn" name="validate" value="Validate payment">
        <input id="cancel" type="submit" class="btn" name="cancel" value="Cancel payment">
    </div>

    <div id="divRocket"><img id="imgRocket" src="img/rocket.png"></div>

    <script>
    
        const btnVal = document.getElementById("validate")
        const btnCan = document.getElementById("cancel")
        const rocket = document.getElementById("imgRocket")
        
        let i = 0
        let j = 0
        let speed = 0
        let angle = 0

        btnVal.addEventListener("click", () => {
            interval = setInterval(() => {
                i += 0.4
                speed = i * i
                rocket.style.bottom = speed + "px"
                if(parseFloat(rocket.style.bottom, 10) > screen.height){
                    clearInterval(interval)
                    document.location.href="validatePayment.php?validate"
                }
            }, 30)
        }, false)

        btnCan.addEventListener("click", () => {
            interval = setInterval(() => {
                if (i == 0){
                    rocket.src = "img/rocketFall.gif"
                }else if (i == 1){
                    rocket.style.width = "192px"
                }else if (i == 42){
                    rocket.src = "img/rocketFall.png"
                }
                if (i > 30){
                    j += 0.2
                    speed = j * j
                    rocket.style.left = speed + "px"
                    if (parseFloat(rocket.style.left, 10) > screen.width){
                        clearInterval(interval)
                        document.location.href="validatePayment.php?cancel"
                    }
                }
                i++
            }, 10)
        }, false)

    </script>

</body>
</html>