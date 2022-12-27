<?php
    // необходимые HTTP-заголовки
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // получаем соединение с базой данных
    include_once '../config/database.php';

    // создание объекта номерка
    include_once '../objects/ticket.php';
    cors();

    $database = new Database();
    $db = $database->getConnection();

    $ticket = new Ticket($db);

    // получаем отправленные данные
    $data = json_decode(file_get_contents("php://input"));

    // убеждаемся, что данные не пусты
    if (
        !empty($data)
    ) {

        // устанавливаем значения свойств заказа
        $ticket->patient = $data->patient;

        if($ticket->userTickets()){

            $stmt = $ticket->userTickets();
            $ticket_arr = array();
            $ticket_arr["data"] = array();

        // получим содержимое нашей таблицы
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // извлекаем строку
            extract($row);

            $ticket_arr_item = array(
                "id" => $id,
                "patient" => html_entity_decode($patient),
                "doctor" => html_entity_decode($doctor),
                "time" => html_entity_decode($time),
                "date" => html_entity_decode($date),
            );

            array_push($ticket_arr['data'], $ticket_arr_item);
        }

            // установим код ответа - 201 создано
            http_response_code(201);

            // сообщим пользователю
            echo json_encode($ticket_arr);
        }

        // если не удается создать номерок, сообщим пользователю
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
