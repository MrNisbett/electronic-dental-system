<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../objects/ticket.php';
    cors();

    $database = new Database();
    $db = $database->getConnection();

    $order = new Ticket($db);

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data)
    ) {

        $order->patient = $data->patient;

        if($order->userTickets()){

            $stmt = $order->userTickets();
            $order_arr = array();
            $order_arr["data"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $order_arr_item = array(
                "id" => $id,
                "patient" => html_entity_decode($patient),
                "doctor" => html_entity_decode($doctor),
                "time" => html_entity_decode($time),
                "date" => html_entity_decode($date),
            );

            array_push($order_arr['data'], $order_arr_item);
        }

            http_response_code(201);
            echo json_encode($order_arr);
        }
        else {

            http_response_code(503);
            echo json_encode(array("message" => "Невозможно создать учетную запись."), JSON_UNESCAPED_UNICODE);
        }
    }

    else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно создать учетную запись. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
?>
