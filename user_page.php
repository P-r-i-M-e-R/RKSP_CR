<?php
session_start();

$DBhost = "127.0.0.1";
$DBuser = "root";
$DBpassword = "";
$DBname = "rk_rksp";

$login = "";

if (isset($_GET['login'])) {
    $login = $_GET['login'];
}

$link = mysqli_connect($DBhost, $DBuser, $DBpassword);
mysqli_select_db($link, $DBname);

$query = "SELECT * FROM posts";
$result = mysqli_query($link, $query);

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
        Вы вошли как
        <?php echo $login; ?>
    </div>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $postMessage = nl2br($row['message']);
        $user_login = $row['login'];
        $timestamp = $row['time'];
        $avatar_id = $row['avatar'];
        $avatarPath = "avatars/avatar_" . $avatar_id . ".jpg";

        echo '<div class="line">';
        echo '<div class="avatar_icons"><img src="' . $avatarPath . '" alt="Avatar" class="avatar-image"></div>';
        echo '<div class="post_container">';
        echo '<div class="post_peace"></div>';
        echo '<div class="post">';
        echo '<h4 class="post_login">' . $user_login . '</h4>';
        echo '<div class="post_message">' . $postMessage . '</div>';
        echo '<div class="post_timestamp">' . $timestamp . '</div>';
        if ($user_login === $login) {
            echo '<form method="POST">';
            echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="edit_post" class="edit_button_user">';
            echo '<img id="pencil" src="icons/pencil.png">';
            echo '</button>';
            echo '<button type="submit" name="delete_post" class="delete_button_user">';
            echo '<img id="trash" src="icons/trash.png">';
            echo '</button>';
            echo '</form>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div';
    }
    ?>

    <div class="post_writer">
        <form method="POST">
            <?php
            $placeholder_message = "Напишите свой пост...";
            $value_message = "";
            if (isset($_GET['value_message'])) {
                $value_message = urldecode($_GET['value_message']);
            }
            echo '<input name="new_post" placeholder="' . $placeholder_message . '" value="' . $value_message . '" class="new_post"></input>';
            ?>

            <button type="submit" name="submit_post" class="posting">></button>
            <button type="submit" name="update_post" class="posting_2">></button>
        </form>

        <div class="smile-container">
            <input type="radio" name="selected-smile" id="smile1" class="smile-radio" value="&#128512;">
            <label for="smile1" class="smile-label">&#128512;</label>

            <input type="radio" name="selected-smile" id="smile2" class="smile-radio" value="&#128517;">
            <label for="smile2" class="smile-label">&#128517;</label>

            <input type="radio" name="selected-smile" id="smile3" class="smile-radio" value="&#128554;">
            <label for="smile3" class="smile-label">&#128554;</label>

            <input type="radio" name="selected-smile" id="smile4" class="smile-radio" value="&#128514;">
            <label for="smile4" class="smile-label">&#128514;</label>
        </div>

        <div class="smile-container">
            <input type="radio" name="selected-smile" id="smile5" class="smile-radio" value="&#129392;">
            <label for="smile5" class="smile-label">&#129392;</label>

            <input type="radio" name="selected-smile" id="smile6" class="smile-radio" value="&#128077;">
            <label for="smile6" class="smile-label">&#128077;</label>

            <input type="radio" name="selected-smile" id="smile7" class="smile-radio" value="&#128078;">
            <label for="smile7" class="smile-label">&#128078;</label>

            <input type="radio" name="selected-smile" id="smile8" class="smile-radio" value="&#128150;">
            <label for="smile8" class="smile-label">&#128150;</label>
        </div>

        <script>
            const smileRadios = document.querySelectorAll('.smile-radio');
            const newPostInput = document.querySelector('.new_post');

            smileRadios.forEach((radio) => {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        newPostInput.value += this.value;
                    }
                });
            });
        </script>
    </div>

    <div class="page_end">></div>
</body>

</html>

<?php
if (isset($_POST['submit_post'])) {
    $new_post = mysqli_real_escape_string($link, $_POST['new_post']);

    $avatar_query = "SELECT avatar FROM user_data WHERE login = '$login'";
    $avatar_result = mysqli_query($link, $avatar_query);

    if ($avatar_result && $avatar_row = mysqli_fetch_assoc($avatar_result)) {
        $user_avatar = $avatar_row['avatar'];
    }

    $query = "INSERT INTO posts (login, message, avatar, time) VALUES ('$login', '$new_post', $user_avatar, NOW())";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo '<script>window.location.href = "user_page.php?login=' . $login . '";</script>';
    } else {
        echo '<div id="greetings" class="opacityToggle">';
        echo 'Произошла ошибка при добавлении поста';
        echo '</div>';
    }
} elseif (isset($_POST['edit_post'])) {
    $post_id = mysqli_real_escape_string($link, $_POST['post_id']);
    $query = "SELECT message FROM posts WHERE id = $post_id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $value_message = $row['message'];
    $placeholder_message = "";
    echo '<script>window.location.href = "user_page.php?login=' . $login . '&value_message=' . urlencode($value_message) . '&post_id=' . $post_id . '";</script>';

} elseif (isset($_POST['delete_post'])) {
    $post_id = mysqli_real_escape_string($link, $_POST['post_id']);
    $delete_query = "DELETE FROM posts WHERE id = $post_id";
    $delete_result = mysqli_query($link, $delete_query);

    if ($delete_result) {
        echo '<script>window.location.href = "user_page.php?login=' . $login . '";</script>';
    } else {
        echo '<div id="greetings" class="opacityToggle">';
        echo 'Произошла ошиба при удалении поста';
        echo '</div>';
    }
}

if (isset($_POST['update_post'])) {
    if (isset($_GET['post_id'])) {
        $post_id = mysqli_real_escape_string($link, $_GET['post_id']);
        $edited_message = mysqli_real_escape_string($link, $_POST['new_post']);

        $update_query = "UPDATE posts SET message = '$edited_message' WHERE id = $post_id";
        $update_result = mysqli_query($link, $update_query);

        if ($update_result) {
            echo '<script>window.location.href = "user_page.php?login=' . $login . '";</script>';
        } else {
            echo '<div id="greetings" class="opacityToggle">';
            echo 'Произошла ошибка при изменении поста';
            echo '</div>';
        }
    }
}


mysqli_close($link);
session_destroy();
?>