<?php
require './sdk/ApiReportsClient.php';

/**
 * ---------------------------------------------------------------------------
 * COMMENT TITLE
 * ---------------------------------------------------------------------------
 * 
 * COMMENT DESCRIPTION
 * 
 * 
*/

$userId = "{USER_ID}";
$apiKey = "{API_KEY}";

// make some dummy data in order to call vedic rishi api
$data = array(
  'day' => 15,
  'month' => 9,
  'year' => 1994,
  'hour' => 5,
  'min' => 30,
  'lat' => 28.6139,
  'lon' => 77.1025,
  'tzone' => 5.5,
  'name' => 'Sunil'
);

// instantiate ApiReports class
$apiClient = new ApiReportsClient($userId, $apiKey);
$apiClient->setLanguage('en');

$responseData1 = $apiClient->callJsonApi('birth_details',$data);
$responseData2 = $apiClient->callJsonApi('astro_details',$data);
$responseData3 = $apiClient->callJsonApi('planets',$data);



echo $responseData1; //PrintJsonFormat

echo PHP_EOL;echo PHP_EOL;
print_r( json_encode(json_decode($responseData2),JSON_PRETTY_PRINT) ); //JSON Pretty Print

echo PHP_EOL;echo PHP_EOL;
print_r(json_decode($responseData3)).PHP_EOL; //Print PHP Object Array