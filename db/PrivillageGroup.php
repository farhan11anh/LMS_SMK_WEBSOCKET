<?php

class Privillage {
    private $privillage_group_id;
    private $status;
    private $group_id;
    private $user_id;

    public function __construct() 
    {
        require_once("DbConnect.php");
        $conn = new DbConnect;
        $this->db_conn = $conn->connect();
    }

    public function savePrivillage($group_id, $user_id){
        $statement = $this->db_conn->prepare('INSERT INTO privillage_group VALUES(null, 1, :group_id, :user_id)');

        $statement->bindParam(':group_id', $group_id);
        $statement->bindParam(':user_id', $user_id);

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

    public function deletePrivillage($group_id){
        $stmt = $this->db_conn->prepare("UPDATE privillage_group SET status = 0, group_id = 0, user_id = 0 WHERE group_id = :group_id");
        $stmt->bindParam(":group_id", $group_id);

        try {
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

?>