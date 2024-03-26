<?php
// modifierclient_fournisseur.php

session_start();

$ID_Fournisseur = $_SESSION['ID_Fournisseur'];

if (!isset($_GET['id'])) {
    // Rediriger vers une page d'erreur si l'ID du client n'est pas fourni
    header('Location: erreur.php');
    exit();
}

$clientId = $_GET['id'];

try {
    $conn = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
    $stmt = $conn->prepare("SELECT * FROM `client` WHERE ID_Client = :clientId AND ID_Fournisseur = :ID_Fournisseur");
    $stmt->bindParam(':clientId', $clientId);
    $stmt->bindParam(':ID_Fournisseur', $ID_Fournisseur);
    $stmt->execute();

    if ($clientData = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $newNom = $_POST['nom'];
            $newPrenom = $_POST['prenom'];
            $newEmail = $_POST['email'];
            $newPwd = $_POST['pwd'];
            $newAdresse = $_POST['adresse'];

            // Hasher le pwd
            
            $newPwd = password_hash($newPwd, PASSWORD_BCRYPT);

            // Mettre à jour la base de données
            $updateStmt = $conn->prepare("UPDATE `client` SET nom = :newNom, prenom = :newPrenom, email = :newEmail, pwd = :newPwd, adresse = :newAdresse WHERE ID_Client = :clientId");
            $updateStmt->bindParam(':newNom', $newNom);
            $updateStmt->bindParam(':newPrenom', $newPrenom);
            $updateStmt->bindParam(':newEmail', $newEmail);
            $updateStmt->bindParam(':newPwd', $newPwd);
            $updateStmt->bindParam(':newAdresse', $newAdresse);
            $updateStmt->bindParam(':clientId', $clientId);

            if ($updateStmt->execute()) {
                // Mise à jour réussie

                $stmt2 = $conn->prepare("SELECT `ID_Login` FROM `client` WHERE ID_Client = :clientId AND ID_Fournisseur = :ID_Fournisseur");
                $stmt2->bindParam(':clientId', $clientId);
                $stmt2->bindParam(':ID_Fournisseur', $ID_Fournisseur);
                $stmt2->execute();

                $direct2 = $stmt2->fetch();

                if($direct2){
                    $ID_Login = $direct2['ID_Login'];

                    $updateStmt2 = $conn->prepare("UPDATE `login` SET email = :newEmail, pwd = :newPwd WHERE ID_Login = :ID_Login");
                    $updateStmt2->bindParam(':newEmail', $newEmail);
                    $updateStmt2->bindParam(':newPwd', $newPwd);
                    $updateStmt2->bindParam(':ID_Login', $ID_Login);

                    if($updateStmt2->execute()){

                        $_SESSION['success_edit'] = 'Client mis à jour avec succès.';
                        header('Location: afficherclient_fournisseur.php');
                        exit();

                    }

                }
            } else {
                // Échec de la mise à jour
                $_SESSION['failure_edit'] = 'Erreur lors de la mise à jour du client.';
            }
        }

        // Afficher le formulaire pré-rempli avec les données du client
        ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style1.css" />
    <link rel="stylesheet" href="../assets/css/login.css" />
    <title>Modifier infos client</title>
  </head>
  <body>
    <div class="container">
      <header>
        <div class="nav__logo">
          <img src="../assets/images/electrica.png" alt="logo">
        </div>
        <center>
          <ul class="nav__links">
            <li class="link"><a href="dashboard_fournisseur.php">TABLEAU DE BORD</a></li>
            <li></li>
            <li class="link"><a href="afficherclient_fournisseur.php">PROFILS CLIENTS</a></li>
            <li></li>
            <li class="link"><a href="afficherconsommen_fournisseur.php">CONSOMMATIONS MENSUELLES</a></li>
            <li></li>
            <li class="link"><a href="afficherconsoman.php">CONSOMMATIONS ANNUELLES</a></li>
            <li></li>
            <li class="link"><a href="afficherreclamation_fournisseur.php">RECLAMATIONS</a></li>
          </ul>
        </center>
        <form action="logout_fournisseur.php" method="post">
            <input type="submit" class="rounded-button" id="first-btn" value="LOGOUT">
        </form>
      </header>
      <div class="mtop"></div>
      <center>
        <br><br>
            <h5><b>MODIFIER INFOS CLIENT</b></h5>
            <br>
            <div class="form">
            <form action="" method="post">
            <label for="nom">Nom:</label>
            <br>
                    <input type="text" id="nom" name="nom" value="<?= $clientData['nom'] ?>" required>
                    <br>
                    <label for="prenom">Prenom:</label>
                    <br>
                    <input type="text" id="prenom" name="prenom" value="<?= $clientData['prenom'] ?>" required>
                    <br>
                    <label for="email">Email:</label>
                    <br>
                    <input type="email" id="email" name="email" value="<?= $clientData['email'] ?>" required>
                    <br>
                    <label for="pwd">Password:</label>
                    <br>
                    <input type="password" id="pwd" name="pwd" value="<?= $clientData['pwd'] ?>" required>
                    <br>
                    <label for="adresse">Adresse:</label>
                    <br>
                    <input type="text" id="adresse" name="adresse" value="<?= $clientData['adresse'] ?>" required>
                    <br>
            <div class="mtop"></div>
            <input type="submit" class="edit" value="MODIFIER INFOS CLIENT">
            <br><br>
        </form>
        </div>
      </center>
      <?php
    } else {
        // Le client n'existe pas ou n'appartient pas à ce fournisseur
        $_SESSION['failure_edit'] = "Client non trouvé.";
        header('Location: afficherclient_fournisseur.php');
        exit();
    }
} catch (PDOException $e) {
    die('Error:' . $e->getMessage());
}
?>
    <br><br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
