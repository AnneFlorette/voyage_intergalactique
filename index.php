<?php 
    include 'functions.php';
    session_start();

    $messageData = [];

    if (isset($_GET["logOut"])){
        $messageData = ["You have been logged out", "img/trobiGood.png", "SUCCESS"];
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <link rel="stylesheet" type="text/css" href="css/styleIndex.css">
    <link rel="stylesheet" href="css/styleWaiting.css">
    <link rel="stylesheet" type="text/css" href="css/styleMessageCard.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Far Away</title>
</head>
<body>
    <script type="text/javascript" src="messageCard.js"></script>
    <?php
        changeNavIndex();
    ?>
    <div id="titleBox">
        <h1>Far Away</h1>
        <p id="caption">Go deeper in Space</p>
    </div>
    <ul class="wrapper">
        <div class="sun">
            <div class="star"></div>
        </div>
        <div class="mercury">
            <div class="planet">
            <div class="shadow"></div>
            </div>
        </div>
        <div class="venus">
            <div class="planet">
            <div class="shadow"></div>
            </div>
        </div>
        <div class="earth">
            <div class="planet"><div class="shadow"></div></div>
        </div>
        <div class="mars">
            <div class="planet"><div class="shadow"></div></div>
        </div>
        <div class="jupiter">
            <div class="planet"><div class="shadow"></div></div>
        </div>
    </ul>
    <div id="buttonBox">
        <a href="ourDestinations.php"><button id="discoverTrip">Our Destinations</button></a>
        <a href="ourCompany.php"><button id="ourCompany">Our Company</button></a>
    </div>
    
    <div id="messageContainer"></div>

    <script>
        
        let jArray = <?php echo json_encode($messageData); ?>;

        console.log(jArray)

        messageType = getMessageType()

        str = jArray[0]
        img = jArray[1]
        msgType = messageType[jArray[2]]

        if (jArray.length != 0){
            displayMessageCard(str, img, msgType, document.getElementById("messageContainer"))
        }

    </script>
</body>
</html>