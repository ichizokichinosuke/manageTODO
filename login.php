<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if($link !== false){
    $msg = "";
    $err_msg = "";

    if(isset($_POST["send"]) === true){
        $user_id = $_POST["user_id"];
        $password = $_POST["password"];

        if($user_id !== "" && $password !== ""){
            $query = " INSERT INTO todo_user("
                . " id, "
                . " password "
                . ") VALUES ("
                . " '" . mysqli_real_escape_string($link, $user_id) . "', "
                . " '" . mysqli_real_escape_string($link, $password) . "' "
                . ")";

            $res = mysqli_query($link, $query);
            if($res !== false){
                $msg = "Success to login";
            }
            else{
                $msg = "Failed to login";
            }
        }
        else{
            $err_msg = "Empty login id or password.";
        }
    }
}
else{
    echo "Failed to connnect to database.";
}

mysqli_close($link);
?>

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
                            <!-- <form action="list.php"> -->
                                <input type="submit" name="send" value="Login" id="login">
                            <!-- </form> -->
                        </td>
                    </tr>
                </form>
            </table>
<?php
    if($msg !== "") echo "<p>" . $msg . "</p>";
    if($err_msg !== "") echo '<p style="color:#f00;">' . $err_msg . '</p>';
?>
        </div>
    </body>
</html>