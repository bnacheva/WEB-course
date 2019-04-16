<?php
$currentUrl = $_SERVER['REQUEST_URI'];
if ($currentUrl == "/api/api.php/register") {
    include 'register.php';
}
else if ($currentUrl == "/api/api.php/users") {
    include 'users.php';
}
else if ($currentUrl == "/api/api.php/user/:email") {
    include 'user.php';
}
else {
    http_response_code(404);
}
?>