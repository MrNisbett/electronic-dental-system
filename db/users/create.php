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

    // создание объекта товара
    include_once '../objects/user.php';


    $database = new Database();
    cors();
    $db = $database->getConnection();

    $user = new User($db);

    // получаем отправленные данные
    $data = json_decode(file_get_contents("php://input"));

    // убеждаемся, что данные не пусты
    if (
        !empty($data)
    ) {

        // устанавливаем значения свойств пользователя
        $user->firstName = $data->firstName;
        $user->secondName = $data->secondName;
        $user->patronymic = $data->patronymic;
        $user->email = $data->email;
        $user->password = $data->password;
        $user->role = $data->role;
        $user->jobTitle = $data->jobTitle;
        $user->phone = $data->phone;

        // создание пользователя
        if($user->create()){

            // установим код ответа - 201 создано
            http_response_code(201);

            // сообщим пользователю
            echo json_encode(array("message" => "Учетная запись создана."), JSON_UNESCAPED_UNICODE);
        }

        // если не удается создать пользователя, сообщим пользователю
        else {

            // установим код ответа - 503 сервис недоступен
            http_response_code(503);

            // сообщим пользователю
            echo json_encode(array("message" => "Невозможно создать учетную запись."), JSON_UNESCAPED_UNICODE);
        }
    }

    // сообщим пользователю что данные неполные
    else {

        // установим код ответа - 400 неверный запрос
        http_response_code(400);

        // сообщим пользователю
        echo json_encode(array("message" => "Невозможно создать учетную запись. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
?>
