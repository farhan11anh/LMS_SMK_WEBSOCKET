<?php

require "../db/Acceptance.php";


if(!empty($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $time = $_POST['time'];
    $topic = $_POST['topic'];
    $mentor = $_POST['lectureId'];
    $student = $_POST['studentId'];

    $objAcc = new Acceptance;
    $objAcc->setName($name);
    $objAcc->setEmail($email);
    $objAcc->setTime($time);
    $objAcc->setTopic($topic);
    $objAcc->setUserId($mentor);
    $objAcc->setStudentId($student);



    echo $name; echo '<br>';
    echo $email; echo '<br>';
    echo $date; echo '<br>';


    if($objAcc->saveData()){
        echo 'berhasil disimpan';
        header("Location: http://localhost/websocket/web-chat-room/frontend/pages");
    } else {
        echo 'gagal simpan';
    }
}



?>