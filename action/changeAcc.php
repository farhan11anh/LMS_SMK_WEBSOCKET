<?php 

require "../db/Acceptance.php";
require "../db/Users.php";
require "../db/Groups.php";
require "../db/Ports.php";
require "../db/PrivillageGroup.php";


$accId = $_POST['acc_id'];

$status = $_POST['status'];

$studentId = $_POST['student_id'];

// get acceptance
$acc = new Acceptance;

$acc->updateStatus($accId, $status);
$acceptanceId = $acc->getDataById($accId);
$accTopic = $acceptanceId[0]['topic'];

$email = $acceptanceId[0]['email'];

//id mentor acceptance id
$idMentorAcc = $acceptanceId[0]['user_id']; 


$userId = $_POST['id_user'];


// get Mentor
$objMentor = new Users;
$objMentor->setId($userId);
$mentor = $objMentor->getUserById();



echo $status;



if ($_POST['status'] == 'active') {

    // buat grup baru
    $objGroup = new Groups;
    $objGroup->set_group_name($accTopic);
    
    // jika berhasil buat grup
    if($objGroup->makeGroup()){
        //mendapatkan id terakhir dari grup yang telah dibuat
        $latestId = $objGroup->getLatest()[0]['group_id'];

        $objPort = new Ports;
        $objPort->set_status(0);
        $port = $objPort->get_all_free_port();

        if(!empty($port)) {
            foreach($port as $key => $port) {
                if($port['status'] == 0) {
                    $freePort = $port['value'];
                    break;
                }
            }
            $objPort->set_status(1);
            $objPort->set_group_id($latestId);
            $objPort->set_value($freePort);
           
            if( $objPort->update_port_status()){
                $objPriv = new Privillage;
                
                $objPriv->savePrivillage($latestId, $userId);

                $objPriv->savePrivillage($latestId, $studentId);



            }
        } else {
            echo "Port is full!";
        }

        $email = $email;
        $subject = "Konsultasi Mentor " . $mentor['name'];
        $body = "Pengajuan konsultasimu disetujui, kunjungi link: http://localhost/websocket/web-chat-room/group_chat.php";
        $headers = "From: Code Cation <codecationll@gmail.com>";
    
        if (mail($email, $subject, $body, $headers)) {
            header("location: http://localhost/websocket/web-chat-room/frontend/pages/mentor_approve.php");
        } else {
            echo "email sending failed";
        }

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