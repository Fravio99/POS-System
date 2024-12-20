<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadaPOS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Basic reset and body styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
        }

        /* Top navbar styling */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1;
        }
        .navbar .logo {
            display: flex;
            align-items: center;
        }
        .navbar .logo img {
            width: 90px;
            margin-right: 10px;
        }
        
        .navbar .search-bar {
            display: flex;
            align-items: center;
            flex: 1;
            max-width: 400px;
            margin: 0 20px;
        }
        .navbar .search-bar input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
        }
        .navbar .icons {
            display: flex;
            align-items: center;
        }
        .navbar .icons .notification {
            position: relative;
            margin-right: 20px;
            font-size: 18px;
            color: #555;
            cursor: pointer;
        }
        .navbar .icons .notification .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: #5B47FF;
            color: #fff;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
        }
        .navbar .icons .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding-top: 80px; /* Adjust padding to align below top navbar */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-left: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            display: flex;
            align-items: center;
            padding: 15px 10px;
            font-size: 16px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 8px;
            margin-bottom: 5px;
        }
        .sidebar ul li:hover, .sidebar ul li.active {
            background-color: #4b3fcd;
            color: #fff;
        }
        .sidebar ul li i {
            margin-right: 15px;
        }
        .sidebar ul li .badge {
            margin-left: auto;
            background-color: #d6f5d6;
            color: #28a745;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 12px;
        }
        .sidebar ul li a {
    text-decoration: none; /* Remove underline from links */
    color: inherit; /* Inherit color from parent li */
    font-size: inherit;
    display: flex;
    align-items: center;
}

        /* Bottom section of sidebar */
        .sidebar .bottom-menu {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }
        .sidebar .bottom-menu li {
            display: flex;
            align-items: center;
            padding: 15px 10px;
            font-size: 16px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 8px;
            margin-bottom: 5px;
        }
        .sidebar .bottom-menu li:hover {
            background-color: #e9e9e9;
        }
        .sidebar .bottom-menu li i {
            margin-right: 15px;
        }

        

        
        /* Content area styling */
.content {
    margin-left: 250px;
    margin-top: 60px;
    padding: 20px;
    width: calc(100% - 250px);
    display: flex;
    flex-direction: column; /* Aligner le contenu en colonne */
}

/* Settings page layout */
.settings-page {
    width: 100%;
    /* max-width: 800px; */
    /* margin: 0 auto; */
    display: flex;
    gap: 20px;
    padding: 20px;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
}

.profile-section, .personal-info-section {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

.profile-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.profile-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.profile-name {
    font-size: 1.5em;
    margin: 10px 0;
    color: #333;
}

.profile-email {
    color: #777;
    margin-bottom: 20px;
    font-size: 0.9em;
}

.profile-info p {
    color: #555;
    margin: 5px 0;
}

.change-password-button {
    background-color: #4A90E2;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    border-radius: 4px;
    cursor: pointer;
}

.change-password-button:hover {
    background-color: #357ABD;
}

.personal-info-section h3 {
    font-size: 1.2em;
    color: #333;
    margin-bottom: 20px;
}

.personal-info-section .icon {
    font-size: 1.3em;
    margin-right: 5px;
}

.form-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    font-size: 0.9em;
    color: #555;
}

.form-group label {
    width: 120px;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="file"] {
    flex: 1;
    padding: 8px;
    font-size: 1em;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.save-button {
    background-color: #4A90E2;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    max-width: 200px;
    display: block;
    margin: 20px auto 0;
    text-align: center;
}

.save-button:hover {
    background-color: #357ABD;
}


    </style>
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
            <li><a href="customer.php"><i class="fas fa-users"></i> Clients</a></li>
        </ul>
        <ul class="bottom-menu">
            <li class="active"><a href="setting.php"><i class="fas fa-cog"></i> Paramètre</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Se Déconnecter</a></li>
        </ul>
    </aside>

    <div class="content">
        <div class="settings-page">
            <div class="profile-section">
                <img src="img/profil.jpg" alt="Profile Image" class="profile-img">
                <h3 class="profile-name">FRAVIOGARRY</h3>
                <p class="profile-email">fraviogarry@gmail.com</p>
        
                <div class="profile-info">
                    <p><strong>Nom :</strong> FRAVIOGARRY</p>
                    <p><strong>Téléphone :</strong> 0345840901</p>
                    <p><strong>Email :</strong> fraviogarry@gmail.com</p>
                </div>
        
                <button class="change-password-button">Modifier Mot de passe</button>
            </div>
        
            <div class="personal-info-section">
                <h3><span class="icon">👤</span> INFO PERSONNELLE</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" id="name" value="Fraviogarry" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" value="fraviogarry@gmail.com" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone :</label>
                        <input type="text" id="phone" value="0345840901" readonly>
                    </div>
                    <div class="form-group">
                        <label for="profile-pic">Photo de profil :</label>
                        <input type="file" id="profile-pic">
                    </div>
                    <button type="submit" class="save-button">Enregistrer</button>
                </form>
            </div>
        </div>
        
    </div>


</body>
</html>
