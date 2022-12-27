<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/ticket.php';

    $database = new Database();
    $db = $database->getConnection();

    $ticket = new Ticket($db);

    $stmt = $ticket->read();
    $num = $stmt->rowCount();

    if ($num>0) {

        $ticket_arr=array();
        $ticket_arr["data"]=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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

        http_response_code(200);

        echo json_encode($ticket_arr);
    } else {

        http_response_code(404);
        echo json_encode(array("message" => "Модели не найдены."), JSON_UNESCAPED_UNICODE);
    }
?>
