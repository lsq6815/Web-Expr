<?php
$input = file_get_contents("https://tianqiapi.com/api/sms?appid=84265617&appsecret=V9jv3QJ8&code=1122&mobile=");
if ($input !== NULL) {
    $json = json_decode($input);
    if ($json->errcode === 0) {
        echo $json->errmsg;
    }
    else {
        echo "SMS sending failed";
    }
}
else {
    echo "No input";
}
?>
