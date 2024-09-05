<?php 

require_once 'Product.php';
require_once 'Category.php'; 
require_once 'db.php';

$product = Product::findOneById(7);

if ($product !== false) {
    // Modifier les propriétés du produit
    $product->setName('New Product Name');
    $product->setPrice(999);
    $product->setQuantity(50);
    // Mettre à jour les autres propriétés si nécessaire

    // Appeler la méthode update pour enregistrer les modifications
    if ($product->update()) {
        echo "Le produit a été mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du produit.";
    }
} else {
    echo "Produit non trouvé.";
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