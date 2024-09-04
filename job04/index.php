<?php 

require_once 'Product2.php';
require_once 'Category.php'; 

try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

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

        // Afficher les données du produit pour vérification
        echo "Produit récupéré et hydraté :<br>";
        echo "ID: " . $product->getId() . "<br>";
        echo "Nom: " . $product->getName() . "<br>";
        echo "Prix: " . $product->getPrice() . "<br>";
        echo "Description: " . $product->getDescription() . "<br>";
        echo "Quantité: " . $product->getQuantity() . "<br>";
        echo "Catégorie ID: " . $product->getCategoryId() . "<br>";
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
if (isset($product)) {
echo "Propriétés initiales du produit:\n";
var_dump($product->getCategoryId());
var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getPhotos());
var_dump($product->getPrice());
var_dump($product->getDescription());
var_dump($product->getQuantity());
var_dump($product->getCreatedAt());
var_dump($product->getUpdatedAt());

// Modification de certaines propriétés avec les setters
$product->setName('Awesome T-shirt');
$product->setPrice(1200);
$product->setQuantity(15);

// Affichage des propriétés modifiées
echo "\nPropriétés après modifications:\n";
var_dump($product->getName());
var_dump($product->getPrice());
var_dump($product->getQuantity());

// Vérification que updatedAt a été modifié
echo "\nDate de mise à jour après modifications:\n";
var_dump($product->getUpdatedAt());
}
?>
    
</body>
</html>