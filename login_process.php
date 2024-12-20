<?php
// Inclure le fichier de connexion à la base de données
include 'dbcon.php';

$errorMessage = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données envoyées par le formulaire
    $name = trim($_POST["name"]);
    $password = trim($_POST["password"]);

    // Valider les champs du formulaire
    if (empty($name) || empty($password)) {
        $errorMessage = "Veuillez remplir tous les champs.";
    } else {
        // Préparer la requête pour récupérer l'utilisateur
        $query = "SELECT * FROM user WHERE email = ? OR username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $name, $name); // Rechercher par email ou nom d'utilisateur
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifier si un utilisateur a été trouvé
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Connexion réussie, rediriger vers la page d'accueil
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                exit;
            } else {
                $errorMessage = "Mot de passe incorrect.";
            }
        } else {
            $errorMessage = "Utilisateur non trouvé.";
        }
    }
}
?>