<?php 

class Product{
public int $productnumber;
public string $productname;
public string $price;
public string $description;
public string $deliverable;
public string $stock;
public int $image_id;
// hierboven zijn de benamingen uit de database
// nieuwe instantie van de klasse, geeft de constructer aan wat er allemaal in moet zitten
public function __construct(int $productnumber, string $productname, string $price, string $description, string $deliverable, $stock, string $image_id){
// variabele maken met een dollar teken 
$this->productnumber = $productnumber;
$this->productname = $productname;
$this->price = $price;
$this->description = $description;
$this->deliverable = $deliverable;
$this->stock = $stock;
$this->image_id = $image_id;
}

// methodes van de klasse, andere functies: 
//bekijkvoorraad, bekijkprijs, bekijkproductnummer, bekijkbeschrijving. getPrice, getDiscription,
public function BekijkProductDetails() {
    // return $this->$description; // 
    $Zoek = 

     '<!-- ---------------------------------- -->
	 <div id="product"><form id= "itemform" action="add.php" method="post">
	 <input type="hidden" name="productnumber" value="'.$this->productnumber.'" />
     <p><img id="image" src="showfile.php?image_id='.$this->image_id.'"></p>
	 <div id="price">€'.number_format($this->price, 2, ',', '.').'</div><br>
	 <div id="prodname">'.$this->productname.'</div><br>
	 <div id="description"></div><br>
	 <div id="deliverable">Deliverable: '.$this->deliverable.'</div>
	 <div id="stock">Stock: '.$this->stock.'</div>
	 <div id="select">Quantity: <input type="text" name="quantity" size="2" maxlength="2" value="1"/>
	 <input type="submit" value="Order" class="buttonBuyNowBasic" /></div>
	 </form></div>'; 

     return $Zoek;
}


} 
//  public function GetPrice() {
//      return $this->price;
//  }


//  public function BekijkVoorraad(){
// 	return $this->stock;
//  }


