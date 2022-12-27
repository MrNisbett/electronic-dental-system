<?php
    class Ticket{

        // соединение с БД и таблицей 'ticket'
        private $conn;
        private $table_name = "ticket";

        // свойства объекта
        public $id;
        public $patient = null;
        public $doctor = null;
        public $time = null;
        public $date = null;

        public function __construct($db){
            $this->conn = $db;
        }

        // метод create - создание номерка
        function create(){
            // запрос для вставки (создания) записей
            $query = "INSERT INTO
                        " . $this->table_name . " (patient, doctor, time, date)
                    VALUES(
                        '$this->patient',
                        '$this->doctor',
                        '$this->time',
                        '$this->date')";

            // подготовка запроса
            $stmt = $this->conn->prepare($query);

            // выполняем запрос
            $executeData = (bool)$stmt->execute();


            if ($executeData) {
                return true;
            }

            return false;
        }
        // метод read - получение данных из таблицы
        public function read(){

            // выбираем все данные
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

        // метод userTickets - получение номерков только для одного пользователя
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
