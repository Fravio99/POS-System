<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $designation = $_POST['designation'];
    $categorie = $_POST['categorie'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO produits (image, code, designation, categorie, prix, stock) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssdi", $image, $code, $designation, $categorie, $prix, $stock);
        $stmt->execute();
        header("Location: product.php");
        exit();
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>
