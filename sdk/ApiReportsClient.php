<?php

/*
| ---------------------------------------------------------
| Astrology API Reports Clien SDK
| ---------------------------------------------------------
|
|
|
|
*/
class ApiReportsClient {

	private $userId = null;
  private $apiKey = null;
  private $language = "en";
  private $jsonApiUrl = 'https://json.apireports.com/v1';
  private $pdfApiUrl = 'https://pdf.apireports.com/v1';

  /*
  | ---------------------------------------------------------
  | 
  | ---------------------------------------------------------
  |
  |
  |
  |
  */
  public function __construct($uid, $key) {
    $this->userId = $uid;
    $this->apiKey = $key;
  }

  /*
  | ---------------------------------------------------------
  | Function to set the response language
  | ---------------------------------------------------------
  | 
  |	Just call this functoion and you can change the reponse
  | language.
  |
  |	This function should be passed either 'en' for English or
  | 'hi' for Hindi etc.
  |
  */
  public function setLanguage( $lang ) {
    $this->language = $lang;
  }


  /*
  | ---------------------------------------------------------
  | 
  | ---------------------------------------------------------
  |
  |
  |
  |
  */
  public function getTimeZone( $timezone_id, $is_dst="false" ) {
  	$res = json_decode($this->callJsonApi('timezone',array('timezone_id'=>$timezone_id,'is_dst'=>$is_dst)));
  	if( isset($res->data->timezone) ) return $res->data->timezone;
  	else return 0;
  }


  /*
  | ---------------------------------------------------------
  | 
  | ---------------------------------------------------------
  | 
  | 
  | 
  | 
  */
  public function callJsonApi($apiEndPoint,$data) {

  	$serviceUrl = $this->jsonApiUrl.'/'.$apiEndPoint.'/';
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $serviceUrl);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	  $header = array(
      'Authorization: Basic '. base64_encode($this->userId.":".$this->apiKey),
      'Accept-Language: '.$this->language,
      'Content-Type: application/json'
    );
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	  curl_setopt($ch, CURLOPT_POST, 1);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	  $response = curl_exec($ch);
    $error = curl_error($ch);
    $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
	  curl_close($ch);
	  return $response;
  }


  public function getTodaysPrediction($zodiacSign, $timezone = 5.5) {
    $resource = 'sun_sign_prediction/daily/'.$zodiacSign;
    return $this->callJsonApi($resource, array('timezone'=>$timezone));
  }
  public function getTomorrowsPrediction($zodiacSign, $timezone = 5.5) {
    $resource = 'sun_sign_prediction/next/'.$zodiacSign;
    return $this->callJsonApi($resource, array('timezone'=>$timezone));
  }
  public function getYesterdaysPrediction($zodiacSign, $timezone = 5.5) {
    $resource = 'sun_sign_prediction/previous/'.$zodiacSign;
    return $this->callJsonApi($resource, array('timezone'=>$timezone));
  }
  


  /*
  | ---------------------------------------------------------
  | 
  | ---------------------------------------------------------
  | 
  | 
  | 
  | 
  */
  public function callPdfApi($apiEndPoint,$data) {

  	$serviceUrl = $this->pdfApiUrl.'/'.$apiEndPoint.'/';
	  $ch = curl_init();
	  curl_setopt($ch,CURLOPT_URL, $serviceUrl);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $header = array(
      'Authorization: Basic '. base64_encode($this->userId.":".$this->apiKey),
      'Accept-Language: '.$this->language,
      'Content-Type: application/json'
    );
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	  curl_setopt($ch, CURLOPT_POST, 1);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	  $response = curl_exec($ch);
		// $http_result = curl_exec($ch);
    $error = curl_error($ch);
    $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
	  curl_close($ch);
	  return $response;
  }

}