<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadaPOS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/paiement.css">
</head>
<body>
    <div class="content">
        <div class="payment-page">
            <div class="payment-header">
                <h2>Paiement</h2>
                <button class="cancel-button" onclick="window.history.back()">Annuler</button>
            </div>

            <?php
            // Connexion à la base de données
            $suppress_db_message = true;
            include 'dbcon.php';

            // Récupérer les noms de clients depuis la base de données
            $sql = "SELECT id, Nom FROM client";
            $result = $conn->query($sql);
            ?>

            <!-- Formulaire de paiement -->
            <form action="valider_paiement.php" method="post">
                <div class="form-group">
                    <label for="client-select">Client :</label>
                    <select id="client-select" name="client_id" required>
                        <option value="">Choisir le Client</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['Nom']) . '</option>';
                            }
                        } else {
                            echo '<option value="">Aucun client disponible</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Section Résumé -->
                <div class="summary-box">
                    <h3>Résumé</h3>
                    <div id="cart-summary-items">
                        <!-- Les éléments du panier ajoutés ici via JavaScript -->
                    </div>
                    <div class="summary-item total">
                        <span>Prix Total :</span>
                        <span id="total-price">0 Ar</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="payment-method">Mode de Payement :</label>
                    <select id="payment-method" name="payment_method" onchange="toggleCardForm()" required>
                        <option value="cash">En espèce</option>
                        <option value="card">Carte</option>
                    </select>
                </div>

                <!-- Formulaire pour informations de carte bancaire -->
                <div class="card-info-form" id="card-info-form" style="display: none;">
                    <label for="card-number">Numéro de Carte</label>
                    <input type="text" id="card-number" name="card_number" placeholder="Numéro de carte bancaire">
                    
                    <label for="expiry-date">Date d'expiration</label>
                    <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/AA">
                    
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="Code de sécurité">
                </div>

                <button type="submit" class="validate-button">Valider</button>
            </form>
        </div>
    </div>

    <script>
        // Fonction pour basculer l'affichage du formulaire de carte bancaire
        function toggleCardForm() {
            const paymentMethod = document.getElementById("payment-method").value;
            const cardInfoForm = document.getElementById("card-info-form");
            if (paymentMethod === "card") {
                cardInfoForm.style.display = "block";
            } else {
                cardInfoForm.style.display = "none";
            }
        }

        // Récupération des clients depuis la base de données
        document.addEventListener('DOMContentLoaded', () => {
            // Charger les noms des clients dans le menu déroulant
            fetch('get_clients.php')
                .then(response => response.json())
                .then(data => {
                    const clientSelect = document.getElementById("client-select");
                    data.forEach(client => {
                        const option = document.createElement("option");
                        option.value = client.id;
                        option.textContent = client.nom;
                        clientSelect.appendChild(option);
                    });
                });

            // Récupération des données du panier depuis le localStorage
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const totalAmount = localStorage.getItem('totalAmount') || 0;

            const cartSummaryItems = document.getElementById('cart-summary-items');
            const totalPriceElement = document.getElementById('total-price');

            // Affichage des articles du panier
            cartItems.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.classList.add('summary-item');
                itemElement.innerHTML = `
                    <span>${item.name}</span>
                    <span>${item.price} Ar</span>
                `;
                cartSummaryItems.appendChild(itemElement);
            });

            // Mise à jour du total
            totalPriceElement.textContent = `${totalAmount} Ar`;
        });
    </script>
</body>
</html>
