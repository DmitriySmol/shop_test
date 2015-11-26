<?php

$product_info = $_GET['product_info'];

$item_query = mysqli_query($link, "
    SELECT * FROM `items`
    WHERE `id` = ".$_GET['product_info']."
") or exit(mysqli_error());
$item = mysqli_fetch_assoc($item_query);

@$id_viewed = unserialize($_COOKIE['item_id']);

if(intval(@$id_viewed) === 0) {
    $arr = array();
    $arr[] = $_GET['product_info'];
    $arr_value_str = implode("",$arr);

    $item_viewed_query = mysqli_query($link, "
        SELECT * FROM `items`
        WHERE `id` = ".$arr_value_str."
    ") or exit(mysqli_error($link));

    setcookie('item_id', serialize($arr), time()*3600*24*30*6,"/");

} else {
    $id_viewed[] = $item['id'];
    $id_viewed = array_unique($id_viewed);
    $arr_value = array();

    foreach ($id_viewed as $key => $value) {
        $arr_value[] = $value;
        if(count($arr_value > 0)) {
            $arr_value_str = implode(",",$arr_value);
            $item_viewed_query = mysqli_query($link, "
                SELECT * FROM `items`
                WHERE `id` IN ( ".$arr_value_str." )
            ") or exit(mysqli_error($link));
        };

    }
    setcookie('item_id', serialize($arr_value), time()*3600*24*30*6,"/");

}



if(isset($_GET['order_num'])) {
    @$cookie_order_num = unserialize($_COOKIE['order_num']);

    if(intval(@$cookie_order_num) === 0) {
        $order_num[] = $_GET['order_num'];
        setcookie('order_num',serialize($order_num),time()*3600*24*30*6,"/");
        header('Location: http://test/index.php?module=categories&page=mobile');
    } else {
        $cookie_order_num[] = $_GET['order_num'];
        setcookie('order_num',serialize($cookie_order_num),time()*3600*24*30*6,"/");
        header('Location: http://test/index.php?module=categories&page=mobile');
    }

}

?>