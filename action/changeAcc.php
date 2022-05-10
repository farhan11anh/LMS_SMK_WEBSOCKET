<?php 

require "../db/Acceptance.php";
require "../db/Users.php";


$accId = $_POST['acc_id'];

$status = $_POST['status'];

// get acceptance
$acc = new Acceptance;

$acc->updateStatus($accId, $status);

$user = $acc->getDataById($accId);
$userId = $user[0]['user_id'];

// get Mentor
$objMentor = new Users;
$objMentor->setId($userId);
$mentor = $objMentor->getUserById();



echo $status;



if ($_POST['status'] == 'active') {
    $email = $user[0]['email'];
    $subject = "Konsultasi Mentor " . $mentor['name'];
    $body = "Pengajuan konsultasimu disetujui, kunjungi link: http://localhost/websocket/web-chat-room/group_chat.php" ;
    $headers = "From: Code Cation <codecationll@gmail.com>";

    if (mail($email, $subject, $body, $headers)) {
        header("location: http://localhost/websocket/web-chat-room/frontend/pages/mentor_approve.php");
    } else {
        echo "email sending failed";
    }
}
if ($_POST['status'] == 'reject') {
    $email = $user[0]['email'];
    $subject = "Konsultasi Mentor " . $mentor['name'];
    $body = "Pengajuan konsultasimu tidak disetujui";
    $headers = "From: Code Cation <codecationll@gmail.com>";

    if (mail($email, $subject, $body, $headers)) {
        header("location: http://localhost/websocket/web-chat-room/frontend/pages/mentor_approve.php");
    } else {
        echo "email sending failed";
    }
}
?>