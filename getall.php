<?php
$positions = file_get_contents('positions.csv');

$positions = preg_split('/\n/',$positions);

$ch = curl_init('http://www.ostgotatrafiken.se/rest/TravelHelperWebService.asmx/GetNearestStopArea');
curl_setopt($ch , CURLOPT_HTTPHEADER, array('Origin: http://www.ostgotatrafiken.se'
, 'Accept-Encoding: gzip,deflate,sdch' 
, 'Host: www.ostgotatrafiken.se' 
,'Accept-Language: sv-SE,sv;q=0.8,en-US;q=0.6,en;q=0.4,es;q=0.2' 
,'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36' 
, 'Content-Type: application/json; charset=UTF-8' 
, 'Accept: application/json, text/javascript, */*; q=0.01' 
, 'Referer: http://www.ostgotatrafiken.se/' 
, 'X-Requested-With: XMLHttpRequest' 
, 'Connection: keep-alive') );
curl_setopt($ch , CURLOPT_RETURNTRANSFER, true);
$all = array();
foreach($positions as $position){

$parts = preg_split('/;/',$position);
curl_setopt($ch , CURLOPT_POSTFIELDS, '{\'lat\' : \''.$parts[0].'\', \'lng\' : \''.$parts[1].'\' }' );
$result = json_decode(curl_exec($ch));
print_r($result);
if($result->d != null){
	$all[] = $result;
	file_put_contents('allunsorted.json',json_encode($all));
	}
}
?>