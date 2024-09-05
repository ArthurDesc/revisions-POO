<?php 

require_once 'Product.php';
require_once 'Category.php'; 

require_once 'db.php';

$product = new Product();
$product->setName("Crazy stuff ");
$product->setPhotos(['photo1.jpg', 'photo2.jpg']);
$product->setPrice(1200);
$product->setDescription("T-shirt vraiment incroyable");
$product->setQuantity(10);
$product->setCreatedAt(new DateTime());
$product->setUpdatedAt(new DateTime());
$product->setCategoryId(3);

// Insérer le produit dans la base de données
if ($product->create($pdo)) {
    echo "Produit créé avec succès avec l'ID : " . $product->getId();
} else {
    echo "Échec de la création du produit.";
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