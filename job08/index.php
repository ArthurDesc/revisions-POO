<?php 

require_once 'Product.php';
require_once 'Category.php'; 

require_once 'db.php';

// Définir la fonction ici avant de l'appeler// Appeler la méthode findAll pour récupérer tous les produits
$allProducts = Product::findAll($pdo);

// Afficher tous les produits récupérés
foreach ($allProducts as $product) {
    echo "Produit : " . $product->getName() . " - Prix : " . $product->getPrice() . "<br>";
}

// Créer une nouvelle instance de Product
$product = new Product();

// Appeler la méthode pour trouver un produit par ID
$result = $product->findOneById($pdo, 7); // Par exemple, on cherche le produit avec l'ID 7
if ($result) {
    // Si un produit est trouvé, afficher ses informations
    echo "Produit trouvé : " . $product->getName();
} else {
    // Sinon, indiquer que le produit n'existe pas
    echo "Aucun produit trouvé avec cet ID.";
}


$result = $product->findOneById($pdo, 7); // Par exemple, on cherche le produit avec l'ID 7

    
    
    
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