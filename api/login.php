<?php
require_once 'db.php';
require_once 'user.php';
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

$username = isset($_GET['username']) ? $_GET['username'] : "";
$password = isset($_GET['password']) ? $_GET['password'] : "";

            $user = new User($username, $password);

if ($user->loginSuccess) {
    $content = $user->content;
    $userId = $content['username'];
    $public_key = '5f2b5cdbe5194f10b3241568fe4e2b24';
//create a token
            $token = array(
            "iat" => time(),
            "nbf" => 20000,
            "exp" => time()+10*60,
            "data" => array(
             "id" => $userId));
            http_response_code(200);

            $token = $jwt = JWT::encode($token, $public_key);
            echo json_encode(
                array(
                "message" => "Successful login.",
                "jwt" => $jwt)
            );
} else {
    http_response_code(401);
    echo json_encode(
        array(
        "message" => "Login failed.")
    );
}
