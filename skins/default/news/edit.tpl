<div>
  
  <form action="" method="post">

    <div>
      Категория новости: <input type="text" name="title" value="<?php echo htmlspecialchars($row['text']); ?>">
    </div>

    <div>
      Категория новости: <input type="text" name="cat" value="<?php echo htmlspecialchars($row['text']); ?> ">
    </div>

    <div>
      Описание новости: <br>
      <textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea>
    </div>

    <div>
      Посмотреть: <br>
      <textarea name="text"><?php echo htmlspecialchars($row['text'])?></textarea>
    </div>

    <input type="submit" name="edit" value="Отредактировать новость">
  </form>

</div>