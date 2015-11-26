<?php

if(intval($cookie_id) >= 1) {
    foreach ($cookie_id as $value) {
        $cookie_id_arr[] = $value;
    }
    if(count($cookie_id_arr) === 1) {
        $cookie_id_string = implode("",$cookie_id_arr);
        $query_order = mysqli_query($link,"
            SELECT * FROM `items`
            WHERE `id` = ".$cookie_id_string."
        ") or exit(mysqli_error($link));
    } elseif(count($_COOKIE['order_num'])) {
        $cookie_id_string = implode(",",$cookie_id_arr);
        $query_order = mysqli_query($link,"
            SELECT * FROM `items`
            WHERE `id` IN ( ".$cookie_id_string." )
        ") or exit(mysqli_error($link));
    }

}


?>