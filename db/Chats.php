<?php


class Chats {
    // Chats properties
    private $chat_id;
    private $user_id;
    private $message;
    private $group_id;
    private $created_at;
    private $db_conn;


    // Constructor
    public function __construct()
    {
        require_once("DbConnect.php");
        $db = new DbConnect;
        $this->db_conn = $db->connect();
    }

    // Setter & Getter method
    public function getChatId() {
        return $this->chat_id;
    }

    public function setChatId($chat_id) {
        return $this->chat_id = $chat_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        return $this->user_id = $user_id;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        return $this->message = $message;
    }

    public function getGroupId(){
        return $this->group_id;
    }

    public function setGroupId($group_id){
        $this->group_id = $group_id;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        return $this->created_at = $created_at;
    }

    // Insert message to the database
    public function saveChat() {
        $statement = $this->db_conn->prepare('INSERT INTO chats VALUES(null, :user_id, :message, :created_at, :group_id)');
        $statement->bindParam(":user_id", $this->user_id);
        $statement->bindParam(":message", $this->message);
        $statement->bindParam(":group_id", $this->group_id);
        $statement->bindParam(":created_at", $this->created_at);

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


    // Get all chat messages
    public function getAllChat() {
        $statement = $this->db_conn->prepare("SELECT * FROM chats INNER JOIN users ON chats.user_id = users.user_id");
        $statement->execute();
        $chatsData = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $chatsData;
    }

    // Get Chat by Group_id
    public function getChatByGroup($group_id){
        $statement = $this->db_conn->prepare("SELECT * FROM chats INNER JOIN users ON chats.user_id = users.user_id WHERE group_id = :group_id ");
        $statement->bindParam(":group_id", $group_id);
        $statement->execute();
        $chatsData = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $chatsData;

    }

}