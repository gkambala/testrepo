<?php
/**
 * Created by PhpStorm.
 * User: yaswa
 * Date: 11/8/2016
 * Time: 4:25 PM
 */


// Name: Yaswanth Pamuru



// JSON data URL links below
$requestUrl="http://www.cartoonnetwork.com/test/backend-quiz/games.json";
$requestUrl1="http://www.cartoonnetwork.com/test/backend-quiz/shows.json";

//Access the JSON data from URL
$data=file_get_contents($requestUrl);
$data1=file_get_contents($requestUrl1);

// json_decode - convert into array
$array1 = json_decode($data, true);
$array2 = json_decode($data1,true);

//echo " id is " .$array1["games"][0]["id"];

$i=0;
// Loops through shows Jsno data format
foreach( $array2["shows"] as $show){

    // Loops through games Jsno data format
    foreach ($array1["games"] as $game){

        // Check if the id is same as show
        if( $show['id'] == $game['id'])

        {

            // Add Games Json data into Json Show data by key.

            $array2["shows"][$i]['game']= $game['game'];
            $array2["shows"][$i]['user']= $game['user'];
            $array2["shows"][$i]['highscore']= $game['highscore'];
        }

    }
    //echo "High score is " . $array2["shows"][$i]['game'];
    $i=$i+1;
}


// Displaying all the values combined in show
foreach( $array2["shows"] as $show){

    echo "<b>" . $show['id'] . "</b><br/>";
    echo "<b>" .$show['show'] . "</b><br/>";
    echo "<b>" . $show['game'] . "</b><br/>";
    echo "<b>" . $show['user'] . "</b><br/>";
    echo "<b>" . $show['highscore'] . "</b><br/><br/><br/><br/>";

}

//var_dump($array2);

?>