<?php
/* init database */
$db_hostname = 'localhost';
$db_database = 'webserver';
$db_username = 'php';
$db_password = 'php';
$db_server   = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($db_server->connect_error) die ("Connection Failed: " . $db_server->connect_error());

/* get data, decode it as JSON */
$json     = json_decode(file_get_contents('php://input'));
$username = $json->username;

/* query string */ 
$stmt = $db_server->prepare("SELECT password FROM users WHERE username = ? LIMIT 1");
$response->status = false;

if ($stmt) {

    /* execute query */
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();

    /* if find result */
    if ($password) {
        /* if password correct */ 
        if ($password == md5($json->password)) {
            session_start();
            $response->status = true;
            $response->token  = rand();
            // keep login status
            $_SESSION[$username] = $response->token;
        } 
        /* if password incorrect */
        else {
            $response->error = "密码错误";
        }
    }
    /* if not find such user */
    else {
        $response->error = "没有这个用户";
    }

    /* send data as JSON */
    echo json_encode($response);
    $stmt->close();
}

$db_server->close();
?>
