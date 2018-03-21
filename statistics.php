<?php
    include 'functionsAdmin.php';
    session_start();

//Verification que la Session active est bien celle de l'Admin
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

//création du diagramme
    function drawChart() {
        dataArray = getDataArray();
        dataArray.splice(0, 0, ['Destination', 'In pourcent'])
        let data = google.visualization.arrayToDataTable(dataArray)
        let options = {
            backgroundColor: 'transparent',
            legend:{
                textStyle:{
                    color: 'white',
                    fontSize: 16
                }
            },
            chartArea:{
                width: '100%',
                height: '100%'
            }
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
        <title>Statistics</title>
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
                        echo    "<thead id='completionHead'><tr>" .
                                    "<th>" . "Destination name" . "</th>" .
                                    "<th>" . "Pourcent of flight completion" . "</th>" .
                                "</tr></thead>" .
                                "<tbody id='completionBody'><tr>" .
                                    "<td>" . "Global" . "</td>" .
                                    "<td>" . getPourcentFlightCompletion() . " %</td>" .
                                "</tr>";                
                        foreach($destinations as $destination){
                            echo    "<tr>" .
                                        "<td>" . $destination["travelpres_destination"] . "</td>" .
                                        "<td>" . getPourcentFlightCompletion($destination["travelpres_ID"]) . " %</td>" .
                                    "</tr>";
                        }
                        echo "</tbody>";
                    ?>
                </table>
            </div>
            <div id="flightStats">
                <h3>Favorites Destinations</h3>
                <div id="piechart"></div>
            </div>
        </div>
    </body>
</html>