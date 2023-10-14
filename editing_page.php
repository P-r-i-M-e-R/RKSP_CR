<?php
session_start();

$DBhost = "127.0.0.1";
$DBuser = "root";
$DBpassword = "";
$DBname = "rk_rksp";

$link = mysqli_connect($DBhost, $DBuser, $DBpassword);

mysqli_select_db($link, $DBname);

$login = $_POST['login_form'];
$password = $_POST['password_form'];
$selected_avatar = $_POST['selected_avatar'] + 1;

if (empty($login) || empty($password)) {
    header("Location: error_page.html");
    exit;
}

$query = "SELECT * FROM user_data WHERE login = '$login'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    // Пользователь с таким логином уже существует
    $existing_user = mysqli_fetch_assoc($result);

    if ($existing_user['password'] === $password && $existing_user['avatar'] == $selected_avatar) {
        // Если логин, пароль и аватар совпадают, выдаем ошибку
        header("Location: error_page.html");
        exit;
    } else {
        // Иначе выполняем обновление
        $query = "UPDATE `user_data` SET `password` = '$password', `avatar` = $selected_avatar WHERE `login` = '$login'";
        $result = mysqli_query($link, $query);
    }
} else {
    // Пользователь с таким логином не существует, выполняем вставку
    $query = "INSERT INTO user_data (login, password, avatar) VALUES ('$login', '$password', $selected_avatar)";
    $result = mysqli_query($link, $query);
}

if ($result) {
    header("Location: success_update_page.html");
    mysqli_close($link);
    session_destroy();
    exit;
} else {
    header("Location: error_page.html");
    mysqli_close($link);
    session_destroy();
    exit;
}

?>