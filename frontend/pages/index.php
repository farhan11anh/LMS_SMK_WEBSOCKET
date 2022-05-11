<?php
include_once '../../db/Users.php';

session_start();

$objUser = new Users;
$objUser->setEmail($_SESSION['user']);
$orang = $objUser->getUserByEmail();

if($_SESSION['role'] == 2){
    header("location: http://localhost/websocket/web-chat-room/frontend/pages/mentor.php");
}

// get user
$email = $_SESSION['email'];
$response = json_decode(file_get_contents('https://i0ifhnk0.directus.app/items/user?filter={"role_id":2}'), true);
$lectures = $response['data'];



if (!isset($_SESSION['user'])) {
    header("location: login.php");
}




// mendpatkan data user mentor

$mentors = $objUser->getUserMentor();


//mendapatkan data user
$objUser->setEmail($_SESSION['user']);
$user = $objUser->getUserByEmail();

// echo $user['name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Consultation</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.2/dist/flowbite.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    montserrat: ["Montserrat"],
                },
                colors: {
                    "dark-green": "#1E3F41",
                    "light-green": "#659093",
                    "cream": "#DDB07F",
                    "cgray": "#F5F5F5",
                }
            }
        }
    }
    </script>
    <style>
    .in-active {
        width: 80px !important;
        padding: 20px 15px !important;
        transition: .5s ease-in-out;
    }

    .in-active ul li p {
        display: none !important;
    }

    .in-active ul li a {
        padding: 15px !important;
    }

    .in-active h2,
    .in-active h4,
    .in-active .logo-smk {
        display: none !important;
    }

    .hidden {
        display: none !important;
    }

    .sidebar {
        transition: .5s ease-in-out;
    }
    </style>

</head>

