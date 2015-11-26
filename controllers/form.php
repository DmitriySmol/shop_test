<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();
//данные из формы
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $pass = $_POST['pass'];
    $confirmpass = $_POST['confirmpass'];
    $mail = $_POST['mail'];
    $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);

    function clean($val) {
        $val = trim($val);
        $val = stripslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    clean($name);
    clean($surname);
    clean($mail);
    clean($pass);

    function check_length($value, $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    if($pass !== $confirmpass) {
        echo $pass;
        die();
    }

    if(!empty($name) && !empty($surname) && !empty($mail) && !empty($pass) ) {

        if(check_length($name, 2, 20) && check_length($surname, 2, 30) && check_length($mail, 5,30)) {
            $answer = array('name' => $name, 'surname' => $surname, 'mail' => $mail, 'pass' => $pass);
            setcookie("user_info", $name, time()+3600*24*30*3, "/");
            $_COOKIE["user_info"] = $name;
            print json_encode($answer);
            
        } else {
            echo $name,$surname,$mail,$pass;
            die();
        }

  }


?>