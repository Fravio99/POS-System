<?php
$suppress_db_message = true; // Ne pas afficher le message de connexion
include 'dbcon.php';

if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['adresse'])) {
    $nom = $conn->real_escape_string($_POST['nom']);
    $email = $conn->real_escape_string($_POST['email']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $adresse = $conn->real_escape_string($_POST['adresse']);

    $sql = "INSERT INTO client (Nom, mail, telephone, adresse) VALUES ('$nom', '$email', '$telephone', '$adresse')";

    if ($conn->query($sql) === TRUE) {
        echo "Client ajouté avec succès";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$conn->close();
?>
