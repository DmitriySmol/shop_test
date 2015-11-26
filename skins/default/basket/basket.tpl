<div>Ваш заказ</div>
<div></div>

<?php
if(isset($query_basket)) {
while ($query_basket_row = mysqli_fetch_assoc($query_basket)) { ?>
  <div><?php echo $query_basket_row['name']; ?></div>
  <div class="basket__wrap-img"><img src="<?php echo $query_basket_row['imagePath']; ?>" class="basket__img" alt=""></div>
  <a href="index.php?module=basket&page=basket&index=<?php echo $query_basket_row['id'];?>">Удалить</a>
  <hr>

<?php
  } 
}

?>