<?php

    class Users {
        // Users properties
        private $id;
        private $name;
        private $email;
        private $password;
        private $login_status;
        private $last_login;
        private $db_conn;


        // Constructor
        public function __construct() {
            require_once("DbConnect.php");
            // Create database connection
            $db = new DbConnect();
            $this->db_conn = $db->connect();
        }

        // Setter & Getter method
        function getId() { 
            return $this->id; 
        }

        function setId($id) { 
            return $this->id = $id; 
        }

        function getName() {
            return $this->name;
        }

        function setName($name) {
            return $this->name = $name;
        }

        function getEmail() {
            return  $this->email;
        }

        function setEmail($email) {
            return $this->email = $email;
        }

        function getPassword() {
            return $this->password;
        }

        function setPassword($password) {
            return $this->password = $password;
        }

        function getLoginStatus() {
            return $this->login_status;
        }

        function setLoginStatus($login_status) {
            return $this->login_status = $login_status;
        }

        function getLastLogin() {
            return $this->last_login;
        }

        function setLastLogin($last_login) {
            return $this->last_login = $last_login;
        }


        // Insert user data to database
        public function insertData() {
            $sql = "INSERT INTO `users`(`user_id`, `name`, `email`, `password`, `login_status`, `last_login`) VALUES (null, :name, :email, :password, :login_status, :last_login)";

            $statement = $this->db_conn->prepare($sql);

            $statement->bindParam(":name", $this->name);
            $statement->bindParam(":email", $this->email);
            $statement->bindParam(":password", $this->password);
            $statement->bindParam(":login_status", $this->login_status);
            $statement->bindParam(":last_login", $this->last_login);

            try {
                if($statement->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // Get user data by email
        public function getUserByEmail() {
            $statement = $this->db_conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(":email", $this->email);
            try {
                if($statement->execute()){
                    $user = $statement->fetch(PDO::FETCH_ASSOC);
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }

            return $user;
        }

        // Get user data by id
        public function getUserById() {
            $statement = $this->db_conn->prepare("SELECT * FROM users WHERE user_id = :id");
            $statement->bindParam(":id", $this->id);
            try {
                if($statement->execute()){
                    $user = $statement->fetch(PDO::FETCH_ASSOC);
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }

            return $user;
        }

        // Update user login status on database
        public function updateLoginStatus() {
            $statement = $this->db_conn->prepare("UPDATE users SET login_status = :login_status, last_login = :last_login WHERE user_id = :id");
            $statement->bindParam(":login_status", $this->login_status);
            $statement->bindParam(":last_login", $this->last_login);
            $statement->bindParam(":id", $this->id);

            try {
                if($statement->execute()){
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        // Get all user data
        public function getAllUser() {
            $statement = $this->db_conn->prepare("SELECT * FROM users");
            $statement->execute();
            $userData = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $userData;
        }

        public function getUserMentor(){
            $statement = $this->db_conn->prepare("SELECT * FROM users WHERE role =2 ");
            $statement->execute();
            $userData = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $userData;
        }

        // Register new user account
        public function registerNewUser($data) {

            $msg = "";
            $is_ok = false;

            // Validate user input
            if(!isset($data['name']) || !is_string($data['name'])) {
                $msg = "Missing name string!";
                goto out;
            }

            if(!isset($data['email']) || !is_string($data['email'])) {
                $msg = "Missing email string!";
                goto out;
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $msg = "Email is not valid! ";
                goto out;
            }

            if(!isset($data['password']) || !is_string($data['password'])) {
                $msg = "Missing password string!";
                goto out;
            }

            if(!isset($data['cpassword']) || !is_string($data['cpassword'])) {
                $msg = "Missing confirm password string";
                goto out;
            }

            if($data['password'] !== $data['cpassword']) {
                $msg = "Password doesn't match!";
                goto out;
            }

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d H:i:s');

            $this->setName($data['name']);
            $this->setEmail($data['email']);
            $this->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
            $this->setLoginStatus(0);
            $this->setLastLogin($date);

            if($this->getUserByEmail() > 0) {
                $msg = "Email {$data['email']} already used";
                goto out;
            }
        
            if($this->insertData()) {
                $msg = "Registration Successfully!";
                $is_ok = true;
            } else {
                $msg = "Registration Failed!";
            }

            out : {
                return [
                    "is_ok" => $is_ok,
                    "msg" => $msg
                ];
            }
        }

        // Login user
        public function loginUser($data) {

            $msg = "";
            $is_ok = false;

            // Valdate user input
            if(!isset($data['email']) || !is_string($data['email'])) {
                $msg = "Missing email string!";
                goto out;
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $msg = "Email is not valid! ";
                goto out;
            }

            if(!isset($data['password']) || !is_string($data['password'])) {
                $msg = "Missing password string!";
                goto out;
            }

            $this->setEmail($data['email']);
            $this->setPassword($data['password']);

            $usersData = $this->getUserByEmail();

            if($usersData < 1) {
                $msg = "Account not found!";
                goto out;
            }

            if(password_verify($this->getPassword(), $usersData['password'])){

                date_default_timezone_set('Asia/Jakarta');
                $this->setLoginStatus(1);
                $this->setLastLogin(date("Y-m-d H:i:s"));
                $userId = $usersData['user_id'];
                $this->setId($userId);
                $this->updateLoginStatus();

                $msg = "Login success";
                $is_ok = true;
            } else {
                $msg = "Login failed, password incorrect!";
            }         

            out : {
                return [
                    "is_ok" => $is_ok,
                    "msg" => $msg
                ];
            }
        }
    }