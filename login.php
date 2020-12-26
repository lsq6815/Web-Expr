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
EOF;

        echo <<<EOF
<h1>Delete Me</h1>
<form method="GET" action="account_delete.php">
    <table>
        <tr>
            <td><input type="hidden" size="10" name="username" value="{$_GET['username']}"></td>
        </tr>
        <tr>
            <td><input type="hidden" size="10" name="token" value="{$_GET['token']}"></td>
        </tr>
        <tr>
        </tr>
    </table>
    <p><input type="submit" value="Account Delete"></p>
</form>
EOF;

        echo <<<EOF
<h1>Change Me</h1>
<form method="GET" action="change_account.php">
    <table>
        <tr>
            <td><input type="hidden" size="10" name="username" value="{$_GET['username']}"></td>
        </tr>
        <tr>
            <td><input type="hidden" size="10" name="token" value="{$_GET['token']}"></td>
        </tr>
        <tr>
            <td>Enter new phone number:</td>
            <td><input type="text" size="10" name="phone" value=""></td>
        </tr>
    </table>
    <p><input type="submit" value="Change Account"></p>
</form>
EOF;

        echo "<p><a href='index.html'>HOME</a>";
    }
    else {
        echo "Wrong token<br/>";
    }
}
else {
    echo "No username is given<br/>";
}
?>
