
<?php
error_reporting(E_ERROR | E_PARSE);

$page_title = 'Cart';
include ('header.php');
require_once('Languages/Home/chosenlanguage.php');

// mysqli_connect.php bevat de inloggegevens voor de database.
include ('includes/mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');

// Page header:
echo '<h1>Cart</h1>';

// cart.php
// winkelwagen met bijbehorende functionaliteit
session_start();

// Kijk of er iets in de winkelwagen zit
if (empty($_SESSION['cart'])){ 
    echo $language["Cart is empty"];
}
else {
    // Exploden
    $cart = explode("|",$_SESSION['cart']);

    // Tellen inhoud winkelwagen
    $count = count($cart);
    if ($count == 1) {
      echo "<p id='cartamount'>You got 1 item in your cart.</p>\n";
    } else {
        echo "<p id='cartamount'>You got ".$count." items in your cart.</p>\n";
    }

    // functies voor het weghalen van producten uit de winkelwagen en heel wagen leeghalen
    
    ?>
    <script type="text/javascript">
    <!--
    function removeItem(item) {
        var answer = confirm ('Are you sure you want to remove this item?')
        if (answer)
            window.location="delete_cart_item.php?item=" + item;
    }

    function removeCart() {
        var answer = confirm ('Are you sure you want to empty the cart?')
        if (answer)
            window.location="delete_cart.php";
    }
    //-->
    </script>
    <form class="formcart" method="post" name="form" action="update_cart.php">
    <table class="tablecart">
	<thead>
    <tr>
        <th><?php echo $language["Productnr"]; ?></th>
        <th><?php echo $language["Productname"]; ?></th>
        <th><?php echo $language["Quantity"]; ?></th>
        <th><?php echo $language["Price"]; ?></th>
        <th><?php echo $language["Total"]; ?></th>
        <th>&nbsp;</th> 
    </tr>
	</thead>
    <?php

    // Totaal (komt later terug)
    $total = 0;
	
	// 
	//
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	 
	// check connection
	if (mysqli_connect_errno()) {
		printf("<p><b>Error: connecting to the datebase failed.</b><br/>\n%s</p>\n", mysqli_connect_error());
		exit();
	}

    // Toon de producten in de winkelwagen
    $i = 0;
    foreach($cart as $products) {
      // Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
      $product = explode(",", $products);

      if (strlen(trim($product[1])) <> 0) {
		  // Get product info
		  $sql = "SELECT productnumber, productname, price 
				  FROM products
				  WHERE productnumber = ".$product[0];  // Weet je nog, uit die sessie
				  
		  $result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
		  $pro_cart = mysqli_fetch_object($result);
		  $i++;

		  echo "<tbody>\n<tr>\n";
		  echo "  <td id='tdcart'>".$pro_cart->productnumber."</td>\n";   // nummer
		  echo "  <td id='tdcart'>".$pro_cart->productname."</td>\n";     // naam
		  echo "  <td id='tdcart'><input type=\"hidden\" name=\"productnumber_".$i."\" value=\"".$product[0]."\" />\n"; // wat onzichtbare vars voor het updaten
		  echo "      <input id='tdcart' type=\"text\" name=\"quantity_".$i."\" value=\"".$product[1]."\" size=\"2\" maxlength=\"2\" /></td>\n";
		  echo "  <td id='tdcart'>€ ".number_format($pro_cart->price, 2, ',', '.')."</td>\n";
		  $lineprice = $product[1] * $pro_cart->price;      // regelprijs uitrekenen > hoeveelheid * prijs
		  echo "  <td id='tdcart'>€ ".number_format($lineprice, 2, ',', '')."</td>\n";
		  echo "  <td id='tdcart'><a href=\"javascript:removeItem(".$i.")\">X</td>\n"; // Verwijder, mooi plaatje van prullebak ofzo
		  echo "</tr>\n</tbody>";
		  // Total
		  $total = $total + $lineprice;         // Totaal updaten
      }
    }
    ?>
	<tfoot>
    <tr>
        <td colspan="4"><strong><?php echo $language["Total"]; ?></strong></td>
        <td><strong><?php echo "€ ".number_format($total, 2, ',', '.'); ?></strong></td>
        <td>&nbsp;</td>
    </tr>
	</tfoot>
    <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="4"><input type="submit" value=<?php echo $language["Refresh"] ?> /></td>
    </tr>
    </table>
    </form>
  <p>
  <ul class="ulcard">
		<li><a href="javascript:removeCart()"><?php echo $language["Empty cart"]; ?></a><br /></li>
		<li><a href="checkout.php"><?php echo $language["Pay"]; ?></a><br /></li>
		<li><a href="webshop.php"><?php echo $language["Continue shopping"]; ?></a></li>
	</ul>	
  </p>
  <?php
}
	


?> 
