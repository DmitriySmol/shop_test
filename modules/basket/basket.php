<?php

@$order_num = unserialize($_COOKIE['order_num']);

if(empty($order_num)) {
    header('Location: ./index.php?module=categories&page=mobile');
}

$arr = array();

foreach ($order_num as $key => $value) {
    $arr[] = $value;
}


if(count($order_num) === 1) {
    $string = implode("",$arr);
    $query_basket = mysqli_query($link,"
        SELECT * FROM `items`
        WHERE `id` = ".$string."
    ") or exit(mysqli_error($link));
    } elseif(count($order_num) > 1) {
    $string = implode(",",$arr);
    $query_basket = mysqli_query($link,"
        SELECT * FROM `items`
        WHERE `id` IN ( ".$string." )
    ") or exit(mysqli_error($link));
    }

if(isset($_GET['index'])) {
    $index = $_GET['index']; 
    foreach ($order_num as $key => $value) {
        if($index === $value) {
            unset($order_num[$key]);
        }
    }

    setcookie('order_num',serialize($order_num),time()*3600*24*30*6,"/");
    header('Location: index.php?module=basket&page=basket');
    
}

//or exit(mysqli_error($link))

?>