<?php
$c = array("team player", "self improving", "game changer");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo $link ?>>
    <link rel="stylesheet" href="http://localhost/public_html/public/css/template.css">
  </head>
  <body>

    <div class="header">
      <p id="traits"><?php echo(json_encode($c)); ?></p>
      <div class=" media name_container">
        <p>Crisan</p>
        <p style="color: #D30000; font-weight:300"> | </p>
        <p>Paul</p>
        <div class="pic_container">

        </div>
      </div>
    </div>

    <!-- lista -->
    <div class="menu-items">
      <ul class="menu-list">
        <a href="http://localhost/public_html/home/index"><li class="menu-el"><span id="about">About me</span></li></a>
        <li class="menu-el">
          <span>Php</span>
          <div class="hide">
            <ul class="menu-list sublist">
              <a href="http://localhost/public_html/php/model-view-controller"><li class="menu-el submenu ">MVC</li></a>
              <a href="http://localhost/public_html/php/hangman-php-game"><li class="menu-el submenu">Hangman</li></a>
            </ul>
          </div>


        </li>
        <li class="menu-el"><span>Java</span>
          <div class="hide">
            <ul class="menu-list sublist">
              <a href="http://localhost/public_html/java/android-applications"><li class="menu-el submenu ">Android</li></a>
              <a href="http://localhost/public_html/java/java-course"><li class="menu-el submenu">Course</li></a>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  <!-- lista -->
    <div class="main-content">
      <?php include($page); ?>
    </div>
    <div class="footer">
      <p>Contact: crisanpaul@gmail.com <br> tel: +40 756 072 700 </p>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/public_html/public/js/template.js"></script>
    <script type="text/javascript" src=<?php echo $script ?>></script>

  </body>
</html>
