<?php

require '../db/Availability.php';

$start = $_POST['timeStart'];


$end = $_POST['timeEnd'];

$id = $_POST['user_id'];



$objAva = new Availability;

$objAva->setMentorId($id);

$objAva->setStartTime($start);

$objAva->setEndTime($end);

$objAva->saveDate();

$data = [

        "event_type_id" => 2,
        "created_by" => "mentor",
        "event_start_time" => $start,
        "event_name" => "assignment",
        "event_end_time" => $end,
        "event_description" => "time to take assignment",
        "batch_id" => 1,
        "modul_id" => 1
];

$payload = json_encode($data);

var_dump($payload);




$ch = curl_init('https://q4optgct.directus.app/items/events');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 
// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload))
);
 
// Submit the POST request
$result = curl_exec($ch);
echo '<br> <br>';
var_dump($result);
 
// Close cURL session handle
curl_close($ch);


header("location: ../frontend/pages/mentor_set_schedule.php ");

?>