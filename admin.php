<?php
    include 'functionsAdmin.php';
    session_start();


//création nouvelle destination
    if ((isset($_POST['destination']) && $_POST['destination'] != "") &&
        (isset($_POST['img_url']) && $_POST['img_url'] != "") &&
        (isset($_POST['description']) && $_POST['description'] != "")){
            $destination = htmlspecialchars($_POST['destination']);
            $img = htmlspecialchars($_POST['img_url']);
            $description = htmlspecialchars($_POST['description']);
            createDestination($destination, $img, $description);
        }
//création nouveau voyage
        if ((isset($_POST['destination']) && $_POST['destination'] != "") &&
            (isset($_POST['depart_time']) && $_POST['depart_time'] != "") &&
            (isset($_POST['total_places']) && $_POST['total_places'] != "") &&
            (isset($_POST['remain_places']) && $_POST['remain_places'] != "") &&
            (isset($_POST['spaceship_type']) && $_POST['spaceship_type'] != "") &&
            (isset($_POST['total_time']) && $_POST['total_time'] != "") &&
            (isset($_POST['travelpres_ID']) && $_POST['travelpres_ID'] != "")){
                $destination = htmlspecialchars($_POST['destination']);
                $departTime = htmlspecialchars($_POST['depart_time']);
                $totalPlaces = htmlspecialchars($_POST['total_places']);
                $remainPlaces = htmlspecialchars($_POST['remain_places']);
                $spaceshipType = htmlspecialchars($_POST['spaceship_type']);
                $totalTime = htmlspecialchars($_POST['total_time']);
                $travelpresID = htmlspecialchars($_POST['travelpres_ID']);
                createTravel($destination, $departTime, $totalPlaces, $remainPlaces, $spaceshipType, $totalTime, $travelpresID);
            }
//affichage de différentes stats

//gestion des utilisateurs

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
    
</body>
</html>