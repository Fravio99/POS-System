<?php
$suppress_db_message = true;
include 'dbcon.php';

$client_id = $_GET['client_id'];
$payment_date = $_GET['payment_date'];

// Récupérer les informations du client
$sql_client = "SELECT Nom FROM client WHERE id = ?";
$stmt_client = $conn->prepare($sql_client);
$stmt_client->bind_param("i", $client_id);
$stmt_client->execute();
$result_client = $stmt_client->get_result();
$client = $result_client->fetch_assoc();

// Exemple d'articles dans le panier (à ajuster en fonction de votre panier réel)
$cart_items = [
    ["name" => "Produit A", "price" => 5000],
    ["name" => "Produit B", "price" => 3000],
];
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Paiement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 24px;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .receipt-details {
            margin-bottom: 20px;
        }

        .receipt-details p {
            font-size: 16px;
            line-height: 1.5;
            margin: 5px 0;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .summary-table th, .summary-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .summary-table th {
            background-color: #f2f2f2;
        }

        .summary-table td {
            text-align: center;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .print-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }

        .print-button i {
            margin-right: 5px;
        }

        /* Styling pour un bouton avec une icône */
        .print-button:hover {
            background-color: #45a049;
        }

        /* Nouveau bouton pour revenir à la page POS */
        .back-button {
            position: absolute;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h1>MadaPOS - Reçu de Paiement</h1>

    <div class="receipt-details">
        <p><strong>Client :</strong> <?php echo htmlspecialchars($client['Nom']); ?></p>
        <p><strong>Date de Paiement :</strong> <?php echo $payment_date; ?></p>
    </div>

    <h3>Résumé du Panier</h3>
    <table class="summary-table">
        <tr>
            <th>Produit</th>
            <th>Prix Unitaire</th>
        </tr>
        <?php foreach ($cart_items as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars($item['price']); ?> Ar</td>
            </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td><strong>Total</strong></td>
            <td><?php echo $total; ?> Ar</td>
        </tr>
    </table>

    <p><strong>Statut de Paiement :</strong> Payé</p>

    <button class="print-button" onclick="window.print()"><i class="fas fa-print"></i> Imprimer</button>

    <!-- Bouton pour retourner vers POS -->
    <a href="pos.php" class="back-button">Retour vers le POS</a>
</div>

</body>
</html>
