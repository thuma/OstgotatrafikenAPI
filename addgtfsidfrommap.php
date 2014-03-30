<?php
require_once dirname(__FILE__) . '/gtfs-stop-reader/getstopname.php';

$all = json_decode(file_get_contents('allfrommap.json'));
$all = $all->alla;

foreach($all as $key => $station)
	{
		if(isset($all[$key]->gtfs) == FALSE OR $all[$key]->gtfs->id == NULL){
			print "\n".$all[$key]->Name.' -->  ';
			$stop = getClosestStation(floatval($all[$key]->Lat),floatval($all[$key]->Long));
			$all[$key]->gtfs = new stdClass;
			$all[$key]->gtfs->id = $stop->stop_id;
			$all[$key]->gtfs->name = $stop->stop_name;
			$all[$key]->gtfs->lat = $stop->stop_lat;
			$all[$key]->gtfs->long = $stop->stop_lon;
			print $stop->stop_name;
		}
	}
file_put_contents('map-cord-gtfs.json',json_encode($all));
?>