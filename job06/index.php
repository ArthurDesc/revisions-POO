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




    $category = new Category(1, 'Électronique', 'Produits électroniques et gadgets', new datetime(), new datetime()); // Exemple de catégorie
    $products = $category->getProducts($pdo); // Récupérer tous les produits de cette catégorie
    
    foreach ($products as $product) {
        echo "Produit: " . $product->getName() . "<br>";
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