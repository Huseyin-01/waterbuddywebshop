<?php 

use PHPunit\Framework\TestCase;

// om te testen of de prijs correct word uitgerekend op het moment dat de quantity word verhoogd.

class cartquantitytest extends PHPUnit\Framework\TestCase {
    public function testquantity(){
        require 'cart.php';
        cart::$quantity = 4;

        $cart = new Cart();
        $cart->price = 14.99;
        $totalprice = $cart->getTotalPrice();

        $this->assertEquals(59.96, $totalprice);
    }
}
