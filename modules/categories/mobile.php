<?php

if(isset($_GET['count'])) {
  $count = $_GET['count'];
} else {
  $count = 0;
}

$query = mysqli_query($link, "
    SELECT * FROM `items`
    ORDER BY `id`
    LIMIT ".$count.",6
") or exit(mysqli_error());

$query_count = mysqli_query($link, "
    SELECT COUNT(*) FROM `items`
    ORDER BY `id`
") or exit(mysqli_error());

$total_rows = mysqli_fetch_assoc($query_count);
$total_rows = (int)implode($total_rows);

$page_rows = 6;
$numRows = ceil($total_rows/$page_rows);

?>