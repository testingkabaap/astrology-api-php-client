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
 * 
 * 
*/

$userId = "{USER_ID}";
$apiKey = "{API_KEY}";

// Prediction Zone Timezone
$data = array(
  'timezone'=>5.5
);

// instantiate ApiReports class
$apiClient = new ApiReportsClient($userId, $apiKey);
$apiClient->setLanguage('en');

// Zodiac Signs Arr
$zodiacSignArr = array(
  "aries",
  "taurus",
  "gemini",
  "cancer",
  "leo",
  "virgo",
  "libra",
  "scorpio",
  "sagittarius",
  "capricorn",
  "aquarius",
  "pisces",
);

$zodiacSign = $zodiacSignArr[0]; //Aries Sign

$todaysPrediction = $apiClient->getTodaysPrediction($zodiacSign, $data['timezone']);
$tomorrowsPrediction = $apiClient->getTomorrowsPrediction($zodiacSign, $data['timezone']);
$yesterdaysPrediction = $apiClient->getYesterdaysPrediction($zodiacSign, $data['timezone']);


// printing the JSON data on the screen/browser
// echo "<pre>";
print_r(json_decode($todaysPrediction));
echo PHP_EOL;
print_r(json_decode($tomorrowsPrediction));
echo PHP_EOL;
print_r(json_decode($yesterdaysPrediction));