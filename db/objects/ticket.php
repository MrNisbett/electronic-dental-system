<?php
    class Ticket{
        private $conn;
        private $table_name = "ticket";

        public $id;
        public $patient = null;
        public $doctor = null;
        public $time = null;
        public $date = null;

        public function __construct($db){
            $this->conn = $db;
        }

        function create(){
            $query = "INSERT INTO
                        " . $this->table_name . " (patient, doctor, time, date)
                    VALUES(
                        '$this->patient',
                        '$this->doctor',
                        '$this->time',
                        '$this->date')";

            $stmt = $this->conn->prepare($query);

            $executeData = (bool)$stmt->execute();


            if ($executeData) {
                return true;
            }

            return false;
        }

        public function read(){

            $query = "SELECT
                        *
                    FROM
                        " . $this->table_name . "
                    ORDER BY
                        id";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            return $stmt;
        }

        public function userTickets(){

            $query = "SELECT
                        *
                    FROM
                        " . $this->table_name . "
                    WHERE patient = '$this->patient'";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            return $stmt;
        }

    }
?>
