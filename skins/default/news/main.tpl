<div>Новости <hr>

<a href="index.php?module=news&page=add">Добавить новость</a>

<?php
if (isset($info)) { ?>

  <h1><?php echo $info; ?></h1>

<?php } ?>

<form action="" method="post">
    <?php
    while ($row = mysqli_fetch_assoc($news)) { ?>
      <div>
        <input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>">
        <a href="index.php?module=news&action=delete&id=<?php echo $row['id']; ?>">Удалить</a>
        <a href="index.php?module=news&page=edit&id=<?php echo $row['id']; ?>">Отредактировать</a>
      </div>
      <div>
        <div>
        <?php
            echo $row['title'];
            echo '<br>'.$row['date'];
            echo '<br>'.$row['text'];
        ?>
        </div>
      </div>
      <hr>
    <?php } ?>
    <input type="submit" name="delete">
</form>



</div>