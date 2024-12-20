<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <link rel="stylesheet" href="css/singup.css">
</head>
<body>
  <div class="container">
    <!-- Left Side (Welcome Section) -->
    <div class="left-side">
      <img src="img/logo.png" alt="MadaPOS Logo" width="200" style="margin-bottom: 20px;">
      <h1>WELCOME BACK</h1>
      <p>Inscrivez-vous pour bénéficier d'un meilleur outils </p> 
      <p>pour la gestion de Vente</p>
    </div>

    <!-- Right Side (Sign Up Form) -->
    
        <div class="right-side">
            
            <h2>S'INSCRIRE</h2>
        
            <form action="signup_process.php" method="post">
                <input type="text" id="nom" name="nom" placeholder="Nom" required>
                <input type="text" id="number" name="number" placeholder="Numéro" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="password" id="conf_password" name="conf_password" placeholder="Confirmez votre mot de passe" required>
                <button type="submit" class="register-btn">ENREGISTRER</button>
            </form>

            <p class="login-link">Vous avez un compte ? <a href="login.php">Se connecter</a></p>

            <div class="alternate-signup">
                <p>
                    <button class="google-button">Google</button>
                    <button class="facebook-button">Facebook</button>
                </p>
                
            </div>
            </form>
            
        </div>
  </div>
</body>
</html>