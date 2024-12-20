<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadaPOS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/product.css">
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
                <li  class="active"><a href="product.php"><i class="fas fa-chart-bar"></i> Produits</a></li>
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
                            <th>Image</th>
                            <th>Code</th>
                            <th>Désignation</th>
                            <th>Fournisseur</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $suppress_db_message = true; // Ne pas afficher le message de connexion
                    include 'dbcon.php';
                    $result = $conn->query("SELECT * FROM produits");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['ID']}</td>
                                <td><img src='uploads/{$row['image']}' alt='Product Image' width='50'></td>
                                <td>{$row['code']}</td>
                                <td>{$row['designation']}</td>
                                <td>{$row['categorie']}</td>
                                <td>{$row['prix']}</td>
                                <td>{$row['stock']}</td>
                                <td>
                                    <button class='edit-btn' id='openModifyPopup' onclick='openEditPopup({$row['ID']})'>Modifier</button>
                                    <a href='supprimer_produit.php?id={$row['ID']}' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');\">
                                    <button class='delete-btn'>Supprimer</button>
                                </a>
                                </a>
                                </td>
                              </tr>";
                    }
                    ?>
                        <!-- Ajouter d'autres lignes de produit ici -->
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
    
    <!-- Popup pour ajouter un produit -->
<div class="popup-overlay" id="popupOverlay" onclick="closePopup(event)">
    <div class="popup-content" onclick="event.stopPropagation()">
        <span class="close-btn" onclick="closePopup(event)">&#10005;</span>
        <h2>Ajouter Produits</h2>
        
        <form class="add-product-form" action="ajouter_produit.php" method="post" enctype="multipart/form-data">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" placeholder="Ex : PDT001" required>

            <label for="designation">Designation</label>
            <input type="text" id="designation" name="designation" placeholder="Ex : CocaCola" required>

            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie" required>
                <option>Boisson</option>
                <option>Snack</option>
                <!-- Ajouter d'autres options ici -->
            </select>

            <label for="prix">Prix</label>
            <input type="text" id="prix" name="prix" placeholder="Ex : 7000">

            <label for="stock">Stock</label>
            <input type="text" id="stock" name="stock" placeholder="Ex : 50">

            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="image-select" required>

            <button type="submit" class="submit-btn">AJOUTER</button>
        </form>
      
    </div>
</div>


<!-- Popup de modification du produit -->
<div id="modifyPopup" class="popup2">
    <div class="popup2-content">
        <span class="close2">&times;</span>
        <h2>Modifier Produit</h2>
        <form action="modifier_produit_process.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $produit['ID']; ?>">

            <label for="code">Code</label>
            <input type="text" name="code" value="<?php echo $produit['code']; ?>" required>
            
            <label for="designation">Désignation</label>
            <input type="text" name="designation" value="<?php echo $produit['designation']; ?>" required>
            
            <label for="categorie">Catégorie</label>
            <select id="categorie2" name="categorie">
                <option <?php echo ($produit['categorie'] == 'Boisson') ? 'selected' : ''; ?>>Boisson</option>
                <option <?php echo ($produit['categorie'] == 'Snack') ? 'selected' : ''; ?>>Snack</option>
            </select>
            
            <label for="prix">Prix</label>
            <input type="text" name="prix" value="<?php echo $produit['prix']; ?>" required>
            
            <label for="stock">Stock</label>
            <input type="text" name="stock" value="<?php echo $produit['stock']; ?>" required>
            
            <label for="image">Image</label>
            <input type="file" id="image2" name="image">
            
            <button type="submit" class="btn-modify">MODIFIER</button>
        </form>

    </div>
</div>




<script>
    // Fonction pour ouvrir le popup
function openPopup() {
    document.getElementById("popupOverlay").style.display = "flex";
}

// Fonction pour fermer le popup
function closePopup(event) {
    document.getElementById("popupOverlay").style.display = "none";
}

// Sélectionner les éléments de la popup de modification
const modifyPopup = document.getElementById("modifyPopup");
const openModifyPopupBtn = document.getElementById("openModifyPopup");
const closeModifyPopupBtn = document.querySelector(".close2");

// Ouvrir le popup de modification
openModifyPopupBtn.onclick = function () {
    modifyPopup.style.display = "block";
};

// Fermer le popup de modification
closeModifyPopupBtn.onclick = function () {
    modifyPopup.style.display = "none";
};

// Fermer le popup de modification en cliquant en dehors du popup
window.onclick = function (event) {
    if (event.target == modifyPopup) {
        modifyPopup.style.display = "none";
    }
};



</script>
</body>
</html>
