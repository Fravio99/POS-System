<?php
// Paramètres de connexion
$servername = "localhost";  
$username = "root";  
$password = "";
$database = "madapos";  

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
// Afficher le message de connexion réussie uniquement si la variable n'est pas définie ou est fausse
if (!isset($suppress_db_message) || !$suppress_db_message) {
    echo "Connexion réussie à la base de données";
}
?>
