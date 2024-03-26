<?php
    session_start();

    $ID_Client = $_SESSION['ID_Client'];
    $ID_Fournisseur = $_SESSION['ID_Fournisseur'];

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
    <link rel="stylesheet" href="../assets/css/login1.css" />
    <title>Ajouter reclamation</title>
  </head>
  <body>
    <div class="container">
      <header>
        <div class="nav__logo">
          <img src="../assets/images/electrica.png" alt="logo">
        </div>
        <center>
          <ul class="nav__links">
            <li class="link"><a href="dashboard_client.php">TABLEAU DE BORD</a></li>
            <li></li>
            <li class="link"><a href="afficherconsom_client.php">CONSOMMATIONS MENSUELLES</a></li>
            <li></li>
            <li class="link"><a href="afficherreclamation_client.php">RECLAMATIONS</a></li>
          </ul>
        </center>
        <form action="dashboard_client.php" method="post">
            <input type="submit" class="rounded-button" id="first-btn" value="LOGOUT">
        </form>
      </header>
      <!-- <div class="mtop"></div> -->
      <center>
        <br><br>
            <h5><b>AJOUTER RECLAMATION</b></h5>
            <br>
            <div class="form">
            <form action="ajouterreclamation_client.php" method="post">
            <label for="type_reclamation"><b>Type de la réclamation:</b></label>
                    <br><br>
                    <input type="radio" name="type_reclamation" id="fuite_interne" value="Fuite interne">Fuite interne
                    <br>
                    <input type="radio" name="type_reclamation" id="fuite_externe" value="Fuite externe">Fuite externe
                    <br>
                    <input type="radio" name="type_reclamation" id="facture" value="Facture">Facture
                    <br>
                    <input type="radio" name="type_reclamation" id="autre_radio" value="Autre">Autre: <input type="text" name="autre_type_reclamation" id="autre_type_reclamation">
                    <br><br>
                    <label for="desc_reclamation"><b>Description:</b></label>
                    <br><br>
                    <textarea name="desc_reclamation" id="desc_reclamation" cols="50" rows="5" required></textarea>
                    <br><br>
            <!-- <div class="mtop"></div> -->
            <button type="submit" id="submit"><b>AJOUTER RECLAMATION</b></button>
            <br><br>
        </form>
        </div>
      </center>

      <div class="mtop"></div>
      <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $type_reclamation = $_POST['type_reclamation'];
        if ($type_reclamation === "Autre") {
            $type_reclamation = $_POST["autre_type_reclamation"];
        }

        $desc_reclamation = $_POST['desc_reclamation'];

        try {

                // pour ajouter la reclamation

                $conn5 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                $stmt = $conn5->prepare("INSERT INTO `reclamation` (type_reclamation, desc_reclamation, reponse_reclamation, statut, ID_Client, ID_Fournisseur) VALUES (?, ?, ?, ?, ?, ?)");

                $stmt->execute([ $type_reclamation, $desc_reclamation, 'Pas encore traite', 'En cours', $ID_Client, $ID_Fournisseur]);

                $_SESSION['success_message'] = "Reclamation ajoutée avec succès!";

                header('Location: afficherreclamation_client.php');

                exit();

        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    ?>
      
      <div class="mtop"></div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
