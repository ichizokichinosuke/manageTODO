<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if($link !== false){
    $msg = "";
    $err_msg = "";

    $query = "SELECT * from todo_item where not ID";
    $res = mysqli_query($link, $query);
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($data, $row);
    }
    // arsort($data);
}
else{
    echo "Failed to connect database.";
}

mysqli_close($link);
?>


<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>All tasks</title>
        <link rel="stylesheet" href="todo.css">
        <script src=""></script>
    </head>
    <body>
        <h1>All tasks</h1>
        <hr>
        <div align="right" class="welcome">Welcome to here!</div>
        <table border="0" width="90%" class="head_table">
            <!-- trはTable Rowなので横 -->
            <!-- thはTable Header -->
            <!-- tdはTable Data -->
            <tr>
                <form action="add.php">
                    <td class="submit_button">
                        <input type="submit" value="Register">
                    </td>
                </form>
            </tr>
        <td align="right">
            <table border="0">
                <tr>
                    <th>Searching keyword</th>
                    <form action="search.html">
                        <td>
                            <input type="text">
                        </td>
                        <td>
                            <input type="submit" value="Search">
                        </td>
                    </form>
                </tr>
            </table>
        </td>
    </table>
    <table border="0" width="90%">
        <form action="" method="">
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

        echo '
            <form action="list.html", method="get">
                <td class="table_button" align="center">
                    <input type="submit" value="Done" name="done_send">
                </td>
            </form>
            <form action="edit.html", method="get">
                <td class="table_button" align="center">
                    <input type="submit" value="Edit" name="edit_send">
                </td>
            </form>
            <form action="delete.html", method="get">
                <td class="table_button" align="center">
                    <input type="submit" value="Delete" name="delete_send">
                </td>
            </form>
        </tr>';
    }
?>
        </table>
    </body>
</html>
