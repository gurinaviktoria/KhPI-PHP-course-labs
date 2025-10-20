<?php
require_once 'Product.php';

class DiscountedProduct extends Product {
    public float $discount; // у відсотках
    public function __construct(string $name, float $price, string $description, float $discount) {
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }
    public function getDiscountedPrice(): float {
        return $this->getPrice() * (1 - $this->discount / 100);
    }
    public function getInfo(): void {
        echo "Назва: $this->name<br>";
        echo "Оригінальна ціна: {$this->getPrice()} грн<br>";
        echo "Знижка: $this->discount%<br>";
        echo "Нова ціна: " . $this->getDiscountedPrice() . " грн<br>";
        echo "Опис: $this->description<br><hr>";
    }
}
