<?php

class Acceptance{
    private $acceptance_id;
    private $name;
    private $email;
    private $status;
    private $day;
    private $time;
    private $topic;
    private $user_id;
    private $db_conn;

    // Constructor
    public function __construct()
    {
        require_once("DbConnect.php");
        $db = new DbConnect;
        $this->db_conn = $db->connect();
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        return $this->name = $name;
    }

    public function getAcceptanceId(){
        return $this->acceptance_id;
    }

    public function setAcceptanceId($acceptance_id){
        return $this->acceptance_id = $acceptance_id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        return $this->email = $email;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        return $this->status = $status;
    }

    public function getDay(){
        return $this->day;
    }

    public function setDay($day){
        return $this->day = $day;
    }

    public function getTime(){
        return $this->time;
    }

    public function setTime($time){
        return $this->time = $time;
    }

    public function getTopic(){
        return $this->topic;
    }

    public function setTopic($topic){
        return $this->topic = $topic;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        return $this->user_id = $user_id;
    }

    public function saveData(){
        $statement = $this->db_conn->prepare("INSERT INTO acceptance VALUES(null,:name, :email,'disable', :time, :topic, :user_id)");
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':time', $this->time);
        $statement->bindParam(':topic', $this->topic);
        $statement->bindParam(':user_id', $this->user_id);

        try{
            if($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e){
            return $e->getMessage();
        }

    }

    public function getAll(){
        $statement = $this->db_conn->prepare("SELECT * FROM acceptance");

        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getNotApprove(){
        $statement = $this->db_conn->prepare("SELECT * FROM acceptance where status = 'disable'");

        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getApprove(){
        $statement = $this->db_conn->prepare("SELECT * FROM acceptance where not status = 'disable'");

        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getDataById($id){
        $statement = $this->db_conn->prepare("SELECT * FROM acceptance where acceptance_id = $id");

        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function updateStatus($id, $status){
        $statement = $this->db_conn->prepare("UPDATE acceptance SET status = '$status' WHERE acceptance_id = $id");

        try{
            if($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e){
            return $e->getMessage();
        }
    }




}


?>