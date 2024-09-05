<?php 

require 'autoload.php';

$clothing = new Clothing(1, 'T-Shirt', ['photo1.jpg'], 25, 'Un T-shirt confortable', 100, null, null, 2, 'M', 'Blue', 'Casual', 5);
echo $clothing->getName(); // Produit: T-Shirt
echo $clothing->getSize(); // Taille: M

$electronic = new Electronic(2, 'Smartphone', ['phone.jpg'], 500, 'Un smartphone moderne', 50, null, null, 3, 'Apple', 50);
echo $electronic->getName(); // Produit: Smartphone
echo $electronic->getBrand(); // Marque: Apple




    
    
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