<body>
    <div class="flex items-center">
        <!-- Left side (Sidebar) -->
        <div class="bg-white w-[350px] h-screen px-8 py-6 flex flex-col justify-between sidebar in-active">
            <!-- Top nav -->
            <div class="flex flex-col gap-y-6">
                <!-- Header -->
                <div class="flex items-center space-x-4 px-2">
                    <img src="Img/icons/toggle_icons.svg" alt="toggle_dashboard" class="w-8 cursor-pointer"
                        id="btnToggle">
                    <img class="w-[150px] logo-smk" src="../src/logofix.png" alt="Logo In Career">
                </div>

                <hr class="border-[1px] border-opacity-50 border-[#93BFC1]">

                <!-- List Menus -->
                <div>
                    <ul class="flex flex-col gap-y-1">
                        <li>
                            <a href="#"
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="./Img/icons/home_icon.svg" alt="Dashboard Icon">
                                <p class="font-semibold">Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="./Img/icons/course_icon.svg" alt="Course Icon">
                                <p class="font-semibold">Course</p>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="./Img/icons/discussion_icon.svg" alt="Forum Icon">
                                <p class="font-semibold">Forum Dicussion</p>
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="./Img/icons/schedule_icon.svg" alt="Schedule Icon">
                                <p class="font-semibold">Schedule</p>
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="./Img/icons/attendance_icon.svg" alt="Attendance Icon">
                                <p class="font-semibold">Attendance</p>
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="./Img/icons/score_icon.svg" alt="Score Icon">
                                <p class="font-semibold">Score</p>
                            </a>
                        </li>
                        <li>
                            <a href="" class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 bg-cream">
                                <img class="w-5" src="./Img/icons/consult_icon.svg" alt="Consult Icon">
                                <p class="text-white font-semibold">Consult</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom nav -->
            <div>
                <ul class="flex flex-col ">
                    <li>
                        <a href="#"
                            class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                            <img class="w-5" src="./Img/icons/help_icon.svg" alt="Help Icon">
                            <p class="font-semibold">Help</p>
                        </a>
                    </li>
                    <li>
                        <a href="../../logout.php"
                            class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                            <img class="w-5" src="./Img/icons/logout_icon.svg" alt="Log out Icon">
                            <p class="font-semibold">Log out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- Right side -->
        <div class="bg-cgray w-full h-screen px-10 py-6 flex flex-col gap-y-6 overflow-y-scroll">
            <!-- Header / Profile -->
            <div class="flex items-center gap-x-4 justify-end">
                <img class="w-10" src="./Img/icons/default_profile.svg" alt="Profile Image">
                <p class="text-dark-green font-semibold"><?= $_SESSION['user']; ?></p>
            </div>

            <!-- Breadcrumb -->
            <div>
                <ul class="flex items-center gap-x-4">
                    <li>
                        <a class="text-light-green" href="#">Home</a>
                    </li>
                    <li>
                        <span class="text-light-green">/</span>
                    </li>
                    <li>
                        <a class="text-light-green" href="#">Consult</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col sm:flex-row bg-white h-24 sm:h-12 w-full rounded-xl pl-3 sm:pl-5">
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                    class="flex justify-start items-center py-2 pr-4 pl-3 w-2/5 font-medium text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Booking
                    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg></button>
                <!-- Dropdown menu -->
                <div id="dropdownNavbar"
                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Session</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Booking</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="grid justify-items-center gap-4 gap-y-[50px] grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 w-auto">

      
                
 

                <?php
                

                ?>

                <!-- card bimbingan -->
                <?php foreach($lectures as $mentor){ ?>

                    <div class="bg-white h-48 w-full sm:w-4/5 rounded-xl shadow-lg text-center" onclick='bukaModal(<?= $mentor['user_id'] ?>)'
                        data-modal-toggle="defaultModal">
                        <div class="bg-[url('../src/coding2.jpg')] h-32 w-auto rounded-t-xl overflow-hidden bg-cover">
                            <div class="bg-[#DDB07F] w-full h-full bg-opacity-60">
                                <div class="grid place-content-center">
                                    <div class="p-4">
                                        <img src="../src/edwina.png" alt="..."
                                            class="shadow-lg rounded-full align-middle w-24 h-24 border-none" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="ml-5 text-left font-bold text-[#1E3F41]"><?php echo $mentor['user_username'] ?></h3>
                    <h3 class="ml-5 text-left text-[#C4C4C4]">Mentor</h3>
                    </div>

                    
                <?php } ?>





            </div>
            <!-- Main modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full mt-5">
                <div class="relative p-4 w-full max-w-md h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start rounded-t border-b dark:border-gray-600">
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="defaultModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <form class="mt-4 px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="../../action/saveRoom.php" method="post">
                                <h3 class="text-xl font-medium text-gray-900 text-center dark:text-white">Book Your
                                    Appointment</h3>

                                <!-- Mentor -->
                                <div class="flex gap-x-4 py-1 px-10 rounded-xl" id="insert">
                                    
                                    <img class="w-14" src="./Img/icons/default_profile.svg" alt="Profile Image">
                                    <div class="" id="infoUser">
                                        <p class="text-dark-green text-base font-semibold"></p>
                                        <p class="text-light-green">Mentor</p>
                                    </div>
                                </div>
                                <div>
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 -mb-4 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Nama Lengkap" required>
                                </div>
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="bg-gray-50 border border-gray-300 -mb-4 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Email" required>
                                </div>
                                <div>
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Waktu</label>
                                    <div class="timepicker relative form-floating mb-3 w-full"
                                        id="input-toggle-timepicker" data-mdb-toggle-button="false">
                                        <select name="time" id="time" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 -mb-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        </select>
                                        <!-- <input type="text" name="time" id="time"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 -mb-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select a time" data-mdb-toggle="timepicker" /> -->
                                    </div>
                                </div>
                                <div>
                                    <input type="text" hidden id="user_id" value="<?= $_SESSION['id'] ?>">
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Topic</label>
                                    <textarea id="message" rows="4" name="topic"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Leave a comment..."></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" value="success"
                                        class="items-center focus:outline text-white border-yellow-400 bg-yellow-500 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Submit</button>

                                    <button data-modal-toggle="defaultModal" type="button"
                                        class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Cancel</button>
                                </div>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script>
    let btnToggle = document.getElementById('btnToggle');
    let sidebar = document.querySelector('.sidebar');
    btnToggle.onclick = function() {
        sidebar.classList.toggle('in-active');
    }
    </script>

    <script>
        $('#date').click(function(){
            
            console.log($('#date').val())
        })

        $('#time').click(function(){
            
            console.log($('#time').val())
        })


    </script>

    <script>
        
            function bukaModal(id){
                
                $.ajax({
                    method: "POST",
                    data: {
                        user_id: id,
                        send: true 
                    },
                    url: '../../action/requestRoom.php',
                    success: function(data, status){
                        let userData = JSON.parse(data);
                        console.log(userData);

                        let info = '<p class="text-dark-green text-base font-semibold">' + userData.user.user_username + '</p> <p class="text-light-green">Mentor System Analyst</p>';
                        let inputMentor = '<input type="text" value="'+ userData.user.user_id +'" name="id_mentor" hidden>';
                        $('#infoUser').html(info);
                        $('#infoUser').append(inputMentor);

                        $('#time').html('')
                        userData.ava.forEach(e => $('#time').append(`<option value='` + e.start_time+ `' >` + e.start_time+ `</option>`)
);


                    }
                })
            }
        

    </script>

</body>

</html>