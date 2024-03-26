<?php
    session_start();

    $ID_Client = $_SESSION['ID_Client'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Destruction de la session
        session_destroy();
    
        // Redirection vers la page de connexion
        header('Location: ../login.php');
        exit();
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
    <title>Tableau de bord - Client</title>
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
      <center><h3>Bonjour Client, <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?></h3></center>

      <div class="mtop"></div>
      <center>
        <div class="row">
            <div class="col-lg-6">
                <h5><b>MES FACTURES</b></h5>
            </div>
            <div class="col-lg-6">
                <button class="radius-button" id="first-btn"><a href="afficherconsom_client.php" class="lien">TOUT AFFICHER</a></button>
            </div>
        </div>
      </center>
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

        try {
            // Nouvelle connexion à la base de données
            $conn5 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
            /*edit the limit of the consuming's number*/
            $connn5 = $conn5->prepare("SELECT * FROM `consommation_mensuelle` WHERE ID_Client=:ID_Client LIMIT 3");
            $connn5->bindParam(':ID_Client', $ID_Client);
            $connn5->execute();
                echo '<table>';
                echo '<tr>';
                echo '<th>' . 'ID' . '</th>';
                echo '<th>' . 'Mois' . '</th>';
                echo '<th>' . 'Annee' . '</th>';
                echo '<th>' . 'Prix total' . '</th>';
                echo '<th>' . 'Prix HT' . '</th>';
                echo '<th>' . 'Prix TTC' . '</th>';
                echo '<th>' . 'Statut' . '</th>';
                echo '<th>' . 'Date de saisie' . '</th>';
                echo '<th>' . 'Facture' . '</th>';
                echo '</tr>';

                while ($consom5 = $connn5->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>' . $consom5['ID_Consommation'] . '</td>';
                    echo '<td>' . $consom5['mois'] . '</td>';
                    echo '<td>' . $consom5['annee'] . '</td>';
                    echo '<td>' . $consom5['consom_mensuelle'] . ' MAD' . '</td>';
                    $cm5 = $consom5['consom_mensuelle'];
                    if($cm5>=0 && $cm5<=100){
                        $cm5_1 = $cm5 * 0.8;
                        echo '<td>' . $cm5_1 . ' MAD' . '</td>';
                        $cm5_11 = $cm5_1+$cm5_1*0.14;
                        echo '<td>' . $cm5_11 . ' MAD' . '</td>';
                    }
                    else if($cm5>=101 && $cm5<=200){
                        $cm5_2 = $cm5 * 0.9;
                        echo '<td>' . $cm5_2 . ' MAD' . '</td>';
                        $cm5_22 = $cm5_2+$cm5_2*0.14;
                        echo '<td>' . $cm5_22 . ' MAD' . '</td>';
                    }
                    else if($cm5>=201){
                        $cm5_3 = $cm5 * 1.0;
                        echo '<td>' . $cm5_3 . ' MAD' . '</td>';
                        $cm5_33 = $cm5_3+$cm5_3*0.14;
                        echo '<td>' . $cm5_33 . ' MAD' . '</td>';
                    }
                    echo '<td>' . $consom5['statut'] . '</td>';
                    echo '<td>' . $consom5['date_saisie'] . '</td>';

                    /*
                        ici pour distincter entre 2 cas : si le fournisseur a valide la consommation pour le telechargement 
                        automatique de la facture, sinon s'affiche que la consommation n'est pas encore valide par le fournisseur
                    */

                    $id_consom = $consom5['ID_Consommation'];

                    $conn6 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                    $connn6 = $conn6->prepare("SELECT * FROM `consommation_mensuelle` WHERE ID_Consommation = :id_consom");
                    $connn6->bindParam(':id_consom', $id_consom);
                    $connn6->execute();

                    $direct6 = $connn6->fetch();

                    if($direct6){

                        if($direct6['etat_consom'] == 'non valide'){
                            echo '<td>' . '<b><i style="color:grey;">Consommation non encore validée par le fournisseur</i></b>' . '</td>';
                        }
                        else if($direct6['etat_consom'] == 'valide'){
                            echo '<td>';
                            echo '<form action="telecharger_facture.php" method="post" enctype="multipart/form-data">';

                            echo '<input type="hidden" name="ID_Consommation" value="' . $consom5['ID_Consommation'] . '">';
                            echo '<input type="hidden" name="mois" value="' . $consom5['mois'] . '">';
                            echo '<input type="hidden" name="annee" value="' . $consom5['annee'] . '">';
                            echo '<input type="hidden" name="photo_compteur" value="' . $consom5['photo_compteur'] . '">';
                            echo '<input type="hidden" name="consom_mensuelle" value="' . $consom5['consom_mensuelle'] . '">';
                            echo '<input type="hidden" name="statut" value="' . $consom5['statut'] . '">';
                            echo '<input type="hidden" name="etat_consom" value="' . $consom5['etat_consom'] . '">';
                            echo '<input type="hidden" name="date_saisie" value="' . $consom5['date_saisie'] . '">';
                            echo '<input type="hidden" name="ID_Client" value="' . $consom5['ID_Client'] . '">';
                            echo '<input type="hidden" name="ID_Fournisseur" value="' . $consom5['ID_Fournisseur'] . '">';

                            echo '<input type="submit" class="radius-button" id="first-btn" value="TELECHARGER">';
                            echo '</form>';
                            echo '</td>';
                        }
                    }
                    
                    echo '</tr>';
                }
                
                echo '</table>';    
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    ?>
    </center>
    <div class="mtop"></div>
    <div class="mtop"></div>
    <center>
        <div class="row">
            <div class="col-lg-6">
                <h5><b>MES RECLAMATIONS</b></h5>
            </div>
            <div class="col-lg-6">
                <!--fix routing of all show-->
                <button class="radius-button" id="first-btn"><a href="afficherreclamation_client.php" class="lien">TOUT AFFICHER</a></button>
            </div>
        </div>
    </center>
      <div class="mtop"></div>
      <center>
      <?php

        try {
            // Nouvelle connexion à la base de données
            $conn4 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
            $connn4 = $conn4->prepare("SELECT * FROM `reclamation` WHERE ID_Client=:ID_Client LIMIT 3");
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
        <div class="mtop"></div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
