<?php

include_once '../../db/Users.php';
include_once '../../db/Acceptance.php';
include_once '../../db/Availability.php';


session_start();

$objUser = new Users;
$objUser->setEmail($_SESSION['user']);
$orang = $objUser->getUserByEmail();

var_dump($_SESSION['role']);

if($_SESSION['role'] == 3){
    header("location: http://localhost/websocket/web-chat-room/frontend/pages");
}

if (!isset($_SESSION['user'])) {
    header("location: login.php");
}


//mendapatkan data user
$objUser->setEmail($_SESSION['user']);
$user = $objUser->getUserByEmail();

var_dump($_SESSION['user']);


// availability
$objAva = new Availability;
$dataAva = $objAva->getDataById($_SESSION['id']);
var_dump($dataAva); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Page</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
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
                        <a href="#"
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
                <p class="text-dark-green font-semibold"><?= $_SESSION['user'] ?></p>
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
                    <li>
                        <span class="text-light-green">/</span>
                    </li>
                    <li>
                        <a class="text-light-green font-semibold" href="#">Book</a>
                    </li>
                </ul>
            </div>
            <div class="bg-white w-full h-[50px] flex content-center px-10  rounded-xl">
                <ul class="flex items-center gap-x-8">
                    <a href="mentor_approve.php">
                        <li
                            class="text-dark-green text-cream border-b-4 border-cream h-[50px] flex items-center font-semibold  cursor-pointer">
                            <p>Session</p>
                        </li>
                    </a>
                    <a href="mentor.php">
                        <li
                            class="text-dark-green hover:text-cream hover:border-b-4 hover:border-cream h-[50px] flex items-center font-semibold  cursor-pointer">
                            Booking</li>
                    </a>
                </ul>
            </div>
            <div class="flex flex-row-reverse ...">
                <button onclick='openModal(<?= $_SESSION['id'] ?>,"<?= $_SESSION['user'] ?>")'
                    class="px-4 py-2 text-sm font-medium text-center text-blue-700 hover:text-white border border-blue-700 rounded-lg hover:bg-blue-800 mb-2 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    data-modal-toggle="defaultModal">Atur
                    jadwal</button>
            </div>
            <div>
                <table class="shadow-lg bg-white rounded-xl" style="width: 100%">
                    <colgroup>
                        <col span="1" style="width: 10%">
                        <col span="1" style="width: 10%">
                        <col span="1" style="width: 10%">
   
                    </colgroup>
                    <thead>
                        <tr class="text-dark-green">
                            <th class="border-b text-center px-4 py-2">Waktu Mulai</th>
                            <th class="border-b text-center px-4 py-2">Waktu Selesai</th>
                            <th class="border-b text-center px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($dataAva as $data){ ?>
                        <tr>
                            <td class="border-b px-4 py-2 text-center"><?= $data['start_time'] ?></td>
                            <td class="border-b px-4 py-2 text-center"><?= $data['end_time'] ?></td>
                            <td class="border-b px-4 py-2 text-center">
                                <button
                                    class="ml-1 text-white border border-red-700 bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 cursor-not-allowed">Not
                                    Approved
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal form mentor -->
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
                        <form class="mt-4 px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="../../action/sendTime.php" method="post">
                            <h3 class="text-xl font-medium text-gray-900 text-center dark:text-white">Set Your
                                Schedule</h3>

                            <!-- Mentor -->
                            <div class="flex gap-x-4 py-1 px-10 rounded-xl">
                                <img class="w-14" src="./Img/icons/default_profile.svg" alt="Profile Image">
                                <div class="">
                                    <p class="text-dark-green text-base font-semibold" id="mentorName">Edwina Christy | 0018990
                                    </p>
                                    <p class="text-light-green">Mentor System Analyst</p>
                                </div>
                            </div>
                            
                         
                                <div>
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Waktu
                                        Mulai</label>
                                    <div class="timepicker relative form-floating mb-3 w-full" id="input-toggle-timepicker"
                                        data-mdb-toggle-button="false">
                                        <input type="datetime-local" step="0.001" name="timeStart"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 -mb-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select a time"/>
                                    </div>
                                </div>
                                <div>
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Waktu
                                        Selesai</label>
                                    <div class="timepicker relative form-floating mb-3 w-full" id="input-toggle-timepicker"
                                        data-mdb-toggle-button="false">
                                        <input type="datetime-local" step="0.001" name="timeEnd"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 -mb-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select a time" />
                                    </div>
                                    <input type="text" name="user_id" value="<?= $_SESSION['id'] ?>" hidden>
                                </div>
                                <div class="text-center">
                                    <button type="submit" 
                                        class=" items-center focus:outline-none border border-yellow-400 text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Accept</button>

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

    <script>
    
        function openModal(id, uname){

            $('#mentorName').html(uname);

            console.log(uname)
            $.ajax({
                method: "POST",
                data: {
                    user_id: id,
                    send: true
                },
                url: '../../action/schedule.php',
                success: function(data, status){
                    
                    console.log(JSON.parse(data));

                    let user = JSON.parse(data);

                    let name = user.name;

                    $('#mentorName').html(name);
                    

                }

                
            })

            function sendForm(id){
                console.log(id)
                $.ajax({
                    method: "POST",
                    data: {
                        user_id: id
                    },
                    url: '../../action/sendTime.php',
                    success: function(data, status){

                    }
                })
            }
            
        }

    </script>

    <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script>
    let btnToggle = document.getElementById('btnToggle');
    let sidebar = document.querySelector('.sidebar');
    btnToggle.onclick = function() {
        sidebar.classList.toggle('in-active');
    }
    </script>

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.2/dist/flowbite.min.css" />

</body>

</html>