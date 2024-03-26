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
    <title>Traiter consommations mensuelles</title>
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
            <h5><b>TRAITER CONSOMMATIONS MENSUELLES</b></h5>
        </div>
    </center>

    <div class="mtop"></div>

    <center>
        <?php

            try {
                // Nouvelle connexion à la base de données
                $conn4 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                $connn4 = $conn4->prepare("SELECT * FROM `consommation_mensuelle` WHERE etat_consom = 'non valide' ");
                $connn4->execute();
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>' . 'ID' . '</th>';
                    echo '<th>' . 'Mois' . '</th>';
                    echo '<th>' . 'Annee' . '</th>';
                    echo '<th>' . 'Consommation' . '</th>';
                    echo '<th>' . 'Photo du compteur' . '</th>';
                    echo '<th>' . 'ID Client' . '</th>';
                    echo '<th>' . 'Statut' . '</th>';
                    echo '<th>' . 'Modifier' . '</th>';
                    echo '<th>' . 'Valider' . '</th>';
                    echo '<th>' . 'Facture' . '</th>';
                    echo '</tr>';

                    while ($consommen = $connn4->fetch(PDO::FETCH_ASSOC)){
                        echo '<tr>';
                        echo '<td>' . $consommen['ID_Consommation'] . '</td>';
                        echo '<td>' . $consommen['mois'] . '</td>';
                        echo '<td>' . $consommen['annee'] . '</td>';
                        echo '<td>' . $consommen['consom_mensuelle'] . '</td>';
                        echo '<td><button class="radius-button" onclick="afficherImage(\'' . $consommen['photo_compteur'] . '\')">Afficher</button></td>';
                        echo '<td>' . $consommen['ID_Client'] . '</td>';
                        echo '<td>' . $consommen['statut'] . '</td>';
                        //
                        // echo '<td><br><a href="repondrereclamation_fournisseur.php?id=' . $consommen['ID_Consommation'] . '" class="radius-button">MODIFIER</a><br><br></td>';
                        echo '<td><a href="modifierconsom_fournisseur.php?id=' . $consommen['ID_Consommation'] . '" class="radius-button" style="text-decoration:none; color:black;">MODIFIER</a></td>';
                        // 
                        echo '<td><br><a href="valider_consommation.php?id=' . $consommen['ID_Consommation'] . '" class="radius-button" style="text-decoration:none; color:black;">VALIDER</a><br><br></td>';
                        // Pour permettre la telechargement de la facture seulement que dans le cas de la validation de la consommation
                        if($consommen['etat_consom'] == 'non valide'){
                            echo '<td>';
                            //
                            echo '<form action="../client/telecharger_facture.php" method="post" enctype="multipart/form-data">';

                            echo '<input type="hidden" name="ID_Consommation" value="' . $consommen['ID_Consommation'] . '">';
                            echo '<input type="hidden" name="mois" value="' . $consommen['mois'] . '">';
                            echo '<input type="hidden" name="annee" value="' . $consommen['annee'] . '">';
                            echo '<input type="hidden" name="photo_compteur" value="' . $consommen['photo_compteur'] . '">';
                            echo '<input type="hidden" name="consom_mensuelle" value="' . $consommen['consom_mensuelle'] . '">';
                            echo '<input type="hidden" name="statut" value="' . $consommen['statut'] . '">';
                            echo '<input type="hidden" name="etat_consom" value="' . $consommen['etat_consom'] . '">';
                            echo '<input type="hidden" name="date_saisie" value="' . $consommen['date_saisie'] . '">';
                            echo '<input type="hidden" name="ID_Client" value="' . $consommen['ID_Client'] . '">';
                            echo '<input type="hidden" name="ID_Fournisseur" value="' . $consommen['ID_Fournisseur'] . '">';

                            echo '<input type="submit" class="radius-button" id="first-btn" value="TELECHARGER">';
                            echo '</form>';
                            //
                            echo '</td>';

                            // echo '<td><br><a href="repondrereclamation_fournisseur.php?id=' . $consommen['ID_Consommation'] . '" class="radius-button">FACTURE</a><br><br></td>';
                        }
                        echo '</tr>';
                    }

                    echo '</table>';    
            } catch (PDOException $e) {
                die('Error:' . $e->getMessage());
            }
        ?>
    </center>
    <script>
    function afficherImage(imageLink) {
        // Créer une fenêtre modale pour afficher l'image
        var modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0,0,0,0.7)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';

        // Créer l'élément d'image à afficher dans la fenêtre modale
        var image = document.createElement('img');
        image.src = imageLink;
        image.style.width = '64vh';
        image.style.height = '54vh';

        // Ajouter l'image à la fenêtre modale
        modal.appendChild(image);

        // Ajouter la fenêtre modale au corps du document
        document.body.appendChild(modal);

        // Fermer la fenêtre modale lorsqu'on clique dessus
        modal.onclick = function() {
            document.body.removeChild(modal);
        };
    }
</script>


    <div class="mtop"></div>
    <div class="mtop"></div>
    <br><br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
