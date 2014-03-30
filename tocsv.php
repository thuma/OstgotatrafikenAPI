<?php

file_put_contents('all-ostgotatrafiken-gtfs.csv',"name;lat;lon;id;gtfsid;gtfsname;gtfslat;gtfslon\n");
$data = json_decode(file_get_contents('map-cord-gtfs.json'));
foreach($data as $row){

file_put_contents('all-ostgotatrafiken-gtfs.csv',
$row->Name.";".
$row->Lat.";".
$row->Long.";".
$row->Id.";".
$row->gtfs->id.";".
$row->gtfs->name.";".
$row->gtfs->lat.";".
$row->gtfs->long."\n",FILE_APPEND);
}
?>