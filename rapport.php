<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadaPOS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/rapport.css">
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="img/Logo.png" alt="MadaPOS Logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Type to search">
        </div>
        <div class="icons">
            <div class="notification">
                <i class="fas fa-bell"></i>
                <span class="badge">2</span>
            </div>
            <div class="profile">
                <img src="img/profil.jpg" alt="User Profile">
            </div>
        </div>
    </nav>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="product.php"><i class="fas fa-chart-bar"></i> Produits</a></li>
            <li><a href="pos.php"><i class="fas fa-cash-register"></i> Point de vente</a></li>
            <li class="active"><a href="rapport.php"><i class="fas fa-file-alt"></i> Rapport de vente</a></li>
            <li><a href="customer.php"><i class="fas fa-users"></i> Clients</a></li>
        </ul>
        <ul class="bottom-menu">
            <li><a href="setting.php"><i class="fas fa-cog"></i> Paramètre</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Se Déconnecter</a></li>
        </ul>
    </aside>

    <?php
     $suppress_db_message = true; // Ne pas afficher le message de connexion
include 'dbcon.php';

// Récupérer les données des paiements
$sql_paiement = "SELECT p.id, p.client_id, p.payment_method, p.date_paiement, c.Nom AS client_name
                 FROM paiement p
                 JOIN client c ON p.client_id = c.id
                 ORDER BY p.date_paiement DESC";  // Trier par date de paiement, plus récent en premier

$result_paiement = $conn->query($sql_paiement);
?>

<div class="content">
    <div class="product-section">
        <!-- Bouton Ajouter un Produit -->
        <div class="product-header">
            <button class="add-product-btn" onclick="openPopup()">+ Ajouter un Produit</button>
            <div class="date-selection">
                <button class="select-date">Select Date</button>
                <button class="see-all">See All</button>
            </div>
        </div>
        
        <!-- Tableau des produits -->
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID_Client</th>
                    <th>Methode de Payement</th>
                    <th>Date de payement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_paiement->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['client_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['date_paiement'])); ?></td>
                        <td>Payé</td>
                        <td>
                            <!-- Bouton Supprimer (fonctionnalité à implémenter) -->
                            <button class="delete-btn" onclick="deletePayment(<?php echo $row['id']; ?>)">Supprimer</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    
        <!-- Pagination -->
        <div class="pagination">
            <span>1-5 sur 100</span>
            <div class="page-numbers">
                <button class="page-btn">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">></button>
            </div>
        </div>
    </div>
</div>

<script>
// Fonction pour supprimer un paiement
function deletePayment(paymentId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce paiement ?")) {
        window.location.href = 'supprimer_paiement.php?id=' + paymentId;
    }
}
</script>


    
</body>
</html>
