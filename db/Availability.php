<?php

class Availability {

    private $availability_id;
    private $mentor_id;
    private $start_time;
    private $end_time;
    private $db_conn;

    public function __construct()
    {
        require_once("DbConnect.php");
        $db = new DbConnect;
        $this->db_conn = $db->connect();
    }

    public function getId(){
        return $this->availability_id;
    }

    public function setId($availability_id){
        return $this->availability_id = $availability_id;
    }

    public function getMentorId(){
        return $this->mentor_id;
    }

    public function setMentorId($mentor_id){
        return $this->mentor_id = $mentor_id;
    }

    public function getStartTime(){
        return $this->start_time;
    }

    public function setStartTime($start_time){
        return $this->start_time = $start_time;
    }

    public function getEndTime(){
        return $this->end_time;
    }

    public function setEndTime($end_time){
        return $this->end_time = $end_time;
    }

    public function saveDate(){
        $sql = $this->db_conn->prepare("INSERT INTO availability VALUES(null, :mentor_id, :start_time, :end_time)");
        $sql->bindParam(":mentor_id", $this->mentor_id);
        $sql->bindParam(":start_time", $this->start_time);
        $sql->bindParam(":end_time", $this->end_time);

        try{
            if($sql->execute()){
                return true;
            }else {
                return false;
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function getDataById($id){
        $sql = $this->db_conn->prepare("select * from availability where mentor_id = $id");

        try{
            if($sql->execute()){
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                return $data;
            }else {
                return false;
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }




}

?>