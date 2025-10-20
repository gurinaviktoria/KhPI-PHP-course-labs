<?php
require_once 'Product.php';
require_once 'DiscountedProduct.php';

class Category {
    public string $name;
    private array $products = [];
    public function __construct(string $name) {
        $this->name = $name;
    }
    public function addProduct(Product $product): void {
        $this->products[] = $product;
    }
    public function showProducts(): void {
        echo "<h2>Категорія: $this->name</h2>";
        if (empty($this->products)) {
            echo "<p>Товари відсутні</p>";
            return;
        }
        foreach ($this->products as $product) {
            $product->getInfo();
        }
    }
}
