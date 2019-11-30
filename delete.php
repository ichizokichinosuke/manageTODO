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
        $val = substr(array_keys($_POST)[0], -2, 2);   
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
        <title>Delete task</title>
        <link rel="stylesheet" href="todo.css">
        <script src=""></script>
    </head>
    <body>
        <h1>Delete task</h1>
        <hr>
        <div align="right" class="welcome">Welcome to here!</div>
        <div class="delete_text">Do you really want to delete this task?
            <form action="list.php" method="POST">
<?php
$d_yes = "d_yes_".$val;
echo "<input type='submit' class='button_confirm' value='Yes' name=$d_yes>";
?>
                <input type="submit" class="button_confirm" value="No" name="d_no">
            </form>
        </div>
    </body>
</html>
