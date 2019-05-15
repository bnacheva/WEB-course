<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once 'database.php';
include_once 'object.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$stmt = $user->readAllUsers();
$num = $stmt->rowCount();

if ($num > 0) {

    $users_arr = array();
    $users_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $user_item = array(
            "email" => $email,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "password" => $password,
            "role" => $role
        );

        array_push($users_arr["records"], $user_item);
    }

    http_response_code(200);
    echo json_encode($users_arr, JSON_UNESCAPED_UNICODE);
}

else {
    http_response_code(404);
    echo json_encode(
        array("error" => "No users found.")
    );
}
