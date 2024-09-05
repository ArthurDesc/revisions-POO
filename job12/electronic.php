<?php
require_once 'Product.php'; // Assure-toi que la classe Product est incluse

class Electronic extends Product {
    private string $brand;
    private int $warranty_fee;

    public function __construct(
        int $id = 0,
        string $name = '',
        array $photos = [],
        int $price = 0,
        string $description = '',
        int $quantity = 0,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
        int $category_id = 0,
        string $brand = '',
        int $warranty_fee = 0
    ) {
        // Appelle le constructeur parent pour initialiser les propriétés héritées
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id);

        // Initialisation des propriétés spécifiques à Electronic
        $this->brand = $brand;
        $this->warranty_fee = $warranty_fee;
    }

    // Getters et Setters pour les nouvelles propriétés
    public function getBrand(): string {
        return $this->brand;
    }

    public function setBrand(string $brand): void {
        $this->brand = $brand;
    }

    public function getWarrantyFee(): int {
        return $this->warranty_fee;
    }

    public function setWarrantyFee(int $warranty_fee): void {
        $this->warranty_fee = $warranty_fee;
    }
}
?>