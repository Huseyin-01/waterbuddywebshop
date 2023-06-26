<?php
require_once('Languages/Home/chosenlanguage.php');

include('header.php');
?>


<!DOCTYPE html>
<html lang="en">
<!--

 __          __   _            ____            _     _       
 \ \        / /  | |          |  _ \          | |   | |      
  \ \  /\  / /_ _| |_ ___ _ __| |_) |_   _  __| | __| |_   _ 
   \ \/  \/ / _` | __/ _ \ '__|  _ <| | | |/ _` |/ _` | | | |
    \  /\  / (_| | ||  __/ |  | |_) | |_| | (_| | (_| | |_| |
     \/  \/ \__,_|\__\___|_|  |____/ \__,_|\__,_|\__,_|\__, |
                                                        __/ |
                                                       |___/ 




-->

<head>
  <meta name="description" content="Let WaterBuddy help you take care of your plants with our sensor and our app." />
  <meta name="robots" content="noindex,nofollow" />

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="CSS/Style_AboutUs.CSS">
  <title><?php echo $language["About Us"]; ?></title>

</head>

<body>
  <main>
    <div class="main__about">
      <h1><?php echo $language["About Us"]; ?></h1>
      <p>
        <?php echo $language["We as WaterBuddy want to ensure that people who normally cannot take good care of plants can still enjoy healthy and living plants for a long time."]; ?>
      </p>
      <p>
        <?php echo $language["Delivering products and services that make it easy for the user to take care of their plants is of paramount importance to WaterBuddy."]; ?>
        <br><?php echo $language["We do our best to help you take the best care of your plants."]; ?></br>
      </p>
    </div>
    <div class="main__team">
      <h2><?php echo $language["The team"]; ?></h2>
      <p>
        <?php echo $language["The team behind WaterBuddy got to know each other during the Computer Science program at Avans hogeschool in Breda."]; ?>
        <?php echo $language["The WaterBuddy Team consists of 2 owners."]; ?>
        <?php echo $language["All owners have a different function within the company and perform different tasks. Below, each owner of Waterbuddy is briefly introduced."]; ?>
      </p>
    </div>

    <div class="main__introduction">
      <div class="main__introduction__name">
        <h3>Huseyin</h3>
      </div>
      <div class="main__introduction__text">
        <p>
          <?php echo $language["After Huseyin completed his MBO-4 (branch) manager training in 2010,he has worked here and there."]; ?>
          <?php echo $language["He ownes a taxi company in Amsterdam since 2017 and recently he is part of a promising innovative startup called: WaterBuddy."]; ?>
          <?php echo $language["Of course like many other entrepreneurs,"]; ?>
          <?php echo $language["he wants to increase his knowledge and experience to be successful and make a career switch"]; ?>
          <?php echo $language["and that is why he recently started training in computer science."]; ?>
          <?php echo $language["He also regularly sports and likes to read non-fiction books."]; ?>
        </p>
      </div>

      <div class="main__introduction__image main__introduction__image--left">
        <img src="CSS/Images/Huseyin_AboutUs.jpg" alt="Image of Roy Schrauwen" />
      </div>
    </div>

    <div class="main__introduction--flipped">
      <div class="main__introduction__image main__introduction__image--right">
        <img src="CSS/Images/Lieke_AboutUs.jpg" alt="Image of Roy Schrauwen" />
      </div>
      <div class="main__introduction__name">
        <h3>Lieke</h3>
      </div>
      <div class="main__introduction__text">
        <p>
          <?php echo $language["Lieke has been interested in computers and programming since she was a child."]; ?>
          <?php echo $language["Due to the increasing developments in the field of digitization and the important strategic importance of IT within Waterbuddy BV,"]; ?>
          <?php echo $language["this seemed to Lieke the perfect time to start studying Computer Science."]; ?>
          <?php echo $language["Lieke is 29 years old and comes from Nijmegen."]; ?>
          <?php echo $language["In her current job, she works in field for Nestlé & Jumbo."]; ?>
          <?php echo $language["With years of product knowledge, Lieke would like to delve into improving the products and increasing the convenience of households."]; ?>
        </p>
      </div>
    </div>
    <!--<div class="main__introduction">
      <div class="main__introduction__name">
        <h3>Milan</h3>
      </div>
      <div class="main__introduction__text">
        <p>
         /* <?php echo $language["Milan is 26 years old and after working in logistics for 2 years he made the decision to switch to a career in the IT."]; ?>
          <?php echo $language["Here, after building up 1.5 years of experience, he has decided to get further training in the field of computer science."]; ?>
          <?php echo $language["Now he wants to combine all the experience he has built up with his partners to start his own business, in smart plant care."]; ?>
          <?php echo $language["Outside of working, Milan can also be found on the judo mat, the bicycle or in a good restaurant with friends and family."]; ?>
          <?php echo $language["But for now he is focusing on his studies and the newly founded company."]; ?> */
        </p>
      </div>
      <div class="main__introduction__image main__introduction__image--left">
        <img src="CSS/Images/Milan_AboutUs.jfif" alt="Image of Roy Schrauwen" />
      </div> 
    </div> -->
    <!--<div class="main__introduction--flipped">
        <div class="main__introduction__image main__introduction__image--right">
          <img src="./images/pasfoto_roy.jpg" alt="Image of Roy Schrauwen" />
        </div>
        <div class="main__introduction__name">
          <h3>Roy</h3>
        </div>
        <div class="main__introduction__text">
          <p>
            With almost twenty years of experience in theater technology, Roy,
            in addition to having a broad technical background, also has
            extensive experience with providing convenience and comfort to
            guests. That combined experience is used in this project to develop
            a product that uses technology to provide convenience to the user.
          </p>
        </div>
      </div> -->
  </main>
  <footer>
    <h2><?php echo $language["Order your WaterBuddy now"]; ?></h2>
    <a href="webshop.php" class="button orderbutton"><?php echo $language["Go to the Webshop"]; ?></a>
  </footer>
  <script src="Javascript/script_roy.js"></script>
</body>

<footer>

<!-- Onderstaand de twee download buttons onderaan de pagina -->

<div class="download">
  <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-apple"></i> Download</button>
  <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-google-play"></i> Download</button>

</div>

<p class="copyright">© Copyright 2021 WaterBuddy</p>

</footer>

</html>