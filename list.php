<?php

$db_host = "localhost";
$db_name = "manage_db";
$db_user = "manage_user";
$db_pass = "manage_pass";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if($link !== false){
    $msg = "";
    $err_msg = "";

    if(isset($_GET["done_send"]) === true){

    }
    elseif(isset($_GET["edit_send"]) === true){

    }
    elseif(isset($_GET["delete_send"]) === true){
        
    }
}


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
            <form action="" method="GET">
                <!-- trはTable Rowなので横 -->
                <!-- thはTable Header -->
                <!-- tdはTable Data -->
                <tr>
                    <form action="add.html">
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
                <tr>
                    <th class="table_contents">Eat</th>
                    <th class="table_contents">Tanaka</th>
                    <th class="table_contents">2019/12/01</th>
                    <th class="table_contents">not</th>
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
                </tr>
            </form>
        </table>
    </body>
</html>
