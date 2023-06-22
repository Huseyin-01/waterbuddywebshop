<?php

require_once('Languages/Home/chosenlanguage.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="CSS/Style_Normalize.CSS" />
  <link rel="stylesheet" href="CSS/Style_Style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="CSS/Style_Login.CSS" />
  <link rel="stylesheet" href="CSS/Style_Account.CSS" />
  <link rel="stylesheet" href="CSS/Style_Cart.CSS" />

  <script src="https://kit.fontawesome.com/3b4c350f83.js" crossorigin="anonymous"></script>
  <title></title>
</head>

<body>
  <header>
    <nav id="nav">
      <a class="logo" href="http://localhost/waterbuddy/Home.php">
        <img src="CSS/Images/waterbuddy_logo.png" alt="logo text" width="65px" height="65px" />
        <span>waterbuddy</span>
      </a>
      <ul class="menu-one">
        <li><a class="item-menu-one" href="Home.php"><?php echo $language["Home"]; ?></a></li>
        <li><a class="item-menu-one" href="Webshop.php"><?php echo $language["Webshop"]; ?></a></li>
        <li><a class="item-menu-one" href="About.php"><?php echo $language["About"]; ?></a></li>
        <li><a class="item-menu-one" href="Contact.php"><?php echo $language["Contact"]; ?></a></li>
      </ul>
      <!-- begin zoekbalk -->
      <div class="search-box">
        <form action="search.php" method="post">
          <input type="text" name="search" placeholder=<?php echo $language["Search"]; ?>>
          <button type="submit" name="submit-search"><i class="fas fa-search"></i></button>
        </form>
      </div>
      <div>
        <Ul class="user">
          <li><a href="User.php">Users</a> </li>
        </Ul>
      </div>
      <!-- einde zoekbalk -->
      <span class="icons">
        <a class="cart-icon" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
        <a class="login-icon" href="Login.php"><i class="fas fa-user"></i></a>
        <a href="?language=nl"><img class="vlag" src="CSS/Images/NL_Flag.jpg" /></a>
        <a href="?language=en"><img class="vlag" src="CSS/Images/EN_Flag.png" alt="EN_flag" /></a>
      </span>
    </nav>
    <hr />
  </header>
</body>

</html>