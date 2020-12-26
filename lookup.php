<?php
/* init database */
$db_hostname = 'localhost';
$db_database = 'webserver';
$db_username = 'php';
$db_password = 'php';
$db_server   = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($db_server->connect_error) die ("Connection Failed: " . $db_server->connect_error());

session_start();
$json     = json_decode(file_get_contents('php://input'));
$username = $json->username;

/* query string */ 
$stmt = $db_server->prepare("SELECT id, phone FROM users WHERE username = ? LIMIT 1");
$response->status = false;

if ($stmt) {
    /* execute query */
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $phone);
    $stmt->fetch();

    /* if find result */
    if ($id) {
        $response->status   = true;
        $response->id       = $id;
        $response->phone    = $phone;
        $response->username = $username;
    }

    /* send data as JSON */
    echo json_encode($response);
    $stmt->close();
}

$db_server->close();
?>
