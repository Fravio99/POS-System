<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadaPOS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
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
    <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <ul>
                <li class="active"><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="product.php"><i class="fas fa-chart-bar"></i> Produits</a></li>
                <li><a href="pos.php"><i class="fas fa-cash-register"></i> Point de vente</a></li>
                <li><a href="rapport.php"><i class="fas fa-file-alt"></i> Rapport de vente</a></li>
                <li><a href="customer.php"><i class="fas fa-users"></i> Clients</a></li>
            </ul>
            <ul class="bottom-menu">
                <li><a href="setting.php"><i class="fas fa-cog"></i> Paramètre</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Se Déconnecter</a></li>
            </ul>
        </aside>


    <div class="content">
      
        <div class="dashboard">
            <p class="greeting">Salut Fraviogarry - <span class="description">voici ce qui se passe dans votre magasin aujourd'hui</span></p>
            <div class="dashboard-cards">
                <div class="card">
                    <p class="card-title">VENTE DU JOUR</p>
                    <p class="card-value">10 000 Ar</p>
                    <p class="card-change positive">+ 36% &#8593;</p>
                </div>
                <div class="card">
                    <p class="card-title">VENTE TOTALE</p>
                    <p class="card-value">10 000 Ar</p>
                    <p class="card-change negative">+ 14% &#8595;</p>
                </div>
                <div class="card">
                    <p class="card-title">COMMANDES TOTALE</p>
                    <p class="card-value">15</p>
                    <p class="card-change positive">+ 36% &#8593;</p>
                </div>
                <div class="card">
                    <p class="card-title">CLIENTS TOTAUX</p>
                    <p class="card-value">12</p>
                    <p class="card-change positive">+ 36% &#8593;</p>
                </div>
            </div>
        </div>
        
        <div class="charts">
            <div class="chart-left">
                <canvas id="chartLeft"></canvas>
            </div>
            <div class="chart-right">
                <canvas id="chartRight"></canvas>
            </div>
        </div>

  </div>

  <?php
  $suppress_db_message = true;
include 'dbcon.php';

try {
    // Récupérer les paiements groupés par date
    $sql = "SELECT DATE(date_paiement) AS date, COUNT(*) AS total_paiements
            FROM paiement
            GROUP BY DATE(date_paiement)";
    $result = $conn->query($sql);

    $dates = [];
    $totals = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dates[] = $row['date'];
            $totals[] = $row['total_paiements'];
        }
    }
} catch (mysqli_sql_exception $e) {
    die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
}

// Préparer les données pour le graphique
$data = [
    'dates' => $dates,
    'totals' => $totals
];

// Convertir en JSON pour l'utiliser dans le JavaScript
echo "<script>const chartData = " . json_encode($data) . ";</script>";
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctxLeft = document.getElementById('chartLeft').getContext('2d');

    // Extraire les données passées depuis PHP
    const labels = chartData.dates || [];
    const data = chartData.totals || [];

    // Graphique à gauche (paiements par date)
    new Chart(ctxLeft, {
        type: 'bar',
        data: {
            labels: labels, // Les dates des paiements
            datasets: [{
                label: 'Nombre de paiements',
                data: data, // Totaux des paiements par date
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

// Graphique à droite
new Chart(ctxRight, {
        type: 'line',
        data: {
            labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'],
            datasets: [{
                label: 'Commandes',
                data: [10, 15, 8, 12],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
        }
    });

</script>


</body>
</html>
