<?php
require_once 'classes/Product.php';
require_once 'classes/DiscountedProduct.php';
require_once 'classes/Category.php';

// Створення товарів
$product1 = new Product("Ноутбук ASUS", 25000, "Ігровий ноутбук 16GB RAM, SSD 512GB");
$product2 = new Product("Смартфон Samsung", 12000, "Android, 128GB, камера 50MP");
$discounted1 = new DiscountedProduct("Телевізор LG", 18000, "Smart TV 4K", 15);
$discounted2 = new DiscountedProduct("Навушники Sony", 4000, "Бездротові, шумозаглушення", 20);

// Вивід окремих товарів
$product1->getInfo();
$product2->getInfo();
$discounted1->getInfo();
$discounted2->getInfo();

// Створення категорій
$categoryTech = new Category("Техніка");
$categoryTech->addProduct($product1);
$categoryTech->addProduct($discounted1);
$categoryTech->addProduct($discounted2);

// Вивід товарів категорії
$categoryTech->showProducts();

