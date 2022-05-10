<?php
    require '../../../../db/Availability.php';

    $id = $_POST['id'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $objAva = new Availability;
    $objAva->setMentorId($id);
    $objAva->setStartTime($start);
    $objAva->setEndTime($end);
    $objAva->saveDate();

    var_dump('hola');
    


?>