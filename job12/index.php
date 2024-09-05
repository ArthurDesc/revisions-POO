<?php
require 'autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');

// Teste la création d'un vêtement
$newClothing = new Clothing(
    0, // ID est nul pour une nouvelle entrée
    'T-shirt', 
    ['photo1.jpg'], 
    20, 
    'Un t-shirt confortable', 
    100, 
    new DateTime(), 
    new DateTime(), 
    1, // ID de catégorie
    'M', 
    'Rouge', 
    'Casual', 
    5
);
if ($newClothing->create($pdo)) {
    echo "Vêtement créé avec succès avec ID : " . $newClothing->getId() . "\n";
} else {
    echo "Échec de la création du vêtement.\n";
}

// Teste la création d'un produit électronique
$newElectronic = new Electronic(
    0, 
    'Smartphone', 
    ['photo2.jpg'], 
    300, 
    'Un smartphone dernier cri', 
    50, 
    new DateTime(), 
    new DateTime(), 
    2, // ID de catégorie
    'MarqueX', 
    2
);
if ($newElectronic->create($pdo)) {
    echo "Produit électronique créé avec succès avec ID : " . $newElectronic->getId() . "\n";
} else {
    echo "Échec de la création du produit électronique.\n";
}
?>
