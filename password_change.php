<?php
/* init database */
$db_hostname = 'localhost';
$db_database = 'webserver';
$db_username = 'php';
$db_password = 'php';
$db_server   = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($db_server->connect_error) die ("Connection Failed: " . $db_server->connect_error());

session_start();
$username    = $_GET['username'];
$token       = $_GET['token'];
$newpassword = $_GET['newpassword'];

/* query string */ 
$stmt = $db_server->prepare("UPDATE users SET `password` = md5(?) WHERE username = ?");
if ($_SESSION[$username] == $token) {
    if ($stmt) {
        /* execute query */
        $stmt->bind_param("ss", $newpassword, $username);
        $stmt->execute();

        /* if find result */
        if ($stmt->affected_rows > 0) {
            echo <<<EOF
<h1>SUCCESS CHANGE PASSWORD</h1>
<a href="index.html">HOME</a>
EOF;
        }
        else {
            echo "ERROR OCCUR";
        }
        $stmt->close();
    }
}
else {
    echo "WRONG TOKEN";
}

$db_server->close();
?>
