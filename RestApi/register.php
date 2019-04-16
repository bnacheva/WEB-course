<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'C:\xampp\htdocs\api\database.php';
include_once 'C:\xampp\htdocs\api\object.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
$data = json_decode(file_get_contents("php://input"));
$pattern  = "/^[а-яА-Я]+$/u";
if(
    !empty($data->email) &&
    !empty($data->firstname) &&
    !empty($data->lastname) &&
    !empty($data->password) &&
    (preg_match($pattern, $data->firstname)) &&
    (preg_match($pattern, $data->lastname)) &&
    (strlen($data->email) <= 255) &&
    (strlen($data->firstname) <= 100) &&
    (strlen($data->lastname) <= 100) &&
    (strlen($data->password) <= 2056)
){

    $user->email = $data->email;
    $user->firstname = $data->firstname;
    $user->lastname = $data->lastname;
    $user->password = $data->password;

    if($user->registerUser()) {
        http_response_code(201);
        echo json_encode(array("message" => "Successful registration."));
    }

    else {
        http_response_code(503);
        echo json_encode(array("error" => "Unable to register new user. Already exists."));
    }
}

else {
    http_response_code(400);
    echo json_encode(array("error" => "Unable to register new user. Data is wrong or incomplete."));
}
