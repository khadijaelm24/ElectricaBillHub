<?php
    session_start();

    $ID_Client = $_SESSION['ID_Client'];

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
    <title>Reclamations</title>
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

    <center>
        <?php
        // Afficher le message de succès s'il est présent
        if (isset($_SESSION['success_message'])) {
            echo '<div style="width:80vh"><div class="alert alert-success">' . $_SESSION['success_message'] . '</div></div>';
            unset($_SESSION['success_message']); // Supprimer le message après l'avoir affiché
        }
        ?>
    </center>
      <div class="mtop"></div>
    <center>
        <div class="row">
            <div class="col-lg-6">
                <h5><b>MES RECLAMATIONS</b></h5>
            </div>
            <div class="col-lg-6">
                <!--fix routing of all show-->
                <button class="radius-button" id="first-btn"><a href="ajouterreclamation_client.php" class="lien">AJOUTER RECLAMATION</a></button>
            </div>
        </div>
    </center>
      <div class="mtop"></div>
      <center>
        <?php

            try {
                // Nouvelle connexion à la base de données
                $conn4 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                $connn4 = $conn4->prepare("SELECT * FROM `reclamation` WHERE ID_Client=:ID_Client");
                $connn4->bindParam(':ID_Client', $ID_Client);
                $connn4->execute();
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>' . 'ID' . '</th>';
                    echo '<th>' . 'Type' . '</th>';
                    echo '<th>' . 'Description' . '</th>';
                    echo '<th>' . 'Reponse' . '</th>';
                    echo '<th>' . 'Statut' . '</th>';
                    echo '</tr>';

                    while ($reclamations4 = $connn4->fetch(PDO::FETCH_ASSOC)){
                        echo '<tr>';
                        echo '<td>' . $reclamations4['ID_Reclamation'] . '</td>';
                        echo '<td>' . $reclamations4['type_reclamation'] . '</td>';
                        echo '<td>' . $reclamations4['desc_reclamation'] . '</td>';
                        echo '<td class="reply">' . '<span style="color:black; font-weight:500;">'. $reclamations4['reponse_reclamation'] . '</span>'.  '</td>';
                        echo '<td>' . $reclamations4['statut'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';    
            } catch (PDOException $e) {
                die('Error:' . $e->getMessage());
            }
        ?>
    </center>
      <div class="mtop"></div>

    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
