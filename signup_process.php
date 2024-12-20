<?php
// Inclure le fichier de connexion
require_once 'dbcon.php';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $nom = trim($_POST['nom']);
    $number = trim($_POST['number']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $conf_password = trim($_POST['conf_password']);

    // Variables pour stocker les erreurs
    $errors = [];

    // Validation du nom (ne doit pas être vide)
    if (empty($nom)) {
        $errors[] = "Le nom est requis.";
    }

    // Validation du numéro (doit être un nombre)
    if (empty($number) || !preg_match('/^\d+$/', $number)) {
        $errors[] = "Le numéro doit contenir uniquement des chiffres.";
    }

    // Validation de l'email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Un email valide est requis.";
    }

    // Validation du mot de passe
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    } elseif ($password !== $conf_password) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // Si aucune erreur, insertion dans la base de données
    if (empty($errors)) {
        // Hachage du mot de passe pour la sécurité
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête SQL pour éviter les injections SQL
        $sql = "INSERT INTO user (username, number, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nom, $number, $email, $hashed_password);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Inscription réussie !";
            // Redirection vers la page de connexion après succès
            header("Location: login.php");
            exit;
        } else {
            echo "Erreur : " . $stmt->error;
        }
    } else {
        // Affichage des erreurs
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>
