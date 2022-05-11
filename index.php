<?php

session_start();

if($_SESSION['role'] == 3){
    header("location: http://localhost/websocket/web-chat-room/frontend/pages");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Wellcome to Codecation</h1>
</body>
</html>