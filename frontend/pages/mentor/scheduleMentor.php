<?php

include_once '../../../db/Users.php';
include_once '../../../db/Acceptance.php';
include_once '../../../db/Availability.php';

session_start();

$objUser = new Users;
$objUser->setEmail($_SESSION['user']);
$orang = $objUser->getUserByEmail();


if (!isset($_SESSION['user'])) {
    header("location: login.php");
}


//mendapatkan data user
$objUser->setEmail($_SESSION['user']);
$user = $objUser->getUserByEmail();




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
    <title>Mentor Add Schedule</title>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>

    <h3>Ketersediaan Waktu Bimbingan</h3>
     <table border="1">
         
         <thead>
            <tr>
                 <td>Start Time</td>
                 <td>End Time</td>
            </tr>
        </thead>
        <tbody id="body">
           <?php foreach($dataAva as $data){ ?>
                <tr>
                    <td><?= $data['start_time'] ?></td>
                    <td><?= $data['end_time'] ?></td>
                </tr>
           <?php } ?>
        </tbody>
     </table>

     <b></b> <hr> <br>

     <h3>Fill The Form</h3>

     <form action="action/action.php" method="post">
         <label for="startTime">
             Start Time :
            <input type="datetime-local" name="startTime" id="startTime">
         </label> <br>

         <label for="endTime">
             End Time :
             <input type="datetime-local" name="endTime" id="endTime">
         </label><br>

         <input type="text" name="mentor_id" id="mentorId" hidden value="<?= $_SESSION['id'] ?>">
         <button type="submit" name="submit" id="submit">Submit</button>
     </form>

     <script>
         $(document).ready(function(){
             $('#submit').click(function(e){
                e.preventDefault();
                let start = $('#startTime').val();
                let end = $('#endTime').val();
                let id = $('#mentorId').val();

                let isi = `<tr>
                 <td>`+ start +`</td>
                 <td>` + end + `</td>
            </tr>`
                
                $('#body').append(isi);
                

                $.ajax({
                    method:'post',
                    data: {
                        id : id,
                        start : start,
                        end : end,
                        submit : 'submit'
                    }, 
                    url: 'action/action.php',
                    success: function(data, status){

                    }
                })

                console.log(id);
             })
         })
     </script>

</body>
</html>