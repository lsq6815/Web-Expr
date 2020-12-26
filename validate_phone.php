<?php
session_start();
/* init database */
$db_hostname = 'localhost';
$db_database = 'webserver';
$db_username = 'php';
$db_password = 'php';
$db_server   = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($db_server->connect_error) die ("Connection Failed: " . $db_server->connect_error());

/* get data, decode it as JSON */
$json  = json_decode(file_get_contents('php://input'));
$phone = $json->phone;

/* query string */ 
$stmt = $db_server->prepare("SELECT username FROM users WHERE phone = ? LIMIT 1");
$response->status = false;

if ($stmt) {

    /* execute query */
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();

    /* if find result */
    if ($username) {
        session_start();
        $response->status = true;
        $response->username = $username;
        $token = rand() % 10000; // limit to 4 digits
        $_SESSION[$username] = $token;
        
        $input = file_get_contents("https://tianqiapi.com/api/sms?appid=84265617&appsecret=V9jv3QJ8&code=" . $token  . "&mobile=" . $phone);
        // TODO: more details info about failures?
        if ($input !== NULL) {
            $json = json_decode($input);
            if ($json->errcode === 0) {
                $response->status->true;
            }
            else {
                $response->status = false;
            }
        }
        else {
            $response->status = false;
        }
    }
    /* if not find such user */
    else {
        $response->error = "没有这个手机号";
    }

    /* send data as JSON */
    echo json_encode($response);
    $stmt->close();
}

$db_server->close();
?>
