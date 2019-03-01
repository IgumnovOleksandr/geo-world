<?php

class Product{
    public $productId = 0;
    public $name="";
    public $price=0;
    public function __construct($productId = 0, $name = "", $price = 0) {
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }
}

