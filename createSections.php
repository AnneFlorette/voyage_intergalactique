<?php

    include("functions.php");

    $bd_log = getPDO();
    $travels = $bd_log -> query("SELECT * FROM TRAVELPRES") -> fetchall(PDO::FETCH_ASSOC);

    $index = 0;
    foreach($travels as $travel){
        $str = "";
        $str .= "  <section class='planete' style='background-image: url(". $travel['travelpres_img_url'] .");' ";
        if ($index === 0){
            $str .= "id=firstPlanete";
        }
        $str .= "   ><div class='left'><h4>" . $travel['travelpres_destination'] . "</h4>
                    <p>" . $travel['travelpres_description'] . "</p>
                    <p>" . $travel['travelpres_destination_time'] . "H</p>
                    <button class='booking'>Book this trip</button>
                    </div>
                    </section>";
        echo $str;
    }
?>