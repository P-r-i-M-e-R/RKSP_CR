<?php
session_start();

$DBhost = "127.0.0.1";
$DBuser = "root";
$DBpassword = "";
$DBname = "rk_rksp";

$link = mysqli_connect($DBhost, $DBuser, $DBpassword);
mysqli_select_db($link, $DBname);

$query = "SELECT id, login, password, avatar FROM user_data";
$result = mysqli_query($link, $query);
if (isset($_POST["edit_button"])) {
    header("Location: editing_page.html");
    exit;
}

if (isset($_POST["add_button"])) {
    header("Location: editing_page.html");
    exit;
}

if (isset($_POST["delete_button"])) {
    $delete_id = $_POST["delete_id"];
    $query = "DELETE FROM user_data WHERE id = {$delete_id}";
    $result = mysqli_query($link, $query);

    if ($result) {
        header("Refresh: 1");
        exit;
    } else {
        header("Location: error_page.html");
        exit;
    }
}


mysqli_close($link);
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CR</title>
</head>
<body>
    <div id="greetings" class="opacityToggle">
        Вы вошли как администратор
    </div>

    <div class="user_list_text">Список пользователей</div>
    <form method='POST'>
        <button id='add_button' name='add_button' class='add_button'>
            <img id='add' src='icons/add.png'>
        </button>
    </form>

    <div class="wrapper_admin">
        <?php
        echo "<table border='0'>
            <tr>
                <th class='id_text'>ID</th>
                <th class='login_text'>Логин</th>
                <th class='password_text'>Пароль</th>
                <th class='avatar_text'>Аватар</th>
                <th></th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='id_data'>{$row['id']}</td>";
            echo "<td class='login_data'>{$row['login']}</td>";
            echo "<td class='password_data'>{$row['password']}</td>";
            echo "<td class='avatar_data'>{$row['avatar']}</td>";
            echo "<td>
                <form method='POST'>
                    <button id='edit_button' name='edit_button' class='edit_button'>
                        <img id='pencil' src='icons/pencil.png'>
                    </button>
                    <input type='hidden' name='delete_id' value='{$row['id']}' />
                    <button type='submit' name='delete_button' class='delete_button'>
                        <img id='trash' src='icons/trash.png'>
                    </button>
                </form>
            </td>";
            echo "</tr>";
        }

        echo "</table>";

        ?>
    </div>
</body>
</html>

