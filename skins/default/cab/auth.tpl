<div class="form">
  <?php if(!isset($_COOKIE['user_info'])) { ?>
  <form action="" method="post" class="form-ajax">
      <label for="">Ваше Логин:</label>
      <input type="text" name="login" class="form__input">
      
      <?php 
      if (isset($errors)) {
          foreach ($errors as $key => $value) {

              if ($key === 'wrong_numbers_login') {
                  echo "<div class='form__incorrect-div'><div class='form__incorrect-div-triangle'></div>".$errors['wrong_numbers_login']."</div>"; 
                  break;
              }

              if ($key === 'login') {
                  echo "<div class='form__incorrect-div'><div class='form__incorrect-div-triangle'></div>".$errors['login']."</div>"; 
              }

          }
      }
      ?>

      <label for="">Email:</label>
      <input type="text" name="mail" class="form__input">
      <?php 
      if (isset($errors)) {
          foreach ($errors as $key => $value) {
              
              if ($key === 'wrong_numbers_mail') {
                  echo "<div class='form__incorrect-div'><div class='form__incorrect-div-triangle'></div>".$errors['wrong_numbers_mail']."</div>"; 
                  break;               
              }

              if ($key === 'mail') {
                  echo "<div class='form__incorrect-div'><div class='form__incorrect-div-triangle'></div>".$errors['mail']."</div>"; 
                  break;
              }

              }
      }
      ?>

      <label for="">Пароль:</label>
      <input type="password" name="pass" class="form__input">
      
      <?php 
      if (isset($errors)) {
          foreach ($errors as $key => $value) {
              
              if ($key === 'wrong_numbers_pass') {
                  echo "<div class='form__incorrect-div'><div class='form__incorrect-div-triangle'></div>".$errors['wrong_numbers_pass']."</div>"; 
                  break;               
              }

              if ($key === 'pass') {
                  echo "<div class='form__incorrect-div'><div class='form__incorrect-div-triangle'></div>".$errors['pass']."</div>"; 
              }
          }
      } 
      ?>

      <input type="submit" name="submit" class="sbm">
  </form>
</div>

<?php } else {
  echo "Здравствуйте,".$_COOKIE['user_info']."!"."<br>Мы сохранили ваш пароль и захешировали и на случай взлома базы данных, хорошего дня!";
} ?>