<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';

    include_once '../objects/user.php';
    cors();

    $database = new Database();
    $db = $database->getConnection();

    $order = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data)
    ) {

        $order->email = $data->email;
        $order->password = $data->password;


        if($order->findUser()){

            $stmt = $order->findUser();
            $order_arr = array();
            $order_arr["data"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $order_arr_item = array(
                "id" => $id,
                "firstName" => html_entity_decode($firstName),
                "secondName" => html_entity_decode($secondName),
                "patronymic" => html_entity_decode($patronymic),
                "email" => html_entity_decode($email),
                "role" => html_entity_decode($role),
                "phone" => html_entity_decode($phone),
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
