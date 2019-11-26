<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if($link !== false){
    $msg = "";
    $err_msg = "";
    // Login phase
    if(isset($_POST["send"]) !== false){

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

    // Regist data from add.php
    if(isset($_POST["add_send"]) !== false){
        $task_name = $_POST["task_name"];
        $user_id = $_POST["user_id_add"];
        $due = $_POST["due"];

        if($task_name !== "" && $user_id !== "" && $due !== ""){
            $query = " INSERT INTO todo_item ("
                . " NAME, "
                . " USER, "
                . "EXPIRE_DATE "
                . ") VALUES ("
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
        else{
            $err_msg = "Empty in input box.";
        }
    }

    // Done Task
    if(isset($_POST) !== false){
        $key = array_key_last($_POST);
        // echo $key;
        // var_dump($_POST);
        if(substr($key, 0, 9) === "done_send"){
            $val = substr($key, 10, 2);
            $query = " UPDATE todo_item set FINISHED_DATE=now() where id="
            . " '" . $val . "' ";
            $res = mysqli_query($link, $query);
            if($res !== false){
                $msg = "Done task.";
            }
            else{
                $err_msg = "Failed to finish task.";
            }
            echo $msg;
            echo $err_msg;
        }

        // Edit Task
        else if(substr($key, 0, 9) === "edit_task"){
            // echo $key;
            $val = substr($key, 10, 2);
            $e_task = mysqli_real_escape_string($link, $_POST['e_task']);
            $e_assignees = mysqli_real_escape_string($link, $_POST['e_assignees']);
            $e_due = mysqli_real_escape_string($link, $_POST["e_due"]);
            if(isset($_POST["e_done"]) !== false){
                $e_done = date("Y-m-d", time());
            }
            else{
                $e_done = mysqli_real_escape_string($link, "null");
            }
            
            $query = " UPDATE todo_item set name= "
            . "' " . $e_task . "', "
            . "USER=". "'" . $e_assignees. "', "
            . "EXPIRE_DATE=". "'" . $e_due . "'," 
            . "FINISHED_DATE=" . "'" . $e_done . "'" 
            . "where id=$val";
            
            $res = mysqli_query($link, $query);
            if($res !== false){
                $msg = "Update Task.";
            }
            else{
                $err_msg = "Failed to update.";
            }
            echo $msg;
            echo $err_msg;
        }
        else if($key === "cancel_edit"){
            
        }
    }
    // Get data from todo_item
    $msg = "";
    $err_msg = "";

    $query = "SELECT * from todo_item";
    $res = mysqli_query($link, $query);
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($data, $row);
    }
    arsort($data);

}
else{
    echo "Failed to connnect to database.";
}

mysqli_close($link);
?>


<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>All tasks</title>
        <link rel="stylesheet" href="todo.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/sample.js"></script>
    </head>
    <body>
        <h1>All tasks</h1>
        <hr>
<?php
    if($msg !== "") echo "<p>" . $msg . "</p>";
    if($err_msg !== "") echo '<p style="color:#f00;">' . $err_msg . '</p>';
?>
        <div align="right" class="welcome">Welcome to here!</div>
        <table border="0" width="90%" class="head_table">
            <!-- trはTable Rowなので横 -->
            <!-- thはTable Header -->
            <!-- tdはTable Data -->
            <tr>
                <form action="add.php">
                    <td class="submit_button">
                        <input type='submit' value="Register">
                    </td>
                </form>
            </tr>
            <td align="right">
                <table border="0">
                    <tr>
                        <th>Searching keyword</th>
                        <form action="search.php" method="get">
                            <td>
                                <input type="text" name="search_task">
                            </td>
                            <td>
                                <input type='submit' value="Search" name="send_search">
                            </td>
                        </form>
                    </tr>
                </table>
            </td>
        </table>
        <table border="0" width="90%">
            <tr>
                <th class="table_header">Task</th>
                <th class="table_header">Assignees</th>
                <th class="table_header">Due</th>
                <th class="table_header">Done</th>
                <th class="table_header" colspan="3">Operation</th>
            </tr>
<?php
    foreach($data as $val){
        echo "<tr>";
        echo "<th class='table_contents'>";
        echo $val["NAME"];
        echo "</th>";

        echo "<th class='table_contents'>";
        echo $val["USER"];
        echo "</th>";
        
        echo "<th class='table_contents'>";
        echo $val["EXPIRE_DATE"];
        echo "</th>";

        echo "<th class='table_contents'>";
        echo $val["FINISHED_DATE"];
        echo "</th>";

        $done_btn = "done_send_".$val["ID"];
        $edit_btn = "edit_send_".$val["ID"];
        $delete_btn = "delete_send_".$val["ID"];

        // echo $done_btn;

        echo "
            <form action='list.php', method='POST'>
                <td class='table_button' align='center'>
                    <input type='submit' value='Done' name=$done_btn>
                </td>
            </form>
            <form action='edit.php', method='POST'>
                <td class='table_button' align='center'>
                    <input type='submit' value='Edit' name=$edit_btn>
                </td>
            </form>
            <form action='', method='POST'>
                <td class='table_button' align='center'>
                    <input type='submit' value='Delete' name=$delete_btn>
                </td>
            </form>
        </tr>";
    }
    var_dump($_POST);
    // echo $data[0];
?>
        </table>
    </body>
</html>
