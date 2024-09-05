<?php
require_once 'Category.php';
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
        int $id = 0,
        string $name = '',
        array $photos = [],
        int $price = 0,
        string $description = '',
        int $quantity = 0,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
        int $category_id = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
        $this->category_id = $category_id; // Initialisation du nouveau champ
    }

    // Nouveau getter pour category_id
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getCategory($pdo) {
        try {
            // Préparer la requête pour obtenir la catégorie par ID
            $stmt = $pdo->prepare("SELECT * FROM category WHERE id = :id");
            $stmt->execute(['id' => $this->category_id]);
    
            // Récupérer les données de la catégorie
            $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Vérifier si la catégorie existe
            if ($categoryData) {
                // Vérifier l'existence des clés et définir des valeurs par défaut
                $createdAt = isset($categoryData['created_at']) ? new DateTime($categoryData['created_at']) : new DateTime();
                $updatedAt = isset($categoryData['updated_at']) ? new DateTime($categoryData['updated_at']) : new DateTime();
    
                // Créer une nouvelle instance de Category avec les paramètres nécessaires
                $category = new Category(
                    $categoryData['id'],
                    $categoryData['name'],
                    $categoryData['description'] ?? '', // Gérer la description manquante avec une valeur par défaut
                    $createdAt,
                    $updatedAt
                );
    
                return $category;
            } else {
                return null; // Retourner null si la catégorie n'existe pas
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la catégorie : " . $e->getMessage();
            return null;
        }
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
    public function setId($id) {
        // Vérifier que l'ID est valide (exemple: entier positif)
        if (is_numeric($id) && $id > 0) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException("L'ID doit être un entier positif.");
        }
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
    

    public function setUpdatedAt($updatedAt) {
        if ($updatedAt instanceof DateTime) {
            $this->updatedAt = $updatedAt;
        } elseif (is_string($updatedAt) && !empty($updatedAt)) {
            $this->updatedAt = new DateTime($updatedAt);
        } else {
            $this->updatedAt = new DateTime(); // Définir à la date actuelle si NULL ou vide
        }
    }

    public function setCreatedAt($createdAt) {
        if ($createdAt instanceof DateTime) {
            $this->createdAt = $createdAt;
        } elseif (is_string($createdAt) && !empty($createdAt)) {
            $this->createdAt = new DateTime($createdAt);
        } else {
            $this->createdAt = new DateTime(); // Définir à la date actuelle si NULL ou vide
        }
    }

    public function findOneById(PDO $pdo, int $id) {
        try {
            // Préparer la requête SQL pour récupérer le produit par ID
            $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
            $stmt->execute(['id' => $id]);
    
            // Récupérer les données du produit
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($productData) {
                // Si le produit est trouvé, hydrater l'instance actuelle de Product
                $this->id = $productData['id'];
                $this->name = $productData['name'];
                $this->photos = json_decode($productData['photos'], true);
                $this->price = $productData['price'];
                $this->description = $productData['description'];
                $this->quantity = $productData['quantity'];
                $this->createdAt = isset($productData['created_at']) ? new DateTime($productData['created_at']) : new DateTime();
                $this->updatedAt = isset($productData['updated_at']) ? new DateTime($productData['updated_at']) : new DateTime();
                $this->category_id = $productData['category_id'];
    
                return $this; // Retourner l'instance actuelle hydratée
            } else {
                // Si aucun produit n'est trouvé, retourner false
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du produit : " . $e->getMessage();
            return false;
        }
    }

    public static function findAll(PDO $pdo): array {
        try {
            // Préparer la requête SQL pour récupérer tous les produits
            $stmt = $pdo->query("SELECT * FROM product");
    
            // Initialiser un tableau pour stocker les instances de Product
            $products = [];
    
            // Boucler à travers chaque ligne de résultat
            while ($productData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Créer une nouvelle instance de Product
                $product = new Product();
                
                // Hydrater l'instance avec les données récupérées
                $product->setId($productData['id']);
                $product->setName($productData['name']);
                $product->setPhotos(json_decode($productData['photos'], true));
                $product->setPrice($productData['price']);
                $product->setDescription($productData['description']);
                $product->setQuantity($productData['quantity']);
                $product->setCreatedAt($productData['created_at'] ?? null);
                $product->setUpdatedAt($productData['updated_at'] ?? null);
                $product->setCategoryId($productData['category_id']);
    
                // Ajouter l'instance de Product au tableau
                $products[] = $product;
            }
    
            return $products; // Retourner le tableau d'instances de Product
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des produits : " . $e->getMessage();
            return []; // Retourner un tableau vide en cas d'erreur
        }
    }

    public function create(PDO $pdo)
{
    try {
        // Préparer la requête d'insertion
        $stmt = $pdo->prepare("
            INSERT INTO product (name, photos, price, description, quantity, created_at, updated_at, category_id)
            VALUES (:name, :photos, :price, :description, :quantity, :created_at, :updated_at, :category_id)
        ");

        // Exécuter la requête en associant les valeurs des propriétés de l'objet
        $stmt->execute([
            ':name' => $this->name,
            ':photos' => json_encode($this->photos), // Convertir le tableau en JSON pour le stockage
            ':price' => $this->price,
            ':description' => $this->description,
            ':quantity' => $this->quantity,
            ':created_at' => $this->createdAt->format('Y-m-d H:i:s'), // Formater la date pour MySQL
            ':updated_at' => $this->updatedAt->format('Y-m-d H:i:s'), // Formater la date pour MySQL
            ':category_id' => $this->category_id
        ]);

        // Si l'insertion a réussi, récupérer l'ID nouvellement créé
        $this->id = $pdo->lastInsertId();

        return $this; // Retourner l'instance de Product avec l'ID mis à jour
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion du produit : " . $e->getMessage();
        return false; // Retourner false en cas d'échec
    }
}



    
}
?>