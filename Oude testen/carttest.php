<?php

use PHPUnit\Framework\TestCase;

// Om te testen of de totalprice correct word uitgerekend
class carttest extends PHPUnit\Framework\TestCase {
    public function testTotal(){
        require 'Cart.php';
        $cart = new Cart();
        $cart->price = 14.99;
        $totalprice = $cart->getTotalPrice();

        $this->assertEquals(29.98, $totalprice);
    }
}