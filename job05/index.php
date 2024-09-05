<?php 

require_once 'Product.php';
require_once 'Category.php'; 

require_once 'db.php';

// Définir la fonction ici avant de l'appeler
function getProductById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$productData = getProductById($pdo, 7);


// Vérifier si le produit existe
if ($productData) {
    // Créer une nouvelle instance de Product
    $product = new Product();

    // Hydrater l'instance avec les données récupérées
    $product->setId($productData['id']);
    $product->setName($productData['name']);
    $product->setPhotos(json_decode($productData['photos'], true));
    $product->setPrice($productData['price']);
    $product->setDescription($productData['description']);
    $product->setQuantity($productData['quantity']);
    $product->setCreatedAt(new DateTime($productData['createdAt']));
    $product->setUpdatedAt(new DateTime($productData['updatedAt']));
    $product->setCategoryId($productData['category_id']);

    $category = $product->getCategory($pdo);

        // Afficher les données du produit pour vérification
        echo "Produit récupéré et hydraté :<br>";
        echo "ID: " . $product->getId() . "<br>";
        echo "Nom: " . $product->getName() . "<br>";
        echo "Prix: " . $product->getPrice() . "<br>";
        echo "Description: " . $product->getDescription() . "<br>";
        echo "Quantité: " . $product->getQuantity() . "<br>";
        echo "Catégorie ID: " . $product->getCategoryId() . "<br>";

        if ($category) {
            echo "Catégorie associée :<br>";
            echo "ID: " . $category->getId() . "<br>";
            echo "Nom: " . $category->getName() . "<br>";
        } else {
            echo "Aucune catégorie associée.";
        }
    } else {
        echo "Aucun produit trouvé avec l'ID 7.";
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Utilisation des getters pour afficher les propriétés initiales

?>
    
</body>
</html>