<?php 


if(isset($_POST['delete'])) {
    foreach ($_POST['ids'] as $key => $value) {
        $_POST['ids'][$key] = (int)$value;
    }

    $ids = implode(',', $_POST['ids']);
    mysqli_query($link,"
        DELETE FROM `news`
        WHERE `id` IN (".$ids.")
    ")or exit(mysqli_error());

    $_SESSION['info'] = 'Новости удалены';
    header("Location: index.php?module=news");
    exit();
}



if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    mysqli_query($link,"
        DELETE FROM `news`
        WHERE `id` = ".(int)$_GET['id']."
    ") or exit(mysqli_error());

    $_SESSION['info'] = 'Новость удалена';
    header("Location: index.php?module=news");
    exit();
}



$news = mysqli_query($link, "
    SELECT *
    FROM `news`
    ORDER BY `id` DESC
") or die(mysqli_error());


if (isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
    unset($_SESSION['info']);
}

?>