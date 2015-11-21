<?php 

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods :GET,POST');
    header('Access-Control-Allow-Headers: Content-Type');

//if((isset($_POST["stadd"])) && (isset($_POST["city"])) && (isset($_POST["statenames"])))
   
    $stadd=$_GET["stadd"];
    $city=$_GET["city"];
    $statenames=$_GET["state"];
    $temp=$_GET["temp"];

    
    $add=$stadd.",".$city.",".$statenames;
    $apiadd=urlencode($add);

    $url="https://maps.googleapis.com/maps/api/geocode/xml?address=".$apiadd."&key=AIzaSyAYguewQ1RrYV9AV2S_v9Exk0dil39lYP4";

    

   // echo $url;
   // $xml = simplexml_load_file("http://maps.google.com/maps/api/geocode/xml?address=".$stadd.",".$city.",".$statenames);
    $xml=simplexml_load_file($url);
        
        
    $latitude=$xml->result->geometry->location->lat;
    //echo "<br>".$latitude;
    $longitude=$xml->result->geometry->location->lng;

    
  
 if($temp=="on")
    {
        $forecastQuery="https://api.forecast.io/forecast/b215c85fab0d5ba22cb373eb89d44197/".$latitude.",".$longitude."?units=si&exclude=flags";
    }
    else if($temp=="us")
    {
        $forecastQuery="https://api.forecast.io/forecast/b215c85fab0d5ba22cb373eb89d44197/".$latitude.",".$longitude."?units=us&exclude=flags";
    }


    $phpform=file_get_contents($forecastQuery);
   
 /* $details = array (
    //"latitude"  => $latitude,
    //"longitude" => $longitude,
    //"query"=>$forecastQuery,
    "forecastdata"=>$retrieveJSON
      
      
);*/

echo $phpform; 

 


    
    


?>
