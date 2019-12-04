<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if($link !== false){
    $msg = "";
    $err_msg = "";

    if(isset($_GET["send_search"]) !== false){
        $search_task = $_GET["search_task"];
        $query = "SELECT * from todo_item";
        $res = mysqli_query($link, $query);
        $data = array();
        // 0でもEmptyと判定するため
        if(empty($search_task) !== true || $search_task === '0'){
            while($row = mysqli_fetch_assoc($res)){
                if(strpos($row["NAME"], $search_task) !== false){
                    array_push($data, $row);
                }
                // if($search_task === $row["NAME"]){
                //     array_push($data, $row);
                // }
                arsort($data);
            }
        }
        else{
            $msg = "Nothing results.";
        }
        if(empty($data) === true){
            $msg = "Nothing results.";
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
        <div align="right" class="welcome">
            <form action="login.php">
                <input type="submit" value="Logout" id="btn_login">
            </form>
            Welcome to here!
        </div>
        <form action="list.php">
            <td class="submit_button">
                <input type='submit' value="Back">
            </td>
        </form>
        <table border="0" width="90%" class="head_table">
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
        <form action='delete.php', method='POST'>
            <td class='table_button' align='center'>
                <input type='submit' value='Delete' name=$delete_btn>
            </td>
        </form>
    </tr>";
}
?>
        </table>
    </body>
</html>
