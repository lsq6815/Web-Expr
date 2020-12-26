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
        echo <<<EOF
<h1>Change Password</h1>
<form method="GET" action="password_change.php">
    <table>
        <tr>
            <td><input type="hidden" size="10" name="username" value="{$_GET['username']}"></td>
        </tr>
        <tr>
            <td><input type="hidden" size="10" name="token" value="{$_GET['token']}"></td>
        </tr>
        <tr>
            <td>Enter your new password:</td>
            <td><input type="password" size="10" name="newpassword"></td>
        </tr>
    </table>
    <p><input type="submit" value="Update Password"></p>
</form>
<p><a href="index.html">HOME</a>
EOF;
    }
    else {
        echo "Wrong token<br/>";
    }
}
else {
    echo "No username is given<br/>";
}
?>
