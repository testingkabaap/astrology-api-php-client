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
  'm_day' => 15,
  'm_month' => 9,
  'm_year' => 1994,
  'm_hour' => 5,
  'm_min' => 30,
  'm_lat' => 28.6139,
  'm_lon' => 77.1025,
  'm_tzone' => 5.5,
  'f_name' => 'Sunil',
  'f_day' => 25,
  'f_month' => 2,
  'f_year' => 1996,
  'f_hour' => 12,
  'f_min' => 15,
  'f_lat' => 28.6139,
  'f_lon' => 77.1025,
  'f_tzone' => 5.5,
  'f_name' => 'Suman'
);

// instantiate ApiReports class
$apiClient = new ApiReportsClient($userId, $apiKey);
$apiClient->setLanguage('en');

$responseData1 = $apiClient->callJsonApi('match_birth_details',$data);
$responseData2 = $apiClient->callJsonApi('match_astro_details',$data);
$responseData3 = $apiClient->callJsonApi('match_planet_details',$data);

echo "<pre>";

echo $responseData1; //PrintJsonFormat

echo PHP_EOL;echo PHP_EOL;
print_r( json_encode(json_decode($responseData2),JSON_PRETTY_PRINT) ); //JSON Pretty Print

echo PHP_EOL;echo PHP_EOL;
print_r(json_decode($responseData3)).PHP_EOL; //Print PHP Object Array