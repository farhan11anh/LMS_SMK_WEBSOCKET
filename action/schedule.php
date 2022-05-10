<?php

require '../db/Users.php';
$id = $_POST['user_id'];

$objUser = new Users;
$objUser->setId($id);

$user = $objUser->getUserById();

echo json_encode($user);


?>