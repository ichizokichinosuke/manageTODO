<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="todo.css">
        <script src="login.js" type="text/javascript"></script>
    </head>
    <body onload="fieldChanged();">
        <h1>Login</h1>
        <hr>
        <div align="center">
            <table border="0">
                <form action="list.php" method="post">
                    <tr>
                        <th class="login_field">UserId</th>
                        <td class="login_field">
                            <input type="text" name="user_id" value="" size="24" id="user_id" onkeyup="fieldChanged();" onchange="fieldChanged();">
                        </td>
                    </tr>
                    <tr>
                        <th class="login_field">Password</th>
                        <td class="login_field">
                            <input type="password" name="password" value="" size="24" id="password" onkeyup="fieldChanged();" onchange="fieldChanged();">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="login_button">
                                <input type="submit" name="send" value="Login" id="login">
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </body>
</html>