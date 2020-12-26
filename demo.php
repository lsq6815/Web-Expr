<?php
session_start();
/* GET Method */
/* parameters */
/* token */ 
/* username */
echo "GET: ";
var_dump($_GET);
echo "<br/>SESSION: ";
var_dump($_SESSION);
echo "<br/>";

if (isset($_GET['username'])) {
    echo "username set<br/>";
    echo "except " . $_SESSION[$_GET['username']] . "<br/>";
    echo "You give " . $_GET['token'] . "<br/>";
    if ($_GET['token'] == $_SESSION[$_GET['username']]) {
        echo "LOGIN!<br/>";
    }
    else {
        echo "Wrong token<br/>";
    }
}
else {
    echo "No username is given<br/>";
}
?>
