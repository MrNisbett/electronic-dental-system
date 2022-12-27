<?php
    // необходимые HTTP-заголовки
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // получаем соединение с базой данных
    include_once '../config/database.php';

    // создание объекта пользователя
    include_once '../objects/user.php';
    cors();

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    // получаем отправленные данные
    $data = json_decode(file_get_contents("php://input"));

    // убеждаемся, что данные не пусты
    if (
        !empty($data)
    ) {

        // устанавливаем значения свойств пользователя
        $user->email = $data->email;
        $user->password = $data->password;


        if($user->findUser()){

            $stmt = $user->findUser();
            $user_arr = array();
            $user_arr["data"] = array();

        // получим содержимое нашей таблицы
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // извлекаем строку
            extract($row);

            $user_arr_item = array(
                "id" => $id,
                "firstName" => html_entity_decode($firstName),
                "secondName" => html_entity_decode($secondName),
                "patronymic" => html_entity_decode($patronymic),
                "email" => html_entity_decode($email),
                "role" => html_entity_decode($role),
                "phone" => html_entity_decode($phone),
            );

            array_push($user_arr['data'], $user_arr_item);
        }

            // установим код ответа - 200 успешно
            http_response_code(200);

            // сообщим пользователю
            echo json_encode($user_arr);
        }

        // если не удается найти пользователя, сообщим пользователю
        else {

            // установим код ответа - 503 сервис недоступен
            http_response_code(503);

            // сообщим пользователю
            echo json_encode(array("message" => "Невозможно найти учетную запись."), JSON_UNESCAPED_UNICODE);
        }
    }

    // сообщим пользователю что данные неполные
    else {

        // установим код ответа - 400 неверный запрос
        http_response_code(400);

        // сообщим пользователю
        echo json_encode(array("message" => "Невозможно найти учетную запись. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
?>
