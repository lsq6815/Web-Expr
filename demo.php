<?php
/* get data, decode it as JSON */
$json = json_decode(file_get_contents('php://input'));

/* TODO: user SQL to validate username and password */
if ($json->username == "LSQ" && $json->password == "kali") {
    $response->status = true;
}
else {
    $response->status = false;
}

/* send data as JSON */
echo json_encode($response);
?>
