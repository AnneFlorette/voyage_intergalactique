<?php

    try{
        $bd_log = new PDO ("mysql:host=localhost;dbname=voyageinterg;charset=utf8", "root", "root");
    } catch(Exception $err){
        die("Debug: probleme de bdd");
    }

    $travels = $bd_log -> query("SELECT * FROM travel") -> fetchall(PDO::FETCH_ASSOC);

    $index = 0;
    foreach($travels as $travel){
        $str = "";
        $str .= "  <section class='planete' style='background-image: url(". $travel['travel_img_url'] .");' ";
        if ($index === 0){
            $str .= "id=first_planete";
        }
        $str .= "   ><div class='left'><h4>" . $travel['travel_destination'] . "</h4>
                    <p>" . $travel['travel_description'] . "</p>
                    <p>Number of places: " . $travel['travel_places'] . "</p>
                    <button class='booking'>Book this trip</button>
                    </div>
                    </section>";
        echo $str;
    }
?>