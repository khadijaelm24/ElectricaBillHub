<?php

    session_start();
    
    $ID_Fournisseur = $_SESSION['ID_Fournisseur'];
    $userEmail = $_SESSION['email'];
    $userPwd = $_SESSION['pwd'];
    $userNom = $_SESSION['nom'];
    $userPrenom = $_SESSION['prenom'];
    $userIdL = $_SESSION['ID_Login'];

    if (!isset($_GET['id'])) {
        // Rediriger vers une page d'erreur si l'ID du client n'est pas fourni
        header('Location: erreur.php');
        exit();
    }
    
    $reclamationId = $_GET['id'];

    try {
            // Le formulaire est soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer les données du formulaire
                $reponse_reclamation = $_POST['reponse_reclamation'];
    
                // Mettre à jour la base de données
                $conn = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');

                $updateStmt = $conn->prepare("UPDATE `reclamation` SET reponse_reclamation = :reponse_reclamation, statut = 'Traite' WHERE ID_Reclamation = :reclamationId");
                $updateStmt->bindParam(':reponse_reclamation', $reponse_reclamation);
                $updateStmt->bindParam(':reclamationId', $reclamationId);

                $updateStmt->execute();

                $_SESSION['success_edit'] = 'Réclamation d\'ID: ' . $reclamationId . ' a été bien traitée !';
                header('Location: afficherreclamation_fournisseur.php');
                exit();

            } 
    } catch (PDOException $e) {
    die('Error:' . $e->getMessage());
    }

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
    <title>Répondre au réclamation</title>
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
      
      <?php
        echo '<style>';
        echo 'table {
                width: 90%;
                border-collapse: collapse;
            }';

        echo 'th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }';

        echo 'th {
                background-color: #219499;
            }';

        echo '.reply{
            color: gray;
        }';
        echo '</style>';
    ?>

    <div class="mtop"></div>

    <center>
        <div class="row">
            <h5><b>REPONDRE A LA RECLAMATION</b></h5>
            <form action="" method="post">
                <label for="reponse_reclamation">Reponse:</label>
                <br><br>
                <textarea name="reponse_reclamation" id="reponse_reclamation" cols="50" rows="5" required></textarea>
                <br><br>
                <button type="submit" class="edit">REPONDRE</button>
            </form>
        </div>
    </center>

    <div class="mtop"></div>
    
    <br><br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
