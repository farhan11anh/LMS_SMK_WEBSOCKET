<?php

require "../db/Acceptance.php";


if(!empty($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $topic = $_POST['topic'];
    $mentor = $_POST['id_mentor'];

    $objAcc = new Acceptance;
    $objAcc->setName($name);
    $objAcc->setEmail($email);
    $objAcc->setDay($date);
    $objAcc->setTime($time);
    $objAcc->setTopic($topic);
    $objAcc->setUserId($mentor);


    echo $name; echo '<br>';
    echo $email; echo '<br>';
    echo $date; echo '<br>';


    if($objAcc->saveData()){
        echo 'berhasil disimpan';
        header("Location: http://localhost/websocket/web-chat-room/frontend/pages?message='success'");
    } else {
        echo 'gagal simpan';
    }
}



?>