<?php
session_start();
/* init database */
$db_hostname = 'localhost';
$db_database = 'webserver';
$db_username = 'php';
$db_password = 'php';
$db_server   = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($db_server->connect_error) die ("Connection Failed: " . $db_server->connect_error());

if (isset($_GET['username'])) {
    if ($_GET['token'] == $_SESSION[$_GET['username']]) {
        $stmt = $db_server->prepare("SELECT id, username, phone FROM users WHERE username = ? LIMIT 1");

        if ($stmt) {
            /* execute query */
            $stmt->bind_param("s", $_GET['username']);
            $stmt->execute();
            $stmt->bind_result($id, $username, $phone);
            $stmt->fetch();
        }

        /* echo "LOGIN!<br/>"; */
        echo <<<EOF
<html>
<head>
    <meta charset="UTF-8">
    <title>Login with user/pass</title>
    <!-- stylesheets include -->
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/style_login.css">
</head>
<body>
    <!-- main container for contents -->
    <div class="container">
        <div class="login_wrap">
            <!-- login wrap -->
            <div class="wrap">
                <!-- main login form -->
                <div class="main">
                    <!-- login methods switch table -->
                   <div class="methods_tab">
                        <span class="active">更改密码</span>
                        <span class="">删除帐号</span>
                        <span class="">更改电话</span>
                        <span class="">查找帐号</span>
                    </div>
                    <div class="form_wrap active">
                        <form method="GET" action="password_change.php">
                            <input type="hidden" size="10" name="username" value="{$_GET['username']}">
                            <input type="hidden" size="10" name="token" value="{$_GET['token']}">
                            <div class="form">
                                <div class="account">
                                    <div id="password" class="item">
                                        <span class="icon"><img src="./images/pass1.png" alt=""></span>
                                        <input type="password" name="newpassword" placeholder="密码" value="">
                                        <a id="eye" class="input_eye eye_close" href="#"></a>
                                    </div>
                                </div>
                                <div class="button">
                                    <input type="submit" value="更新密码">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form_wrap">
                        <form method="GET" action="account_delete.php">
                            <input type="hidden" size="10" name="username" value="{$_GET['username']}">
                            <input type="hidden" size="10" name="token" value="{$_GET['token']}">
                            <div class="form">
                                <div class="button">
                                    <input type="submit" value="删除帐号">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form_wrap">
                        <form method="GET" action="change_account.php">
                            <input type="hidden" size="10" name="username" value="{$_GET['username']}">
                            <input type="hidden" size="10" name="token" value="{$_GET['token']}">
                            <div class="form">
                                <div class="account">
                                    <div id="password" class="item">
                                        <input type="text" name="phone" placeholder="新手机号" value="">
                                    </div>
                                </div>
                                <div class="button">
                                    <input type="submit" value="更新手机号">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form_wrap">
                        <form method="GET" action="">
                            <div class="form">
                                <div class="account">
                                    <div id="lookup" class="item">
                                        <input type="text" name="lookup" placeholder="lookup" value="{$_GET['username']}">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p id="info" style="margin-top:20px;"></p>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-style:solid;border-width:0px;font-family:Arial, sans-serif;font-size:14px;overflow:hidden;
      padding:10px 5px;word-break:normal;}
      .tg th{border-style:solid;border-width:0px;font-family:Arial, sans-serif;font-size:14px;font-weight:normal;
            overflow:hidden;padding:10px 5px;word-break:normal;}
  .tg .tg-l8oh{background-color:#ffffff;border-color:#34cdf9;color:#6434fc;position:-webkit-sticky;position:sticky;text-align:left;
        top:-1px;vertical-align:top;will-change:transform}
        .tg .tg-7zkk{background-color:#ffffff;border-color:#34cdf9;text-align:left;vertical-align:top}
        .tg-sort-header::-moz-selection{background:0 0}
        .tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}
        .tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;
              border-color:#404040 transparent;visibility:hidden}
    .tg-sort-header:hover:after{visibility:visible}
    .tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}
    .tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}@media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}</style>
                        
                        <div class="tg-wrap"><table id="tg-lgcYE" class="tg">
                        <thead>
                          <tr>
                              <th class="tg-l8oh">Id</th>
                              <th class="tg-l8oh">Username</th>
                              <th class="tg-l8oh">Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                              <tr>
                                  <td id="td1" class="tg-7zkk">{$id}</td>
                                  <td id="td2" class="tg-7zkk">{$username}</td>
                                  <td id="td3" class="tg-7zkk">{$phone}</td>
                            </tr>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <a href="./index.html" style="margin: 44%";>HOME</a>
            </div>
        </div>
    </div>    
    <script src="./scripts/eye.js"></script>
    <script src="./scripts/switch.js"></script>
    <script src="./scripts/lookup.js"></script>
</body>
</html>
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
