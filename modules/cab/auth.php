<?php 

if (isset($_POST['submit'])) {

    //записываем данные из формы в переменные
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $mail = $_POST['mail'];
    $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);

    $arr = array($login, $pass, $mail);
    $errors = array();

    

    //удаление пробелов, тегов, экранирование символов 
    foreach ($arr as $key => $value) {
        $key = trim($value);
        $key = stripslashes($value);
        $key = strip_tags($value);
        $key = htmlspecialchars($value);
    }

    //если пустые записываем значения в массив с ошибками
    if(empty($login)) {
        $errors['login'] = 'Заполните имя';
    }
    if(empty($pass)) {
        $errors['pass'] = 'Заполните пароль';
    }
    if(empty($mail)) {
        $errors['mail'] = 'Заполните поле с электронной почтой';
    }


    //функция на проверку длины
    function length($value,$min,$max) {
        if(mb_strlen($value) < $min || mb_strlen($value) > $max ) { 
            return false;
        } else {
            return true;
        }
    }

    //если не пустые проверяем длину, если не проходит записваем ошибки в массив
    if (!empty($login) && !empty($pass) && !empty($mail)) {
        
        if(!length($login, 2, 30)) {
          $errors['wrong_numbers_login'] = 'Неверное количество символов';
        }  

        if (!length($pass, 3, 30)) {
          $errors['wrong_numbers_pass'] = 'Неверное количество символов';
        }

        if (!length($mail, 3, 30)) {
          $errors['wrong_numbers_mail'] = 'Неверное количество символов';
        }

    }
    

    //если массив с ошибками пуст записываем значения в БД
    if(!count($errors)) {

        $pass = password_hash($pass,PASSWORD_BCRYPT);

        mysqli_query($link,"
        INSERT INTO `users` SET
        `login`  = '".mysqli_real_escape_string($link,$login)."',
        `password`   = '".$pass."',
        `email`  = '".mysqli_real_escape_string($link,$mail)."'
        ") or exit(mysqli_error($link));

            //указываем логин в куки, и пересылаем на страницу аутентификации
            setcookie("user_info", $login, time()+3600*24*30*3 );
            header('Location:index.php?module=cab&page=auth');
            exit();
    } else {

        //если ошбики есть записываем ошибки в сессию
        $_SESSION['errors'] = $errors;
        $errors = $_SESSION['errors'];
    }

}

























// if(isset($_POST['login'],$_POST['pass'])) {
//     $res = query("
//         SELECT *
//         FROM `users`
//         WHERE `login`  = '".mysqli_real_escape_string_All($_POST['login'])."'
//           AND `password` = '".myHash($_POST['password'])."'
//           AND `active` = 1
//         LIMIT 1 
//     ");
//     if(mysqli_num_rows($res)) {
//         $_SESSION['user'] = mysqli_fetch_assoc($res);
//     } else {
//         $error = 'Такого пользователя не существует';  
//     }
// }

?>