<?php

$positions = json_decode(file_get_contents('allunsorted.json'));
$all = array();
$all2 = array();

foreach($positions as $position){
	$stop  = new stdClass;
	$stop->name = $position->d->Name;
	$stop->lat = $position->d->Lat;
	$stop->long = $position->d->Long;
	$stop->id = $position->d->Id;
	$all[$stop->id] = $stop;
}

foreach($all as $position){
	$all2[] = $position;
}

file_put_contents('all-sorted.json',json_encode($all2));

?>