<?php
class Product
{
    private int $id;
    private string $name;
    private array $photos;
    private int $price;
    private string $description;
    private int $quantity;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $category_id; // Nouveau champ

    public function __construct(
        int $id, 
        string $name, 
        array $photos, 
        int $price, 
        string $description, 
        int $quantity, 
        DateTime $createdAt, 
        DateTime $updatedAt,
        int $category_id // Nouveau paramètre
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->category_id = $category_id; // Initialisation du nouveau champ
    }

    // Nouveau getter pour category_id
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    // Nouveau setter pour category_id
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
        $this->updateUpdatedAt();
    }

    // Les autres getters et setters restent inchangés...

    private function UpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }


    // Les getters et setters restent inchangés


    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    // Setters
    public function setName(string $name): void
    {
        $this->name = $name;
        $this->updateUpdatedAt();
    }

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
        $this->updateUpdatedAt();
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
        $this->updateUpdatedAt();
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
        $this->updateUpdatedAt();
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
        $this->updateUpdatedAt();
    }

    private function updateUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }
}
?>