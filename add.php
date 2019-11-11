<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if($link !== false){
    $msg = "";
    $err_msg = "";

    if(isset($_POST["add_send"]) === true){
        $task_name = $_POST["task_name"];
        $user_id = $_POST["user_id"];
        $due = $_POST["due"];

        if($task_name !== "" && $user_id !== "" && $due !== ""){
            $query = " INSERT INTO user_item ("
                . " NAME, "
                . " USER, "
                . "EXPIRE_DATE "
                . " '" . mysqli_real_escape_string($link, $task_name) . "', "
                . " '" . mysqli_real_escape_string($link, $user_id) . "', "
                . " '" . mysqli_real_escape_string($link, $due) . "' "
                . ")"; 
            $res = mysqli_query($link, $query);
            if($res !== false){
                $msg = "Success to add task.";
            }
            else{
                $err_msg = "Failed to add task.";
            }

        }
    }
}
else{
    echo "Failed to connect to database.";
}

mysqli_close($link);

?>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Add task</title>
        <link rel="stylesheet" href="todo.css">
        <script src=""></script>
    </head>
    <body>
        <h1>Add task</h1>
        <hr>
        <div align="right" class="welcome">Welcome to here!</div>
        <form action="list.php" method="post">
            <table border="0" width="90%">
                <tr>
                    <th class="add_task">Task</th>
                    <td class="add_task" colspan="1">
                        <input type="text" class="input_box" name="task_name">
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Assignees</th>
                    <td class="add_task" colspan="1">
                        <select id="" class="input_assignees" name="user_id_add">
                            <option value="user_01">user_01</option>
                            <option value="user_02">user_02</option>
                            <option value="user_03">user_03</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Due</th>
                    <td class="add_task">
                        <input type="date" class="input_due" name="due">
                    </td>
                </tr>
            </table>

            <div align="center">
                    <input type="submit" value="Register" class="button_confirm" name="add_send">
                    <input type="submit" value="Cancel" class="button_confirm">
            </div>
        </form>
    </body>
</html>
