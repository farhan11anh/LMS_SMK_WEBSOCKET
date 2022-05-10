<?php

    require "../db/Users.php";
    require "../db/Availability.php";




    if(!empty($_POST['send'])){
        $objUser = new Users;

        $_POST['user_id'];
    
        $objUser->setId($_POST['user_id']);
    
        $response = json_decode(file_get_contents('https://i0ifhnk0.directus.app/items/user?filter={"user_id":"' .$_POST['user_id'].'"}'), true);
        $userData = $response['data'];

        $objAva = new Availability;

        $avaData = $objAva->getDataById($_POST['user_id']);

        $data = [
            'ava' => $avaData,
            'user' => $userData
        ];

        echo JSON_encode($data);
    }




?>