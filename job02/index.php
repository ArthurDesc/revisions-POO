<?php 
require_once 'Product.php';

$product = new Product(
    1,                                      // id
    'T-shirt',                              // name
    ['https://picsum.photos/200/300'],      // photos
    1000,                                   // price
    'A beautiful T-shirt',                  // description
    10,                                     // quantity
    new DateTime(),                         // createdAt
    new DateTime(),                         // updatedAt
    2                                       // category_id
);
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
?>
    
</body>
</html>