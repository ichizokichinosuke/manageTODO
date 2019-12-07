<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

function get_val($key){
    $val = "";
    for($i=1; $i<=strlen($key); $i++){
        if(ctype_digit($key[-$i])){
            $val .= $key[-$i];
        }
        elseif(ctype_digit($key[-$i]) !== true){
            $val = strrev($val);
            return $val;
        }
        else{
            echo "Error about key.";
        }
    }
}

if($link !== false){
    $msg = "";
    $err_msg = "";

    if(isset($_POST) !== false){
        $key = array_key_last($_POST);
        $val = get_val($key);

        $query = " SELECT USER from todo_item GROUP BY USER ";
        $res = mysqli_query($link, $query);
        if($res !== false){
            $msg = "Done to load.";
        }
        else{
            $err_msg = "Failed to load.";
        }
        $data = array();
        while($assginees = mysqli_fetch_assoc($res)){
            array_push($data, $assginees);
        }

        $edit_query = " SELECT * from todo_item where id=$val ";
        $select_res = mysqli_query($link, $edit_query);
        if($select_res !== false){
            $msg = "Done to load task.";
        }
        else{
            $err_msg = "Failed to load task.";
        }
        $task_info = mysqli_fetch_assoc($select_res);
        var_dump($task_info);
    }
    else{
        $err_msg = "Did not exsits task data.";
    }
}
else{
    echo "Failed to connect database.";
}

mysqli_close($link);
?>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Edit task</title>
        <link rel="stylesheet" href="todo.css">
        <script src="js/add.js" type="text/javascript"></script>
    </head>
    <body onload="fieldChanged();">
        <h1>Edit task</h1>
        <hr>
        <div align="right" class="welcome">Welcome to here!</div>
        <form action="list.php", method="POST" name="edit_form" id="edit_form">
            <table border="0" width="90%">
                <tr>
                    <th class="add_task">Task</th>
                    <td class="add_task" colspan="1">
<?php
$task_info_name = $task_info['NAME'];
echo "<input type='text' class='input_box' name='e_task' id='task_name' onkeyup='fieldChanged();' onchange='fieldChanged();' value=$task_info_name>";
?>
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Assignees</th>
                    <td class="add_task" colspan="1">
                        <select name="e_assignees_select" id="" class="input_assignees">
<?php
foreach($data as $user){
    $user_name = $user["USER"];
    if($user_name !== $task_info['USER']){
        echo "<option value=$user_name>$user_name</option>";
    }
    else{
        echo "<option value=$user_name selected>$user_name</option>";
    }
}
?>
                        </select>
                        <br>or<br>
                        <input type="text" class="input_assignees" name="e_assignees_input">
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Due</th>
                    <td class="add_task">
<?php
$task_info_due = $task_info["EXPIRE_DATE"];
echo "<input type='date' class='input_due' name='e_due' id='input_due' onkeyup='fieldChanged();' onchange='fieldChanged();' value=$task_info_due>";
?>
                    </td>
                </tr>
                <tr>
                    <th class="add_task">Done</th>
                    <td class="add_task">
<?php
if(isset($task_info['FINISHED_DATE']) !== true){
    echo 'Yes
        <input type="radio" name="e_done" value="done">
        No
        <input type="radio" name="e_done" value="yet" checked="checked">';
}
else{
    echo 'Yes
        <input type="radio" name="e_done" value="done" checked="checked">
        No
        <input type="radio" name="e_done" value="yet">';
}
?>
                    </td>
                </tr>
            </table>
            <div align="center">   

<?php
$update_btn = "edit_task_".$val;
echo "<input type='submit' value='Update' class='button_confirm' name=$update_btn id='add_send'>";
?>

                <input type="submit" value="Cancel" class="button_confirm" name="cancel_edit">
            </div>
        </form>
    </body>
</html>
