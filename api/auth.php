<?php
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

function auth($token)
{

    if (!empty($token)) {
        try {
            $public_key = '5f2b5cdbe5194f10b3241568fe4e2b24';
            $decoded = JWT::decode($token, $public_key, ["HS256"]);
            return true;
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(
                array("message" => $e->getMessage())
            );
        }
    } else {
        http_response_code(401);
        echo json_encode(
            array(
        "message" => "No API token provided."));
    }
}
