<div>
  <div class="product-item__img-wrapper">
    <img class="product-item__img" src="<?php echo $item['imagePath'] ;?>" alt="">
  </div>
  <div><?php echo $item['name']; ?></div>
  <div><?php echo $item['characteristics']; ?></div>
  <div class="product_id-product">ID товара: <?php echo $item['id']; ?></div>
</div>
<div class="product__submit-div">
  <a class="product__submit" href="index.php?module=categories&page=product&item=<?php echo $item['id']; ?>&product_info=<?php echo $_GET['product_info'];?>&order_num=<?php echo $item['id'];?>">Заказать</a>
</div>


<?php

if(isset($item_viewed_query)) { ?>

<div class="product__viewed"> Вы смотрели: </div>

<?php while ($item_viewed = mysqli_fetch_assoc($item_viewed_query)) { ?>

    <div class="item_viewed">
    <a href="index.php?module=categories&page=product&product_info=<?php echo $item_viewed['id']; ?>">
      <img class="product-item__img-viewed" src="<?php echo $item_viewed['imagePath'];?>" alt="">
      <?php echo $item_viewed['name'];?>
    </a>
    </div>

<?php } } ?>

