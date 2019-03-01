<?php

require('classes/product.php');

$product1 = new Product(1, "mouse", 50);
$product2 = new Product(2, "keyboard", 200);
$product1->price = 156;
echo $product1->getPrice();
print_r($product1);
print_r($product2);