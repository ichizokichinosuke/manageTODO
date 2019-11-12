<?php

$msg = "";
$err_msg = "";

if(isset($_GET["send_search"]) !== false){
    $search_task = $_GET["search_task"];
    $query = "SELECT * from todo_item";
    $res = mysqli_query($link, $query);
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        if($search_task === $row["NAME"]){
            array_push($data, $row);
        }
        arsort($data);
    }

}

?>


<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Search results</title>
        <link rel="stylesheet" href="todo.css">
        <script src=""></script>
    </head>
    <body>
        <h1>Search results</h1>
        <hr>
        <div align="right" class="welcome">Welcome to here!</div>
        <form action="list.php">
            <div class="button_confirm">
                <input type="submit" value="Back">
            </div>
        </form>
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
        <form action="list.php">
                <div class="button_confirm">
                    <input type="submit" value="Back">
                </div>
        </form>
    </body>
</html>
