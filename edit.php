<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if($link !== false){
    $msg = "";
    $err_msg = "";

    if(isset($_POST) !== false){
        $key = array_keys($_POST)[0];
        $val = substr(array_keys($_POST)[0], 10, 2);
    }
    else{
        $err_msg = "Did not exsits task data.";
    }
}
else{
    echo "Failed to connect database.";
}

?>



<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Edit task</title>
        <link rel="stylesheet" href="todo.css">
        <script src=""></script>
    </head>
    <body>
        <h1>Edit task</h1>
        <hr>
        <div align="right" class="welcome">Welcome to here!</div>
        <form action="list.php", method="POST">
            <table border="0" width="90%">
                <tr>
                    <th class="add_task">Task</th>
                    <td class="add_task" colspan="1">
                        <input type="text" class="input_box" name="e_task">
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Assignees</th>
                    <td class="add_task" colspan="1">
                        <select name="e_assignees" id="" class="input_assignees">
                                <option value="user_01">user_01</option>
                                <option value="user_02">user_02</option>
                                <option value="user_03">user_03</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Due</th>
                    <td class="add_task">
                        <input type="date" class="input_due" name="e_due">
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Done</th>
                    <td class="add_task">
                        Yes
                        <input type="checkbox" name="e_done">
                        No
                        <input type="checkbox" name="e_yet">
                    </td>
                </tr>
            </table>

            <div align="center">
                

<?php
$update_btn = "edit_task_".$val;
echo "<input type='submit' value='Update' class='button_confirm' name=$update_btn>";
?>
                
                <input type="submit" value="Cancel" class="button_confirm" name="cancel_edit">
            </div>
        </form>
    </body>
</html>