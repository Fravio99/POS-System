<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadaPOS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/customer.css">
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
                <li><a href="rapport.php"><i class="fas fa-file-alt"></i> Rapport de vente</a></li>
                <li class="active"><a href="customer.php"><i class="fas fa-users"></i> Clients</a></li>
            </ul>
            <ul class="bottom-menu">
                <li><a href="setting.php"><i class="fas fa-cog"></i> Paramètre</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Se Déconnecter</a></li>
            </ul>
    </aside>

    <div class="content">
        <div class="product-section">
            <div class="product-header">
                <button class="add-product-btn" onclick="openPopup()">+ Add Customer</button>
            </div>
                
            <!-- Tableau des clients -->
            <table class="product-table" id="customerTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Télephone</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Lignes du tableau insérées ici dynamiquement -->
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Popup pour ajouter un client -->
    <div class="popup-overlay" id="popupOverlay" onclick="closePopup(event)">
        <div class="popup-content" onclick="event.stopPropagation()">
            <span class="close-btn" onclick="closePopup(event)">&#10005;</span>
            <h2>Ajouter Client</h2>
            
            <form class="add-product-form" id="addCustomerForm">
                <label for="nom">Nom</label>
                <input type="text" id="nom" placeholder="Nom du Client" required>

                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Mail du Client" required>

                <label for="telephone">Télephone</label>
                <input type="text" id="telephone" placeholder="Numéro de Téléphone" required>

                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" placeholder="Adresse du Client" required>

                <button type="submit" class="submit-btn">AJOUTER</button>
            </form>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById("popupOverlay").style.display = "flex";
        }

        function closePopup(event) {
            document.getElementById("popupOverlay").style.display = "none";
        }

        // Gestion de l'envoi du formulaire via AJAX
        document.getElementById("addCustomerForm").addEventListener("submit", function(event) {
            event.preventDefault();
            
            let nom = document.getElementById("nom").value;
            let email = document.getElementById("email").value;
            let telephone = document.getElementById("telephone").value;
            let adresse = document.getElementById("adresse").value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "add_customer.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    closePopup();
                    document.getElementById("addCustomerForm").reset();
                    fetchCustomers(); // Met à jour la liste des clients
                } else {
                    alert("Erreur lors de l'ajout du client.");
                }
            };

            xhr.send("nom=" + nom + "&email=" + email + "&telephone=" + telephone + "&adresse=" + adresse);
        });

        // Fonction pour récupérer la liste des clients
        function fetchCustomers() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "get_customers.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector("#customerTable tbody").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Charger les clients au chargement de la page
        window.onload = fetchCustomers;
    </script>
</body>
</html>
