<!DOCTYPE html>
<html lang="ru-RU">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="author" content="Dmitriy Smolyarenko">
    <title>3.Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" href="http://faviconka.ru/ico/faviconka_ru_283.ico" type="image/x-icon">
    <link rel="icon" href="http://faviconka.ru/ico/faviconka_ru_283.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/shop.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/product_info.css">
    <link rel="stylesheet" href="css/font/font.css">
    <link rel="stylesheet" href="css/basket/basket.css">
    <link rel="stylesheet" href="css/cab/auth.css">
  </head>
  <body>
    <!--if lt IE 8
    p.browserupgrade
      | You are using an 
      strong outdated
      |  browser. Please 
      a(href='http://browsehappy.com/') upgrade your browser
      |  to improve your experience.
    -->
    <div class="wrapper">
      <header class="header">
        <div class="adress-center">
          <div class="social-top">
            <ul class="social-top__ul">
              <li class="social-top__li"><img src="img/vk-top.png" height="20" width="21" alt="Vk" class="social-top__icons-img"></li>
              <li class="social-top__li"><img src="img/fb-top.png" height="20" width="21" alt="fb" class="social-top__icons-img"></li>
              <li class="social-top__li"><img src="img/tw-top.png" height="20" width="22" alt="tw" class="social-top__icons-img"></li>
            </ul>
          </div>
          <div class="adress-location"><img src="img/map-location.png" height="22" width="16" alt="location" class="adress-location__map-location-img">
            <div class="adress-location__text">г. Москва, ул. Новая 24б, офис 214</div>
          </div><a href="tel:+79213221232" class="phone-number"> 
            <div class="phone-number__4-numbers">+7 (921) </div>
            <div class="phone-number__7-numbers">322 12 32</div></a>
        </div>
      </header>
      <div class="gradient-background">     
        <nav class="buy-info clearfix">
          <div class="buy-info__logo-big">
            <div class="buy-info__logo-text">ЭпплShop</div><img src="img/apple-shop-top.png" alt="ЭпплShop" class="logo-big__logo-big-img">
          </div>
          <div class="buy-info__form-search">
            <form name="search-item" method="post" class="form-search__form" action="./index.php?module=static&page=search">
              <input type="text" name="item-name" placeholder="" class="form-search__input-item-name">
              <input type="submit" name="item-search" value="Поиск" class="form-search__input-submit-search">
            </form>
          </div>
          <?php @print_r($cookie_id); ?>
          <ul class="buy-info__ul-nav">
            <?php if(!empty($_COOKIE['user_info'])) { ?>
               <li class="ul-nav__links-wrapper-first"><?php echo $_COOKIE['user_info']; ?>Здравствуйте!</a>
                </li>
                <li class="ul-nav__links-wrapper-first"><a href="./index.php?module=cab&page=exit" class="ul-nav__link">Выйти!</a>
                </li>
            <?php } ?>
            <li class="ul-nav__links-wrapper-first"><a href="./index.php?module=cab&page=auth" class="ul-nav__link">Вход/Регистрация</a>
            </li>
            <li class="ul-nav__links-wrapper-last-link">
              <a href="index.php?module=basket&page=basket" class="ul-nav__links-wrapper-last-link-a"> 
                <div class="ul-nav__sprite">
                  <div class="sprite sprite-chip-basket-no-effect"></div>
                </div>
                <div class="ul-nav__chip-basket">Корзина (<?php 
                    $cookie_id = @unserialize($_COOKIE['order_num']);
                    if(@intval($cookie_id) === 0) {
                        echo @intval($cookie_id);
                    } else {
                        echo count($cookie_id);
                    }
                                 
                ?>)
                </div>
              </a>
              <ul class="invisibil-list">
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
                    
                    // print_r($cookie_id_string);
                    while ($query_order_row = mysqli_fetch_assoc($query_order)) { ?>

                      <li class="invisibil-list__li">
                          <div class="invisibil-list__wrap-list">
                            <a href="">
                              <div class="invisibil-list__wrap-img">
                                <img src="<?php echo $query_order_row['imagePath']; ?>" alt="iphone-5" class="invisibil-list__wrapper-img">
                              </div><div class="invisibil-list__wrap-name"><?php echo $query_order_row['name']; ?>
                              </div>
                            </a>
                          </div>
                      </li>
                <?php } } ?>
              </ul>
            </li>
          </ul>
          <?php 
          while (@$query_order_row = mysqli_fetch_assoc($query_order)) { ?>

                      <li class="invisibil-list__li">
                          <a href="" class="invisibil-list__wrapper-for-img"><img src="<?php echo $query_order['imagePath']; ?>" alt="iphone-5" class="invisibil-list__wrapper-img"><?php echo $query_order['name']; ?>
                          </a>
                      </li>
            <?php } ?>
        </nav>
      </div>
      <div class="navigation-line">
        <nav class="nav-items">
          <ul class="navigation-line__navigation"> 
            <li class="navigation__items navigation-items-1">
              <div class="navigation__triangle-first-child"></div><a href="index.php?module=categories&page=mobile" class="navigation__links">Мобильные телефоны
                <div class="navigation__triangle"></div></a>
            </li>
            <li class="navigation-items-2 navigation-items-blue"><a href="index.php?module=categories&page=tablets" class="navigation-links-blue">Планшеты
                <div class="navigation-triangle-blue"></div></a></li>
            <li class="navigation__items navigation-items-3"><a href="" class="navigation__links">Mp3 плееры
                <div class="navigation__triangle"></div></a></li>
            <li class="navigation__items navigation-items-4"> <a href="" class="navigation__links">Персональные компьютеры
                <div class="navigation__triangle"></div></a></li>
            <li class="navigation__items navigation-items-5"> <a href="" class="navigation__links">Ноутбуки</a>
              <div class="navigation__triangle"></div>
            </li>
            <li class="navigation__items navigation-items-6"> <a href="" class="navigation__links">Apple TV</a>
              <div class="navigation__triangle"></div>
            </li>
            <li class="navigation__items navigation-items-7"> <a href="" class="navigation__links">Аксессуары</a>
              <div class="navigation__triangle"></div>
            </li>
          </ul>
        </nav>
      </div>
      <article class="main">

      <?php
      include $_GET['module'].'/'.$_GET['page'].'.tpl';
      ?>

      </article>
      <footer class="footer-big">
        <div class="footer-centralize">
          <div class="logo-white"><img src="img/aple-shop-little.png" alt="Apple-shop" class="logo-white-img"></div>
          <div class="info-about-shop">
            <div class="info-about-shop__about-shop-list">
              <ul class="info-about-shop__catalog-ul">
                <li class="info-about-shop__about-shop-ul-li-header">О магазине</li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">О нас</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Наши цены</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Наши скидки</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Акции</a></li>
              </ul>
            </div>
            <div class="info-about-shop__about-shop-list">
              <ul class="info-about-shop__catalog-ul">
                <li class="info-about-shop__about-shop-ul-li-header">Каталог</li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Смартфоны</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Планшеты</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Компьютеры</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Аксессуары</a></li>
              </ul>
            </div>
            <div class="info-about-shop__about-shop-list">
              <ul class="info-about-shop__catalog-ul">
                <li class="info-about-shop__about-shop-ul-li-header">Контакты</li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Смартфоны</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Планшеты</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Компьютеры</a></li>
                <li class="info-about-shop__about-shop-ul-li"><a href="" class="info-about-shop__links">Аксессуары</a></li>
              </ul>
            </div>
          </div>
          <div class="App-store-and-soc">
            <div class="App-store-and-soc-float clearfix"><a href="" class="App-store-and-soc__App-store"><img src="img/app-store.png" alt="App-store"></a><a href="" class="App-store-and-soc__google"><img src="img/google-play.png" alt="Google-play"></a></div>
            <div class="social-bottom">
              <ul class="social-bottom__ul">
                <li class="social-bottom__ul-li"><a href="" class="social-bottom__ul-li">
                    <div class="sprite sprite-vk"></div></a></li>
                <li class="social-bottom__ul-li"><a href="" class="social-bottom__ul-li">
                    <div class="sprite sprite-fb"></div></a></li>
                <li class="social-bottom__ul-li"><a href="" class="social-bottom__ul-li">
                    <div class="sprite sprite-tw"></div></a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer><a href="#" class="scroll">Наверх<img src="img/scroll-1.png" alt="" class="scroll__img"><img src="img/scroll-2.png" alt="" class="scroll__img-white"></a>
    </div>
    <script src="./js/vendor/jquery-1.11.3.min.js">   </script>
    <script src="js/main.js"></script>
  </body>
</html>