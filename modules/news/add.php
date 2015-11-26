<?php 

if(isset($_POST['add'], $_POST['text'], $_POST['cat'], $_POST['description'], $_POST['title'])) {
    
    $description = $_POST['description'];
    $text = $_POST['text'];
    $cat = $_POST['cat'];
    $title = $_POST['title'];
    
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    }

    mysqli_query($link,"
        INSERT INTO `news` SET
        `cat`         = '".mysqli_real_escape_string($link,$cat)."',
        `title`       = '".mysqli_real_escape_string($link,$title)."',
        `text`        = '".mysqli_real_escape_string($link,$text)."',
        `description` = '".mysqli_real_escape_string($link,$description)."',
        `date`        = NOW()
    ") or exit(mysqli_error($link));

    $_SESSION['info'] = 'Новость была добавлена!';
    header('Location: index.php?module=news');
    exit("");

}

?>