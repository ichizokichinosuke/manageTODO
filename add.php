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
