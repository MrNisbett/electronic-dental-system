<?php
    class User{

        private $conn;
        private $table_name = "users";

        public $id;
        public $firstName = null;
        public $secondName = null;
        public $patronymic = null;
        public $email = null;
        public $password = null;
        public $role = null;
        public $phone = null;
        public $jobTitle = 'patient';

        public function __construct($db){
            $this->conn = $db;
        }

        function create(){
            $query = "INSERT INTO
                        " . $this->table_name . " (firstName, secondName, patronymic, email, password, role, phone, jobTitle)
                    VALUES(
                        '$this->firstName',
                        '$this->secondName',
                        '$this->patronymic',
                        '$this->email',
                        '$this->password',
                        '$this->role',
                        '$this->phone',
                        '$this->jobTitle')";

            $stmt = $this->conn->prepare($query);

            $executeData = (bool)$stmt->execute();


            if ($executeData) {
                return true;
            }

            return false;
        }

        public function read(){

            $query = "SELECT
                        id, firstName, secondName, patronymic, email, role, phone
                    FROM
                        " . $this->table_name . "
                    ORDER BY
                        id";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            return $stmt;
        }

        public function findUser(){

            $query = "SELECT
                        id, firstName, secondName, patronymic, email, role, phone
                    FROM
                        " . $this->table_name . "
                    WHERE email = '$this->email' AND password = '$this->password'";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            return $stmt;
        }

    }
?>
