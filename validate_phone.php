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
        $response->status = true;
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
