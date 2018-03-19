<?php
    include 'functionsAdmin.php';
    session_start();

//Verification que la Session active est bien celle de l'Admin
    if(!checkAdminSession()){
        header('location: index.php');
    }


//création nouvelle destination
    if ((isset($_POST['destination']) && $_POST['destination'] != "") &&
        (isset($_POST['img_url']) && $_POST['img_url'] != "") &&
        (isset($_POST['time']) && $_POST['time'] != "") &&
        (isset($_POST['adultPrice']) && $_POST['adultPrice'] != "") &&
        (isset($_POST['childPrice']) && $_POST['childPrice'] != "") &&
        (isset($_POST['description']) && $_POST['description'] != "")){
            $destination = htmlspecialchars($_POST['destination']);
            $img = 'img/'.htmlspecialchars($_POST['img_url']);
            $description = htmlspecialchars($_POST['description']);
            $travelTime = htmlspecialchars($_POST['time']);
            $adultPrice = htmlspecialchars($_POST['adultPrice']);
            $childPrice = htmlspecialchars($_POST['childPrice']);
            
            createDestination($destination, $img, $description, $travelTime, $adultPrice, $childPrice);

            $messageData = ["New destination created", "img/trobiGood.png", "SUCCESS"];
            
        }

//création nouveau voyage
    if ((isset($_POST['destinations']) && $_POST['destinations'] != "") &&
        (isset($_POST['depart_date']) && $_POST['depart_date'] != "")){
            $destinationID = htmlspecialchars($_POST['destinations']);
            $departDate = htmlspecialchars($_POST['depart_date']);

            createTravel($destinationID, $departDate);

            $messageData = ["New trip created", "img/trobiGood.png", "SUCCESS"];

        }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleAdmin.css">
    <link rel="stylesheet" type="text/css" href="css/styleMessageCard.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <script type="text/javascript" src="messageCard.js"></script>
    <?php changeNav()?>

    <a href="admin.php"><h2>Dashboard</h2></a>

    <div id="dashboard">
        <div id="createDestination">
            <form action="" method="POST">
                <h3>Create a new destination</h3>
                <label for="destination">Name of the destination</label>
                <br>
                <input type="text" name="destination" class="input" autofocus max="40" required>
                <br>
                <label for="img_url">Url of the image</label>
                <br>
                <input type="file" name="img_url" class="input" max="40" required>
                <br>
                <label for="time">Travel time in days</label>
                <br>
                <input type="number" name="time" class="input" required>
                <br>
                <label for="adultPrice">Price for an Adult</label>
                <br>
                <input type="number" name="adultPrice" class="input" required>
                <br>
                <label for="childPrice">Price for a child (+15%)</label>
                <br>
                <input type="number" name="childPrice" class="input" required>
                <br>
                <label for="description">Description of the destination</label>
                <br>
                <textarea rows="8" cols="70" name="description" class="textarea" maxlength="500" required></textarea>
                <br>
                <input type="submit" class="submit" value="Send">
                <br>
            </form>
        </div>
        <div>
            <form action="" method="POST">
                <h3>Create a new trip</h3>
                <label for="destinations">Name of the destination</label>
                <br>
                <select name="destinations" id="destinationSelect">
                    <?php
                        createOption();
                    ?>
                </select>
                <br>
                <label for="depart_date">Date of departure</label>
                <br>
                <input type="date" name="depart_date" class="input" required>
                <br>
                <input type="submit" class="submit" value="Send">
                <br>
            </form>  
        </div>
        <div>
            <form action="" method="POST">
                <h3>Search a user</h3>
                    <label for="search">Enter a user's last name</label>
                    <br>
                    <input type="text" name="search" class="input" max="40">
                    <br>
                    <br>
                    <input type="submit" value="Send" class="submit" id="sendUsers">
                    <br>
            </form>
            <div id="searchUsers">
                <?php
                    if(isset($_POST['search'])){
                        $search = htmlspecialchars($_POST['search']);
                        echo '<table id="table">';
                        searchUsers($search);
                        echo '</table>';
                    }
                ?> 
            </div>
        </div>
        <!-- affichage des prochains vols -->
        <div>
            <h3>Next trips</h3>
            <div id="nextTrips">
                <table>
                    <tr>
                        <th>Travel's ID</th>
                        <th>Destination</th>
                        <th>Depart Date</th>
                        <th>Remain places</th>
                    </tr>
                    <?php
                        getNextTravels();
                    ?>
                </table>
            </div>
        </div>
        <div id="popUp">
            <div class="popUp_block">
                <form action="" method="POST">
                    <p>Warning ! You're about to delete an account. Are you sure ?</p>
                    <button type="submit" id="yes" class="btnYesNo" name="delete" value="">YES</button>
                    <button type="submit" class="btnYesNo" name="notDelete" value="">NO</button>
                </form>
            </div>
        </div>
        <script>
            const sendUsers = document.getElementById('sendUsers')
            const popUp = document.getElementById('popUp')
            const btnYes = document.getElementById('yes')
            let idToDelete = null
            let row
            

            function display() {
                popUp.style.display = 'block'
            }

            function listenOnYesButton(id) {
                btnYes.addEventListener('click', function() {
                    btnYes.value = id
                })
            }

            function countRow(){
                row = document.getElementsByClassName('trUsers').length
                if(row > 0) {
                    for(i = 0; i < row; i++){
                        let deleteButtonEl = document.getElementsByClassName('delete')[i]
                        deleteButtonEl.addEventListener('click', () => {
                            idToDelete = deleteButtonEl.value
                            display()
                            listenOnYesButton(idToDelete)
                        }, false)
                    }
                }
            } 

            sendUsers.addEventListener('click', countRow, false)         
            
        </script>
        <?php
    // Suppression du compte
        if(isset($_POST['delete']) && $_POST['delete'] != ""){
            $ID = htmlspecialchars($_POST['delete']);
            deleteAccount($ID);
        } else if(isset($_POST['notDelete'])) {
            echo "<script>popUp.style.display = 'none'</script>";
        }
        ?>
    </div>

    <div id="messageContainer" class = "messageContainer"></div>

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