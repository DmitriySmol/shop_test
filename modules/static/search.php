<?php

$input_name = $_POST['item-name'];

$input_name = trim($input_name);
$input_name = mysqli_real_escape_string($link,$input_name);
$input_name = htmlspecialchars($input_name);

if(!empty($input_name)) {
    if(strlen($input_name) < 2) {
      $error = '<p>Слишком короткий запрос</p>';
    }
    if(strlen($input_name) > 50) {
      $error = '<p>Слишком длинный запрос</p>';
    
    } else {

        $query_search = mysqli_query($link,"
            SELECT * 
            FROM `items`
            WHERE (      `name` LIKE '%$input_name%'
                      OR `characteristics` LIKE '%$input_name%'
                  )
        ") or exit(mysqli_error($link));

    }
    if (mysqli_affected_rows($link) > 0) {
        $num_rows_query = mysqli_num_rows($query_search);
    }




}

?>