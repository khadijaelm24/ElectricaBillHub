<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/login.css" />
    <title>Se connecter</title>
  </head>
  <body>
    <div class="container">
    <div class="left">
      <div class="header">
        <img src="assets/images/electrica.png" alt="logo">
        <h2 class="animation a1">LOGIN</h2>
        <br> 
      </div>
      <div class="form">
        <form action="login.php" method="post">
          <label for="email">Email:</label>
          <br>
          <input type="email" name="email" id="email" class="form-field animation a3" required>
          <br><br>
          <label for="pwd">Mot de passe:</label>
          <br>
          <input type="password" name="pwd" id="pwd" class="form-field animation a4" required>
          <div class="mtop"></div>
          <button type="submit" id="submit" class="animation a6"><b>SE CONNECTER</b></button>
          <br><br>
      </form>
      <br>
      <center><a href="index.php">Retour à la page d'acceuil</a></center>
      
      </div>
    </div>
    <div class="right"></div>
  </div>
  </body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Appel des méthodes POST
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    try {
        // Nouvelle connexion à la base de données
        $conn = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
        $connn = $conn->prepare("SELECT * FROM `login` WHERE email=:email");
        $connn->bindParam(':email', $email);
        $connn->execute();

        // Extraction de la ligne qui contient l'e-mail exact
        $direct = $connn->fetch();

        // Vérifiez si l'utilisateur existe par email et mot de passe et est un client
        if ($direct && password_verify($pwd, $direct['pwd']) && $direct['user_type'] == "client") {
            $email_client = $direct['email'];

            // Nouvelle connexion pour récupérer les données du client de la base de données
            $conn2 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
            $connn2 = $conn2->prepare("SELECT * FROM `client` WHERE email = :email_client");
            $connn2->bindParam(':email_client', $email_client);
            $connn2->execute();

            $direct2 = $connn2->fetch();

            if ($direct2 && password_verify($pwd, $direct2['pwd'])) {
                // Démarrage de la session
                session_start();
                $_SESSION['ID_Client'] = $direct2['ID_Client'];
                $_SESSION['email'] = $direct2['email'];
                $_SESSION['pwd'] = $direct2['pwd'];
                $_SESSION['nom'] = $direct2['nom'];
                $_SESSION['prenom'] = $direct2['prenom'];
                $_SESSION['adresse'] = $direct2['adresse'];
                $_SESSION['ID_Login'] = $direct2['ID_Login'];
                $_SESSION['ID_Fournisseur'] = $direct2['ID_Fournisseur'];

                header('Location: client/dashboard_client.php');
                exit();
            }
        }
        else if ($direct && password_verify($pwd, $direct['pwd']) && $direct['user_type'] == "fournisseur") {
            $email_fournisseur = $direct['email'];

            // Nouvelle connexion pour récupérer les données du fournisseur de la base de données
            $conn3 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
            $connn3 = $conn3->prepare("SELECT * FROM `fournisseur` WHERE email = :email_fournisseur");
            $connn3->bindParam(':email_fournisseur', $email_fournisseur);
            $connn3->execute();

            $direct3 = $connn3->fetch();

            if ($direct3 && password_verify($pwd, $direct3['pwd'])) {
                // Démarrage de la session
                session_start();
                $_SESSION['ID_Fournisseur'] = $direct3['ID_Fournisseur'];
                $_SESSION['email'] = $direct3['email'];
                $_SESSION['pwd'] = $direct3['pwd'];
                $_SESSION['nom'] = $direct3['nom'];
                $_SESSION['prenom'] = $direct3['prenom'];
                $_SESSION['ID_Login'] = $direct3['ID_Login'];

                header('Location: fournisseur/dashboard_fournisseur.php');
                exit();
            }
        }
        else{
            echo '<script>alert("Email ou mot de passe incorrect !");</script>';
        }
    } catch (PDOException $e) {
        die('Error:' . $e->getMessage());
    }
}
?>
