<?php
require_once 'auth.php';
require_once 'curl.php';
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");
$api = explode('?', basename($_SERVER['REQUEST_URI']), 2); //api method

if ($api[0] ==='getMovie') {
//movie parameters
    $token = isset($_GET['jwt']) ? $_GET['jwt'] : "";
    $title = isset($_GET['t']) ? '&t='.str_replace(' ', '+', $_GET['t']) : "";
    $year = isset($_GET['y']) ? '&y='.$_GET['y'] : "";
    $plot = isset($_GET['plot']) ? '&plot='.$_GET['plot'] : "";
    $url = 'http://www.omdbapi.com/?apikey=21c2c65d&'.$title.$year.$plot;
} elseif ($api[0] ==='getBook') {
//book parameters
    $token = isset($_GET['jwt']) ? $_GET['jwt'] : "";
    $isbn = isset($_GET['isbn']) ? 'ISBN:'.$_GET['isbn'] : "";
    $url = 'https://openlibrary.org/api/books?bibkeys='.$isbn.'&jscmd=data&format=json';
} else {
    http_response_code(405);
    echo json_encode(
        array(
        "message" => 'Not a valid method.')
    );
    exit;
}
//make a request to url if token authentication is a success
if (auth($token)) {
    request($url);
}
