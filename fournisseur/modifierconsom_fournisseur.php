<?php
// modifierclient_fournisseur.php

session_start();

$ID_Fournisseur = $_SESSION['ID_Fournisseur'];

if (!isset($_GET['id'])) {
    // Rediriger vers une page d'erreur si l'ID du client n'est pas fourni
    header('Location: erreur.php');
    exit();
}

$consommationId = $_GET['id'];

try {
    $conn = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
    $stmt = $conn->prepare("SELECT * FROM `consommation_mensuelle` WHERE ID_Consommation = :consommationId");
    $stmt->bindParam(':consommationId', $consommationId);
    $stmt->execute();

    if ($clientData = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $newConsomMensuelle = $_POST['consom_mensuelle'];
            // $newStatut = 'paye';

            // Mettre à jour la base de données
            $updateStmt = $conn->prepare("UPDATE `consommation_mensuelle` SET consom_mensuelle = :newConsomMensuelle WHERE ID_Consommation = :consommationId");
            $updateStmt->bindParam(':newConsomMensuelle', $newConsomMensuelle);
            // $updateStmt->bindParam(':newStatut', $newStatut);
            $updateStmt->bindParam(':consommationId', $consommationId);

            if ($updateStmt->execute()) {

                        $_SESSION['success_edit'] = 'Consommation mis à jour avec succès.';
                        header('Location: afficherconsommen_fournisseur.php');
                        exit();
            } else {
                // Le client n'existe pas ou n'appartient pas à ce fournisseur
                $_SESSION['failure_edit'] = "Consommation non trouvé.";
                header('Location: afficherconsommen_fournisseur.php');
                exit();
            }
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
    <title>Modifier consommation</title>
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
                <h5>Modifier consommation</h5>
                <form method="POST" action="">
                    <label for="consom_mensuelle">Consommation(en Kwh):</label>
                    <br>
                    <input type="text" id="consom_mensuelle" name="consom_mensuelle" value="<?= $clientData['consom_mensuelle'] ?>" required>
                    <br>
                    <label for="statut">Statut:</label>
                    <br>
                    <input type="text" id="statut" name="statut" value="<?= $clientData['statut'] ?>" required disabled>
                    <br><br>
                    <input type="submit" value="Modifier infos consommation" class="edit">
                </form>
            </center>

    <div class="mtop"></div>
    <div class="mtop"></div>
    <br><br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
    
} catch (PDOException $e) {
    die('Error:' . $e->getMessage());
}
?>
