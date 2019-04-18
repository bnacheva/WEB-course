<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordagain = $_POST['passwordagain'];
    $json['message'] = "Валидни данни!";
    echo json_encode($json);
?>