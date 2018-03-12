<?php
    include 'functionsAdmin.php';
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
        title: 'Title'
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
        <title>Document</title>
    </head>
    <body>
        <div id="generalStats">
            <table>
                <tr>
                    <td>
                        <p>Number of registered users</p>
                        <p>
                            <?php
                                echo getNbrUser();
                            ?>
                        </p>
                    </td>
                    <td>
                        <p>Number of reserved places</p>
                        <p>
                            <?php
                                echo getNbrReservedSit();
                            ?>
                        </p>
                    </td>
                    <td>
                        <p>Number of flights completed</p>
                        <p>
                            <?php
                                echo getNbrFinisedTravel();
                            ?>
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="completionStats">
            <table>
                <?php
                    echo    "<tr>" .
                                "<td>" . "Destination name" . "</td>" .
                                "<td>" . "Pourcent of flight completion" . "</td>" .
                            "</tr>" .
                            "<tr>" .
                                "<td>" . "Global" . "</td>" .
                                "<td>" . getPourcentFlightCompletion() . "</td>" .
                            "</tr>";                
                    foreach($destinations as $destination){
                        echo    "<tr>" .
                                    "<td>" . $destination["travelpres_destination"] . "</td>" .
                                    "<td>" . getPourcentFlightCompletion($destination["travelpres_ID"]) . "</td>" .
                                "</tr>";
                    }
                ?>
            </table>
        </div>

        <div id="flightStats">
            <div id="piechart" style="width: 900px; height: 500px;"></div>
        </div>

    </body>
</html>