<?php
class Product {
    public string $name;
    protected float $price;
    public string $description;
    public function __construct(string $name, float $price, string $description) {
        $this->name = $name;
        $this->setPrice($price);
        $this->description = $description;
    }
    public function setPrice(float $price): void {
        if ($price < 0) {
            throw new Exception("Ціна не може бути від'ємною!");
        }
        $this->price = $price;
    }
    public function getPrice(): float {
        return $this->price;
    }
    public function getInfo(): void {
        echo "Назва: $this->name<br>";
        echo "Ціна: $this->price грн<br>";
        echo "Опис: $this->description<br><hr>";
    }
}
