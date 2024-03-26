<?php

    session_start();
    
    $ID_Fournisseur = $_SESSION['ID_Fournisseur'];
    $userEmail = $_SESSION['email'];
    $userPwd = $_SESSION['pwd'];
    $userNom = $_SESSION['nom'];
    $userPrenom = $_SESSION['prenom'];
    $userIdL = $_SESSION['ID_Login'];

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
    <title>Réclamations non traités</title>
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
        <?php
        // Afficher le message de succès s'il est présent
        if (isset($_SESSION['success_message'])) {
            echo '<div style="width:80vh;"><div class="alert alert-success">' . $_SESSION['success_message'] . '</div></div>';
            unset($_SESSION['success_message']); // Supprimer le message après l'avoir affiché
        } else if(isset($_SESSION['failure_message'])){
            echo '<div style="width:80vh;"><div class="alert alert-danger">' . $_SESSION['failure_message'] . '</div></div>';
            unset($_SESSION['failure_message']);
        } else if(isset($_SESSION['success_edit'])){
            echo '<div style="width:80vh;"><div class="alert alert-success">' . $_SESSION['success_edit'] . '</div></div>';
            unset($_SESSION['success_edit']);
        } else if(isset($_SESSION['failure_edit'])){
            echo '<div style="width:80vh;"><div class="alert alert-danger">' . $_SESSION['failure_edit'] . '</div></div>';
            unset($_SESSION['failure_edit']);
        }
        ?>
    </center>
    <div class="mtop"></div>

    <center>
        <div class="row">
            <h5><b>RECLAMATIONS</b></h5>
        </div>
    </center>
    <div class="mtop"></div>

    <center>
        <?php

            try {
                // Nouvelle connexion à la base de données
                $conn4 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                $connn4 = $conn4->prepare("SELECT * FROM `reclamation` WHERE statut = 'En cours' AND ID_Fournisseur=:ID_Fournisseur");
                $connn4->bindParam(':ID_Fournisseur', $ID_Fournisseur);
                $connn4->execute();
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>' . 'ID' . '</th>';
                    echo '<th>' . 'Type reclamation' . '</th>';
                    echo '<th>' . 'Desc reclamation' . '</th>';
                    echo '<th>' . 'Statut' . '</th>';
                    echo '<th>' . 'ID Client' . '</th>';
                    echo '<th>' . 'Repondre' . '</th>';
                    echo '</tr>';

                    while ($reclamations = $connn4->fetch(PDO::FETCH_ASSOC)){
                        echo '<tr>';
                        echo '<td>' . $reclamations['ID_Reclamation'] . '</td>';
                        echo '<td>' . $reclamations['type_reclamation'] . '</td>';
                        echo '<td>' . $reclamations['desc_reclamation'] . '</td>';
                        echo '<td>' . $reclamations['statut'] . '</td>';
                        echo '<td>' . $reclamations['ID_Client'] . '</td>';
                        echo '<td>';
                        // echo '<input type="submit" class="radius-button" id="first-btn" value="MODIFIER">';
                        echo '<br><a href="repondrereclamation_fournisseur.php?id=' . $reclamations['ID_Reclamation'] . '" class="radius-button" style="text-decoration:none; color:black;">REPONDRE</a><br><br>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';    
            } catch (PDOException $e) {
                die('Error:' . $e->getMessage());
            }
        ?>
    
    <div class="mtop"></div>
    <div class="mtop"></div>
    <div class="mtop"></div>
    
    </center>

    <br><br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
