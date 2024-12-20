<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - MadaPOS</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="login-container">
  
    <div class="login-left">

      <h1>SE CONNECTER</h1>
      <div class="underline"></div>
      
      <form action="login_process.php" method="post">
        <input type="text" id="name" name="name" placeholder="Utilisateur">
        <input type="password" id="password" name="password" placeholder="Mot de passe">
        <button type="submit" class="login-button">CONNECTER</button>
        <p class="login-link">Vous n'avez pas de compte ? <a href="singup.php">S'inscrire</a></p>
            <p>ou</p>
            <div class="social-buttons">
                <button class="google-button">Google</button>
                <button class="facebook-button">Facebook</button>
            </div>
      </form>
 
    </div>
    <div class="login-right">
        <img src="img/logo.png" alt="MadaPOS Logo" width="200" style="margin-bottom: 20px;">
        <h1>WELCOME BACK</h1>
      <p>Une application de gestion Point de Vente à Madagascar</p>
    </div>
  </div>
</body>
</html>