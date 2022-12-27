<?php
    // необходимые HTTP-заголовки
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // получаем соединение с базой данных
    include_once '../config/database.php';
    // создание объекта номерка
    include_once '../objects/ticket.php';


    $database = new Database();
    cors();
    $db = $database->getConnection();

    $order = new Ticket($db);

    // получаем отправленные данные
    $data = json_decode(file_get_contents("php://input"));

    // убеждаемся, что данные не пусты
    if (
        !empty($data)
    ) {

        // устанавливаем значения свойств номерка
        $order->patient = $data->patient;
        $order->doctor = $data->doctor;
        $order->time = $data->time;
        $order->date = $data->date;

        // создание номерка
        if($order->create()){

            // установим код ответа - 201 создано
            http_response_code(201);

            // сообщим пользователю
            echo json_encode(array("message" => "Номерок создан."), JSON_UNESCAPED_UNICODE);
        }

        // если не удается создать марку, сообщим пользователю
        else {

            // установим код ответа - 503 сервис недоступен
            http_response_code(503);

            // сообщим пользователю
            echo json_encode(array("message" => "Невозможно создать номерок."), JSON_UNESCAPED_UNICODE);
        }
    }

    // сообщим пользователю что данные неполные
    else {

        // установим код ответа - 400 неверный запрос
        http_response_code(400);

        // сообщим пользователю
        echo json_encode(array("message" => "Невозможно создать номерок. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
?>
