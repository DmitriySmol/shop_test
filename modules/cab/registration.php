<?php 
if (isset($_POST['login'], $_POST['email'], $_POST['age'], $_POST['password'])) {

    $errors = array();

    if(empty($_POST['login'])) {
        $errors['login'] = 'Вы не заполнили логин';
    } elseif (mb_strlen($_POST['login']) < 2) {
        $errors['login'] = 'Логин слишком короткий';
    } elseif (mb_strlen($_POST['login']) > 16) {
        $errors['login'] = 'Логин слишком длинный';
    }
    if(mb_strlen($_POST['password']) < 5) {
        $errors['password'] = 'Пароль должен быть не менее 5 символов';
    }
    if(empty($_POST['email'])) {
        $errors['email'] = 'Вы не заполнили email';
    }

    //проверка на идентичность логинов и email
    if(!count($errors)) {
        $res = query("
        SELECT `id`
        FROM `users`
        WHERE `login` = '".mysqli_real_escape_string_All($_POST['login'])."'
        ") or exit();
        if(mysqli_num_rows($res)) {
            $errors['login'] = 'Такой логин уже занят';
        }

        $res = query("
        SELECT `id`
        FROM `users`
        WHERE `email` = '".mysqli_real_escape_string_All($_POST['email'])."'
        ") or die;
        if(mysqli_num_rows($res)) {
            $errors['email'] = 'Такой логин уже занят';
        }
    }
  
    //вставка в БД
    if(!count($errors)) {
        query("
        INSERT INTO `users` SET
        `login`    = '".mysqli_real_escape_string_All($_POST['login'])."',
        `password` = '".myHash($_POST['password'])."',
        `email`    = '".mysqli_real_escape_string_All($_POST['email'])."',
        `age`      = ".(int)$_POST['age'].",
        `hash`     = '".myHash($_POST['login'].$_POST['login'])."'
        ") or exit(misqli_error($link));

        $id = mysqli_insert_id($link);

        $_SESSION['regok'] = 'OK';
        Mail::$to = $_POST['email'];
        Mail::$subject = 'Вы успешно зарегистрировались на сайте';
        Mail::$text = 'Если Вы зарегистрировались на сайте таком-то, то пройдите по ссылке'.Core::$DOMAIN.'index.php?module=cab?page=active&id='.$id.'&hash='.myHash($_POST['login'].$_POST['login']).'';
        Mail::send();
        header('location: index.php?module=cab&page=registration');
        exit();
      }
    }
      // else {
//       print_r($errors);
//     }
// }
?>