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

/* query string */ 
$stmt = $db_server->prepare("DELETE FROM users WHERE username = ?");
if ($_SESSION[$username] == $token) {
    if ($stmt) {
        /* execute query */
        $stmt->bind_param("s", $username);
        $stmt->execute();

        /* if find result */
        if ($stmt->affected_rows > 0) {
            echo <<<EOF
<h1>SUCCESS DELETE ACCOUNT</h1>
EOF;
            
            header("Location: ./login.php?username=" . $username . "&token=" . $token);
            exit();
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
