<?php

class Category
{
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $id, string $name, string $description, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
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

    public function setDescription(string $description): void
    {
        $this->description = $description;
        $this->updateUpdatedAt();
    }

    // Helper method to update the updatedAt timestamp
    private function updateUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getProducts($pdo) {
        $products = [];
    
        try {
            // Préparer la requête pour récupérer tous les produits de cette catégorie
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category_id = :category_id");
            $stmt->execute(['category_id' => $this->id]);
    
            // Récupérer les données de chaque produit
            $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Créer une instance de Product pour chaque produit récupéré
            foreach ($productsData as $productData) {
                $product = new Product(
                    $productData['id'],
                    $productData['name'],
                    json_decode($productData['photos'], true),
                    $productData['price'],
                    $productData['description'],
                    $productData['quantity'],
                    isset($productData['created_at']) ? new DateTime($productData['created_at']) : new DateTime(),
                    isset($productData['updated_at']) ? new DateTime($productData['updated_at']) : new DateTime(),
                    $productData['category_id']
                );
                $products[] = $product; // Ajouter l'instance de Product au tableau
            }
    
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des produits : " . $e->getMessage();
        }
    
        return $products; // Retourner le tableau des produits
    }
}