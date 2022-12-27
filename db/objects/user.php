<?php
    class User{

        // соединение с БД и таблицей 'users'
        private $conn;
        private $table_name = "users";

        // свойства объекта
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

        function test() {

        }

        // метод create - создание пользователя
        function create(){
            // запрос для вставки (создания) записей
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
                        id, firstName, secondName, patronymic, email, role, phone
                    FROM
                        " . $this->table_name . "
                    ORDER BY
                        id";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            return $stmt;
        }

        // метод findUser - поиск пользователя по логину и паролю, для авторизации
        public function findUser(){

            // выбираем все данные
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
