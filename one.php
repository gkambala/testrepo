<?php

$url1 = curl_init();


curl_setopt($url1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url1, CURLOPT_URL, 'http://www.cartoonnetwork.com/test/backend-quiz/games.json');

$url2 = curl_init();

curl_setopt($url2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($url2, CURLOPT_URL, 'http://www.cartoonnetwork.com/test/backend-quiz/shows.json');


$result = curl_exec($url1);
$result1= curl_exec($url2);
curl_close($url1);
curl_close($url2);

$array1 = json_decode($result, true);
$array2 = json_decode($result1,true);

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
            $array2["shows"][$i]['yaswanth']= 'test' . $i;
        }

    }
    //echo "High score is " . $array2["shows"][$i]['game'];
    $i=$i+1;
}
echo  $array2["shows"][0]['highscore'];
// Displaying all the values combined in show
foreach( $array2["shows"] as $show){

    echo "<b>" . $show['id'] . "</b><br/>";
    echo "<b>" .$show['show'] . "</b><br/>";
    echo "<b>" . $show['game'] . "</b><br/>";
    echo "<b>" . $show['user'] . "</b><br/>";
    echo "<b>" . $show['yaswanth'] . "</b><br/>";
    echo "<b>" . $show['highscore'] . "</b><br/><br/><br/><br/>";


}

?>