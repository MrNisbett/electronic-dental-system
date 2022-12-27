<?php
    // необходимые HTTP-заголовки
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // подключение файлов для соединения с БД и файл с объектом Category
    include_once '../config/database.php';
    include_once '../objects/ticket.php';

    // создание подключения к базе данных
    $database = new Database();
    $db = $database->getConnection();

    // инициализация объекта
    $ticket = new Ticket($db);

    // запрос для номерков
    $stmt = $ticket->read();
    $num = $stmt->rowCount();

    // проверяем, найдено ли больше 0 записей
    if ($num>0) {

        // массив
        $ticket_arr=array();
        $ticket_arr["data"]=array();

        // получим содержимое нашей таблицы
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // извлекаем строку
            extract($row);

            $ticket_item=array(
                "id" => $id,
                "patient" => html_entity_decode($patient),
                "doctor" => html_entity_decode($doctor),
                "time" => html_entity_decode($time),
                "date" => html_entity_decode($date),
            );

            array_push($ticket_arr["data"], $ticket_item);
        }

        // код ответа - 200 OK
        http_response_code(200);

        // покажем данные номерков в формате json
        echo json_encode($ticket_arr);
    } else {

        // код ответа - 404 Ничего не найдено
        http_response_code(404);

        // сообщим пользователю, что модели не найдены
        echo json_encode(array("message" => "Номерки не найдены."), JSON_UNESCAPED_UNICODE);
    }
?>
