<?php
$suppress_db_message = true; // Ne pas afficher le message de connexion
include 'dbcon.php';

$sql = "SELECT * FROM client";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['Nom']}</td>
                <td>{$row['mail']}</td>
                <td>{$row['telephone']}</td>
                <td>{$row['adresse']}</td>
                <td>
                    <button class='edit-btn' onclick='editCustomer({$row['ID']})'>Modifier</button>
                    <a href='supprimer_customer.php?id={$row['ID']}' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');\">
                    <button class='delete-btn'>Supprimer</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucun client trouvé</td></tr>";
}

$conn->close();
?>
