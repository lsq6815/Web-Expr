<?php
/* init database */
$db_hostname = 'localhost';
$db_database = 'webserver';
$db_username = 'php';
$db_password = 'php';
$db_server   = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($db_server->connect_error) die ("Connection Failed: " . $db_server->connect_error());

/* get data, decode it as JSON */
$username = $_GET['username'];
$password = $_GET['password'];
$phone = $_GET['phone'];

/* query string */ 
$stmt = $db_server->prepare("INSERT INTO users (username, password, phone) VALUES (?,md5(?),?)");

if ($stmt) {

    /* execute query */
    $stmt->bind_param("sss", $username, $password, $phone);
    $stmt->execute();
    $stmt->fetch();
    if ($stmt->affected_rows > 0) {
        echo <<<EOF
<h1>SUCCESS APPLY ACCOUNT</h1>
<a href="index.html">HOME</a>
EOF;

    }
    else {
        echo "FAILED";
    }
    $stmt->close();
}

$db_server->close();
?>
