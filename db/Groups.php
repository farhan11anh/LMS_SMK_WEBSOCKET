<?php

class Groups {
    private $group_id;
    private $group_name;
    private $status;
    private $db_conn;

    public function __construct() 
    {
        require_once("DbConnect.php");
        $conn = new DbConnect;
        $this->db_conn = $conn->connect();
    }

    public function get_group_id() {
        return $this->group_id;
    }

    public function set_group_id($id) {
        $this->group_id = $id;
    }

    public function get_group_name() {
        return $this->group_name;
    }

    public function set_group_name($name) {
        $this->group_name = $name;
    }

    public function get_status() {
        return $this->status;
    }

    public function set_status($status) {
        $this->status = $status;
    }

    public function get_all_groups() {
        $stmt = $this->db_conn->prepare("SELECT * FROM groups");
        try {
            if($stmt->execute()) {
                $groupsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $groupsData;
    }

    public function filterGroup($user_id){
        $stmt = $this->db_conn->prepare("SELECT * FROM groups join privillage_group on groups.group_id = privillage_group.group_id where privillage_group.user_id = $user_id");

        try {
            if($stmt->execute()) {
                $groupsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $groupsData;
    }

    public function makeGroup(){
        $statement = $this->db_conn->prepare('INSERT INTO groups VALUES(null, :group_name, 0)');
        $statement->bindParam(":group_name", $this->group_name);

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

    public function getLatest(){
        $stmt = $this->db_conn->prepare("SELECT * FROM groups order by group_id desc limit 1");
        try {
            if($stmt->execute()) {
                $groupsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $groupsData;
    }

}