<?php

    include("fonctions.php");

    $bd_log = getPDO();
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
                    <button class='booking'>Book this trip</button>
                    </div>
                    </section>";
        echo $str;
    }
?>