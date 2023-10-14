<?php
session_start();

$DBhost = "127.0.0.1";
$DBuser = "root";
$DBpassword = "";
$DBname = "rk_rksp";
$sql_r_flag = 0;

$link = mysqli_connect($DBhost, $DBuser, $DBpassword);

mysqli_select_db($link, $DBname);
$query = "SELECT * FROM user_data";
$data = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($data)) {
    if ($_POST['login_form'] == $row["login"] && $_POST['password_form'] == $row["password"]) {
        $_SESSION['login'] = $_POST['login_form'];
        $_SESSION['password'] = $_POST['password_form'];
        $selected_avatar = $_POST['selected_avatar'] + 1;
        $sql_r_flag = 1;
        break;
    }
}

if ($sql_r_flag == 0) {
    header("Location: error_page.html");
    exit;
} elseif ($sql_r_flag == 1) {
    if ($_SESSION['login'] == "Admin") {
        $login = $_SESSION['login'];
        $new_avatar = $selected_avatar;
        $query = "UPDATE `user_data` SET `avatar` = $new_avatar WHERE `login` = '$login'";
        $result = mysqli_query($link, $query);

        if ($result) {
			header("Location: admin_page.php?login=" . $_SESSION['login']);
            exit;
        } else {
            header("Location: error_page.html");
            exit;
        }
    } else {
        $login = $_SESSION['login'];
        $new_avatar = $selected_avatar;

        $query = "UPDATE `user_data` SET `avatar` = $new_avatar WHERE `login` = '$login'";
        $result = mysqli_query($link, $query);

        if ($result) {
            header("Location: user_page.php?login=" . $_SESSION['login']);
            exit;
        } else {
            header("Location: error_page.html");
            exit;
        }
    }
}

mysqli_close($link);
session_destroy();

?>