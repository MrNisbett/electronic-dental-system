<?php
    // необходимые HTTP-заголовки
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // подключение файлов для соединения с БД и файл с объектом User
    include_once '../config/database.php';
    include_once '../objects/user.php';

    // создание подключения к базе данных
    $database = new Database();
    $db = $database->getConnection();

    // инициализация объекта
    $user = new User($db);

    // запрос для получения пользователей
    $stmt = $user->read();
    $num = $stmt->rowCount();

    // проверяем, найдено ли больше 0 записей
    if ($num>0) {

        // массив
        $user_arr=array();
        $user_arr["data"]=array();

        // получим содержимое нашей таблицы
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // извлекаем строку
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

        // код ответа - 200 OK
        http_response_code(200);

        // покажем данные пользователей в формате json
        echo json_encode($user_arr);
    } else {

        // код ответа - 404 Ничего не найдено
        http_response_code(404);

        // сообщим пользователю, что модели не найдены
        echo json_encode(array("message" => "Пользователи не найдены."), JSON_UNESCAPED_UNICODE);
    }
?>
