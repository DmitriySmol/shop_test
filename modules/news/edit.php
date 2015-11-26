<?php 

if(isset($_POST['edit'], $_POST['text'], $_POST['cat'], $_POST['description'], $_POST['title'])) {
    
    $description = $_POST['description'];
    $text = $_POST['text'];
    $cat = $_POST['cat'];
    $title = $_POST['title'];
    
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    }

    mysqli_query($link,"
        UPDATE `news` SET
        `cat`         = '".mysqli_real_escape_string($link,$cat)."',
        `title`       = '".mysqli_real_escape_string($link,$title)."',
        `text`        = '".mysqli_real_escape_string($link,$text)."',
        `description` = '".mysqli_real_escape_string($link,$description)."'
        WHERE `id`    = ".(int)$_GET['id']."
    ") or exit(mysqli_error($link));

    $_SESSION['info'] = 'Новость была отредактирована!';
    header('Location: index.php?module=news');
    exit("");

}


$news = mysqli_query($link,"
    SELECT * FROM `news`
    WHERE `id` = ".(int)$_GET['id']."
    LIMIT 1
") or exit(mysql_error());


if (!mysqli_num_rows($news)) {
    $_SESSION['info'] = 'Ошибочно указан идентификатор';
    header('Location: index.php?module=news');
    exit();
}

$row = mysqli_fetch_assoc($news);

if (isset($_POST['title'])) {
    $row['title'] = $_POST['title'];
}

?> 