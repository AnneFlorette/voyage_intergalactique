<?php
    include 'functionsAdmin.php';
    session_start();

//Verification que la Sessiona active est bien celle de l'Admin
    if(!checkAdminSession()){
        header('location: index.php');
    }

    $destinations = getDestinations();

    $dataArray = [];
    foreach($destinations as $destination){
        $rowArray = [];
        $pourcentSitReserved = getPourcentSitReserved($destination["travelpres_ID"]);
        if($pourcentSitReserved !== null){
            array_push($rowArray, $destination["travelpres_destination"]);
            array_push($rowArray, $pourcentSitReserved);
            array_push($dataArray, $rowArray);
        }
    }
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">


    google.charts.load('current', {'packages':['corechart']})
    google.charts.setOnLoadCallback(drawChart)

    function getDataArray() {
        let jArray = <?php echo json_encode($dataArray); ?>;
        let dataArray = []
        for(let i = 0; i < jArray.length; i++){
            let rowArray = [];
            rowArray.push(jArray[i][0])
            rowArray.push(jArray[i][1])
            dataArray.push(rowArray)
        }
        return dataArray
    }

    function drawChart() {

        dataArray = getDataArray();
        dataArray.splice(0, 0, ['Destination', 'In pourcent'])
        console.log(dataArray)

        let data = google.visualization.arrayToDataTable(dataArray)

        let options = {
        title: 'Title',
        backgroundColor: 'transparent'
        }

        let chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }

</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/styleStatistics.css">
        <title>Document</title>
    </head>
    <body>
        <?php changeNav() ?>

        <div id="generalStats">
            <h3>General Statistics</h3>
            <table>
                <tr>
                    <th>Number of registered users</th>
                    <th>Number of reserved places</th>
                    <th>Number of flights over</th>
                    <th>Income</th>
                </tr>
                <tr>
                    <td>
                        <?php echo getNbrUser(); ?>
                    </td>
                    <td>
                        <?php echo getNbrReservedSit(); ?>
                    </td>
                    <td>
                        <?php echo getNbrFinisedTravel(); ?>
                    </td>
                    <td>
                        <?php echo getIncome().'€'; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div id="particularStats">
            <div id="completionStats">
                <h3>Completion Statistics</h3>
                <table>
                    <?php
                        echo    "<tr>" .
                                    "<td>" . "Destination name" . "</td>" .
                                    "<td>" . "Pourcent of flight completion" . "</td>" .
                                "</tr>" .
                                "<tr>" .
                                    "<td>" . "Global" . "</td>" .
                                    "<td>" . getPourcentFlightCompletion() . " %</td>" .
                                "</tr>";                
                        foreach($destinations as $destination){
                            echo    "<tr>" .
                                        "<td>" . $destination["travelpres_destination"] . "</td>" .
                                        "<td>" . getPourcentFlightCompletion($destination["travelpres_ID"]) . " %</td>" .
                                    "</tr>";
                        }
                    ?>
                </table>
            </div>
    
            <div id="flightStats">
                <h3>Most Booked Destinations</h3>
                <div id="piechart"></div>
            </div>
        </div>
        

    </body>
</html>