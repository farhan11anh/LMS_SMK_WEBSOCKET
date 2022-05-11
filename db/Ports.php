<?php

class Ports {
    // properties for class ports
    private $port_id;
    private $value;
    private $status;
    private $group_id;
    private $db_conn;

    // constructor
    public function __construct()
    {
        require_once("DbConnect.php");
        $db = new DbConnect;
        $this->db_conn = $db->connect();
    }

    public function get_port_id() {
        return $this->port_id;
    }

    public function set_port_id($port_id) {
        $this->port_id = $port_id;
    }

    public function get_value() {
        return $this->value;
    }

    public function set_value($value) {
        $this->value = $value;
    }

    public function get_status() {
        return $this->status;
    }

    public function set_status($status) {
        $this->status = $status;
    }

    public function get_group_id() {
        return $this->group_id;
    }

    public function set_group_id($id) {
        $this->group_id = $id;
    }

    public function get_all_ports() {
        $stmt = $this->db_conn->prepare("SELECT * FROM ports");
        try {
            if($stmt->execute()) {
                $portData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $portData;
    }

    public function get_all_free_port() {
        $stmt = $this->db_conn->prepare("SELECT * FROM ports WHERE status = :status");
        $stmt->bindParam(":status", $this->status);
        try{
            if($stmt->execute()) {
                $freePort = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $freePort;
    }

    public function update_port_status() {
        $stmt = $this->db_conn->prepare("UPDATE ports SET status = :status, group_id = :group_id WHERE value = :value");
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":group_id", $this->group_id);
        $stmt->bindParam(":value", $this->value);

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

    public function get_port_by_group_id() {
        $stmt = $this->db_conn->prepare("SELECT * FROM ports WHERE group_id = :group_id");
        $stmt->bindParam(":group_id", $this->group_id);

        try {
            if($stmt->execute()) {
                $port = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $port;
    }

    public function deletePortStatus($group_id){
        $stmt = $this->db_conn->prepare("UPDATE ports SET status = 0, group_id = 0 WHERE group_id = :group_id");
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