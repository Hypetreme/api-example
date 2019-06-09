<?php
function request($url)
{
//curl
    $ch = curl_init();
    $options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url);
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);

//errors
    $error = curl_errno($ch);
    $error_message = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($code) {
        http_response_code($code);
    }
    if ($error) {
        echo json_encode(
            array(
            "message" => $error_message)
        );
    } elseif ($result == "{}") { //openlibrary API returns empty json object even if book is not found
        echo json_encode(
            array(
            "message" => 'Book not found.')
        );
    } else {
        echo $result;
    }
    curl_close($ch);
}
