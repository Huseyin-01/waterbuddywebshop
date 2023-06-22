<?php 

require_once('Languages/Home/chosenlanguage.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="CSS/Style_General.css" />
    <link rel="stylesheet" href="CSS/Style_Webshop.css"/>
</head>
<body>

    <main>
        <div class="flexboxContainer">
            <div class="itemFlex itemFlex1">
              <i class="icon fas fa-check fa-4x"></i>
              <h3><?php echo $language["Easy to use."]; ?> </h3>
              <p><?php echo $language["Plug in the pot connect to the app and you're done"]; ?></p>
            </div>
      
            <div class="itemFlex itemFlex2">
              <i class="icon fas fa-bullseye fa-4x"></i>
              <h3><?php echo $language["Guaranteed to work"]; ?></h3>
              <p><?php echo $language["We guarentee that the product informs you"] ?><br>
                <?php echo $language["correctly of the water needs"]; ?></p>
            </div>
      
            <div class="itemFlex itemFlex3">
              <i class="icon fas fa-heart fa-4x"></i>
              <h3><?php echo $language["Your plants will love you!"]; ?></h3>
              <p><?php echo $language["Now that they will always have water your plants"]; ?> <br>
                <?php echo $language["will live a happy live!"]; ?></p>
            </div>
          </div>
      
          <!-- Onderstaande 2 divs verzorgen de extra informatie over ons product -->
      
          <div class="waterBuddyBasic" id="waterBuddyBasic">
            <p>
              <img src="CSS/Images/Waterbuddy_Basic_Plant.png" alt="WaterBuddy Basic, copyright WaterBuddy" class="basicInformation">
            <h3 class="waterBuddyBasicText">WaterBuddy Basic</h3><br>
            <?php echo $language["The WaterBuddy Basic is there for those that just need the reminder that their plant needs water."]; ?><br>
            <?php echo $language["This is all done trough the smart monitor that you put in your plant pot, this will monitor the water needs."]; ?><br>
            <?php echo $language["Meaning that if your plant is in need of water the WaterBuddy basic will send a notification on your phone trough the app."]; ?><br>
            <?php echo $language["The WaterBuddy Basic is there to help you keep your plants alive!"]; ?>
      </p>
          </div>
      
          <div class="waterBuddyPro" id="waterBuddyPro">
            <p>
              <img src="CSS/Images/Waterbuddy_Pro_Plant.png" alt="WaterBuddy Pro, copyright WaterBuddy" class="proInformation">
            <h3 class="waterBuddyProText">WaterBuddy Pro</h3><br>
            <?php echo $language["The WaterBuddy Pro does the same as the WaterBuddy Basic, but it has a resovoir to automatically water your plants!"]; ?>
            <?php echo $language["Once this resovoir is running low you'll receive a notification on your mobile trough the app reminding you to fill it."]; ?>
            <?php echo $language["The WaterBuddy Pro is also capable of feeding your plants when needed, thanks to smart monitoring."]; ?>
            <?php echo $language["The WaterBuddy Pro is not only there to help you it can also keep your plants alive itself!"]; ?>
      </p>
          </div>
      
    </main>

    <footer>

        <!-- Onderstaand de twee download buttons onderaan de pagina -->
        
        <div class="download">
          <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-apple"></i> Download</button>
          <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-google-play"></i> Download</button>
        
        </div>
        
        <p class="copyright">© Copyright 2021 WaterBuddy</p>
        
        </footer>
    
</body>
</html>