<?php
include 'dbcon.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $designation = $_POST['designation'];
    $categorie = $_POST['categorie'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // Vérifier si une nouvelle image est téléchargée
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        // Déplacer l'image vers le dossier cible
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Mise à jour de toutes les informations y compris l'image
            $query = "UPDATE produits SET image = ?, code = ?, designation = ?, categorie = ?, prix = ?, stock = ? WHERE ID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssdii", $image, $code, $designation, $categorie, $prix, $stock, $id);
        } else {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    } else {
        // Mise à jour des informations sans modifier l'image
        $query = "UPDATE produits SET code = ?, designation = ?, categorie = ?, prix = ?, stock = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssdi", $code, $designation, $categorie, $prix, $stock, $id);
    }

    // Exécuter la requête de mise à jour
    if ($stmt->execute()) {
        echo "Produit mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du produit.";
    }

    $stmt->close();
}

// Rediriger vers la page d'affichage des produits
header("Location: afficher_produits.php");
exit();
?>
