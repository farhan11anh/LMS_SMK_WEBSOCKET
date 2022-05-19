<?php 
session_start();
require "./db/Users.php";

// Session check
if(isset($_SESSION['user'])) {
    header("location: ./");
}

if(isset($_POST['login'])) {
    $loginResponse['is_ok'] = true;

    $loginResponse['msg'] = 'login success';

    if($loginResponse['is_ok']) {

        // panggil api, untuk mendapatkan data user

        $email = $_POST['email'];
        // var_dump($email);

        // abbil data dari rest API
        $response = json_decode(file_get_contents('https://i0ifhnk0.directus.app/items/user?filter={"user_email":"' .$email.'"}'), true);
        // var_dump($response);

        $userRespon = $response['data'];
        var_dump($userRespon[0]['user_email']);
        

        if(!empty($userRespon)){
            // var_dump($userRespon);

            // validate pw
            if ($userRespon[0]['user_password'] == $_POST['password']){
                echo 'success';
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['user'] = $userRespon[0]['user_username'];
                $_SESSION['role'] = $userRespon[0]['role_id'];
                $_SESSION['id'] = $userRespon[0]['user_id'];
                // var_dump($_SESSION);
                $_SESSION['status'] = "login";

                if($_SESSION['role'] == 3) {
                    header('locaction: http://localhost/websocket/web-chat-room/frontend/pages/mentor_set_schedule.php');
                } 

                if($_SESSION['role'] == 2) {
                    header('locaction: http://localhost/websocket/web-chat-room/frontend/pages/');
                }  

                header('location: frontend/pages');
            }else {
                echo 'password tidak tepat';
            }

            
        }else{
            echo 'login failed';
        }

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="w-10/12 sm:w-8/12 md:w-6/12 lg:w-5/12 xl:w-4/12 max-h-max mx-auto shadow-lg shadow-gray-200 rounded-lg border p-10 mt-10">
        <img class="h-20 w-20 mx-auto" src="./img/icons/login.svg" alt="Login Icon">
        <h1 class="text-center font-semibold">Login User</h1>

        <!-- Form login user -->
        <form class="mt-8 flex flex-col gap-y-4" action="" method="POST">
            <div class="flex flex-col">
                <label class="text-sm" for="email">Email</label>
                <input class="h-10 pl-2 outline-none border border-gray-200 rounded-lg focus:border-blue-500" type="email" name="email" id="email">
            </div>
            <div class="flex flex-col">
                <label class="text-sm" for="password">Password</label>
                <input class="h-10 pl-2 outline-none border border-gray-200 rounded-lg focus:border-blue-500" type="password" name="password" id="password">
            </div>
            <button class="bg-blue-500 hover:bg-blue-600 w-full py-2 rounded-lg text-white font-semibold" type="submit" name="login">Login</button>
        </form>
        <div class="flex flex-col text-center mt-5">
            <p>Don't have an account yet?</p>
            <a class="text-blue-500 font-semibold hover:text-blue-600" href="./register.php">Sign up</a>
        </div>
    </div>
</body>
</html>