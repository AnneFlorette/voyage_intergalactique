<?php
    include 'functions.php';
    session_start();


//validation du paiement et validation réservation des places
    $nbAdults = $_SESSION['nbAdults']; 
    $nbChildren = $_SESSION['nbChildren'];
    $travelID = $_SESSION['travelID'];

    $price = getPrice($nbAdults, $nbChildren, $travelID);
    $destinationID = getDestinationID($travelID);
    $totalPlaces = $nbAdults + $nbChildren;

    if(isset($_POST['validate']) && $_POST['validate'] == "Validate payment"){
        bookTrip($totalPlaces, $travelID);
        addTripToUser($_SESSION['ID'], $travelID, $nbAdults, $nbChildren);
        //faire popUp de validation de paiement
        header('location: profil.php');
    }else if(isset($_POST['cancel']) && $_POST['cancel'] == "Cancel payment"){
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
<body <?php getImageDestinations(getDestinationID($_SESSION['travelID'])); ?>>
    <div id="validation">
        <form action="" method="post">
            <tr><td>Last name:</td><td><?php getLastName($_SESSION['ID']); ?></td></tr>
            <tr><td>First name:</td><td><?php getFirstName($_SESSION['ID']); ?></td></tr>
            <tr><td>Booking's date:</td><td><?php echo ' '.date("Y-m-d"); ?></td></tr>
            <tr><td>Departure's date:</td><td><?php  ?></td></tr>
            <tr><td>Travel's time:</td><td><?php  ?></td></tr>
            <tr><td>Number of adult places:</td><td><?php  ?></td></tr>
            <tr><td>Number of child places:</td><td><?php  ?></td></tr>
            <tr><td>Total price:</td><td><?php  ?></td></tr>
            <input type="submit" class="btn" name="validate" value="Validate payment">
            <input type="submit" class="btn" name="cancel" value="Cancel payment">
        </form>
    </div>
</body>
</html>