<?php 


while ($row = mysqli_fetch_assoc($query_search)) { ?>

<div class="items">
        <?php $num = $row['id'] ;?>
        <a href="index.php?module=categories&page=product&product_info=<?php echo $num;?>">
        <div class="items__wrapper-item">
          <img class="item__img" src="<?php echo $row['imagePath']; ?>" alt="">
        </div>
        <div class="items__name-characteristic-wrapper">
          <div class="items__name"><?php echo $row['name']; ?></div>
          <div class="items__characteristic"><?php echo $row['characteristics']; ?></div>
        </div>
      </a>
    </div>

<?php } ?>