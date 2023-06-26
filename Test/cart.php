<?php

class Cart {

    public float $lineprice;
    public static float $quantity = 2;

    public function getTotalPrice(): float{
        return $this-> getTotalPrice()* self::$quantity;
    }
}