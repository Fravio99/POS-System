<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadaPOS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/pos.css">
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
                <li class="active"><a href="pos.php"><i class="fas fa-cash-register"></i> Point de vente</a></li>
                <li><a href="rapport.php"><i class="fas fa-file-alt"></i> Rapport de vente</a></li>
                <li><a href="customer.php"><i class="fas fa-users"></i> Clients</a></li>
            </ul>
            <ul class="bottom-menu">
                <li><a href="#"><i class="fas fa-cog"></i> Paramètre</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Se Déconnecter</a></li>
            </ul>
    </aside>

    <div class="content">
    <!-- Product List Section -->
    <div class="product-list">
        <?php
        echo "<button class='add-product-btn'>+ Ajouter un produit</button>";
        echo "<p><br><br></p>";
        echo "<h2>Menu</h2>";

        // Section du menu des catégories
        echo "<div class='category-menu'>";
        echo "<button class='active'>Tout</button>";

        $suppress_db_message = true; // Ne pas afficher le message de connexion
        include 'dbcon.php';

        // Récupérer les catégories distinctes de la table produits
        $resultCategories = $conn->query("SELECT DISTINCT categorie FROM produits");

        // Afficher chaque catégorie en tant que bouton
        while ($category = $resultCategories->fetch_assoc()) {
            echo "<button>{$category['categorie']}</button>";
        }

        echo "</div>";

        // Section de la liste des produits
        echo "<div class='products' id='product-list'>";
        // Récupérer tous les produits de la table produits
        $resultProducts = $conn->query("SELECT * FROM produits");

        // Afficher chaque produit sous forme de carte
        while ($product = $resultProducts->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<img src='uploads/{$product['image']}' alt='{$product['designation']}'>";
            echo "<h3 class='product-name'>{$product['designation']}</h3>";
            echo "<p>{$product['categorie']}</p>";
            echo "<p class='price' data-price='{$product['prix']}'>{$product['prix']} Ar</p>";
            echo "<button class='add-product-btn'><i class='fas fa-shopping-cart'></i> Add</button>";
            echo "</div>";
        }
        echo "</div>";
        ?>
    </div>

    <!-- Cart Summary Section -->
    <div class="cart-summary" id="cart-summary">
        <h2>Panier</h2>
        <div class="cart-items" id="cart-items">
            <!-- Les éléments du panier ajoutés via JavaScript apparaîtront ici -->
        </div>
        <div class="summary">
            <p>Articles: <span id="total-items">0</span></p>
            <p>PrixTotal: <span id="total-price">0</span> Ar</p>
        </div>
        <button class="checkout-btn">Passer au paiement</button>
    </div>
</div>

<script>
// Fonction pour ajouter un produit au panier
document.addEventListener('DOMContentLoaded', () => {
    const addButtons = document.querySelectorAll('.add-product-btn');
    const cartItems = document.getElementById('cart-items');
    const totalItems = document.getElementById('total-items');
    const totalPrice = document.getElementById('total-price');
    let itemCount = 0;
    let totalAmount = 0;

    addButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const productCard = event.target.closest('.product-card');
            const productName = productCard.querySelector('.product-name').textContent;
            const productPrice = parseInt(productCard.querySelector('.price').getAttribute('data-price'));

            // Création d'un nouvel élément du panier
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <p>${productName}</p>
                <p class="price">${productPrice} Ar</p>
                <button class="delete-button">X</button>
            `;

            // Ajout de l'élément au panier
            cartItems.appendChild(cartItem);

            // Mise à jour du total des articles et du prix
            itemCount++;
            totalAmount += productPrice;
            totalItems.textContent = itemCount;
            totalPrice.textContent = totalAmount;

            // Suppression d'un produit du panier
            cartItem.querySelector('.delete-button').addEventListener('click', () => {
                cartItems.removeChild(cartItem);
                itemCount--;
                totalAmount -= productPrice;
                totalItems.textContent = itemCount;
                totalPrice.textContent = totalAmount;
            });
        });
    });
});

// Ajoutez ce script dans la page du panier
document.querySelector('.checkout-btn').addEventListener('click', () => {
    const cartItems = document.querySelectorAll('#cart-items .cart-item');
    const items = [];
    let totalAmount = 0;

    cartItems.forEach(item => {
        const name = item.querySelector('p').textContent;
        const price = parseInt(item.querySelector('.price').textContent);
        items.push({ name, price });
        totalAmount += price;
    });

    // Stockez les informations dans localStorage
    localStorage.setItem('cartItems', JSON.stringify(items));
    localStorage.setItem('totalAmount', totalAmount);

    // Redirection vers la page de paiement
    window.location.href = 'paiement.php';
});
</script>


</body>
</html>
