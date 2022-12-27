<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/user.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $stmt = $user->read();
    $num = $stmt->rowCount();

    if ($num>0) {

        $user_arr=array();
        $user_arr["data"]=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $user_item=array(
                "id" => $id,
                "firstName" => html_entity_decode($firstName),
                "secondName" => html_entity_decode($secondName),
                "patronymic" => html_entity_decode($patronymic),
                "email" => html_entity_decode($email),
                "role" => html_entity_decode($role),
                "phone" => html_entity_decode($phone),
            );

            array_push($user_arr["data"], $user_item);
        }

        http_response_code(200);

        echo json_encode($user_arr);
    } else {
        http_response_code(404);

        echo json_encode(array("message" => "Модели не найдены."), JSON_UNESCAPED_UNICODE);
    }
?>
