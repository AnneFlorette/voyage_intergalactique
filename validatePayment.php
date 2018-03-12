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
    <title>Document</title>
</head>
<body>
    <div>
        <h3>Number of adult places you want: <?php echo $nbAdults ?></h3>
        <h3>Number of child places you want: <?php echo $nbChildren ?></h3>
        <h3>Total price: <?php echo $price ?> €</h3>
        <form action="" method="post">
            <input type="submit" class="btn" name="validate" value="Validate payment">
            <input type="submit" class="btn" name="cancel" value="Cancel payment">
        </form>
    </div>
</body>
</html>