<?php
$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if($link !== false){
    $query = " SELECT USER from todo_item GROUP BY USER ";
    $res = mysqli_query($link, $query);
    if($res !== false){
        $msg = "Done to load.";
    }
    else{
        $err_msg = "Failed to load.";
    }
    // var_dump($res);
    $data = array();
    while($assginees = mysqli_fetch_assoc($res)){
        array_push($data, $assginees);
    }
    // var_dump($data);
}
else{
    echo "Failed to connect database";
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
        <form action="list.php" method="POST">
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
<?php
foreach($data as $user){
    $user_name = $user["USER"];
    echo "<option value=$user_name>$user_name</option>";
}
?>
                            
                        </select>
                        <br>or<br>
                        <input type="text" class="input_assignees" name="user_id_add">
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
