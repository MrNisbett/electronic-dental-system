<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';

    include_once '../objects/user.php';


    $database = new Database();
    cors();
    $db = $database->getConnection();

    $order = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data)
    ) {

        $order->firstName = $data->firstName;
        $order->secondName = $data->secondName;
        $order->patronymic = $data->patronymic;
        $order->email = $data->email;
        $order->password = $data->password;
        $order->role = $data->role;
        $order->jobTitle = $data->jobTitle;
        $order->phone = $data->phone;

        if($order->create()){

            http_response_code(201);

            echo json_encode(array("message" => "Учетная запись создана."), JSON_UNESCAPED_UNICODE);
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
