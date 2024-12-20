<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MadaPOS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
      color: #333;
    }
    .logo img {
      width: 90px;
    }
    .illustration {
      width: 100%;
      max-width: 400px;
    }
    .cart-illustration {
      width: 100%;
      max-width: 300px;
      height: auto;
    }
    .btn-custom {
      background-color:#3a3ab8;
      color: #fff;
      border: none;
    }
    .btn-custom:hover {
      background-color: #4a4aff;
      color : #fff;
    }
  </style>
</head>
<body>
  <header class="container-fluid bg-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="logo d-flex align-items-center">
        <img src="img/logo.png" alt="MadaPOS Logo">
      </div>
      <nav>
        <a href="#" id="about-link" class="text-secondary fw-bold me-3">About</a>
        <a href="login.php" class="text-secondary fw-bold">Login</a>
      </nav>
    </div>
  </header>
  
  <main class="container my-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-center">
        <img src="img/cashier.png" alt="POS Illustration" class="illustration mb-4"><br>
        <button class="btn btn-custom px-4 py-2">COMMENCER</button>
      </div>
      <div class="col-md-6 text-center">
        <h2 class="mb-4">Une solution pour une meilleure gestion de vente des produits Mobile à Madagascar</h2>
        <img src="img/undraw_empty_cart_co35.png" alt="Cart Illustration" class="cart-illustration">
      </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
