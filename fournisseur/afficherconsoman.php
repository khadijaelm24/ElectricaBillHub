<?php

    session_start();
    
    $userId = $_SESSION['ID_Fournisseur'];
    $userEmail = $_SESSION['email'];
    $userPwd = $_SESSION['pwd'];
    $userNom = $_SESSION['nom'];
    $userPrenom = $_SESSION['prenom'];
    $userIdL = $_SESSION['ID_Login'];

?>

<?php

    // Vérifiez si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifiez si un fichier a été téléchargé avec succès
        if (isset($_FILES["consom"]) && $_FILES["consom"]["error"] == UPLOAD_ERR_OK) {
            // Récupérez le chemin du fichier temporaire
            $fileTmpPath = $_FILES["consom"]["tmp_name"];

            // Lisez le fichier ligne par ligne
            $lines = file($fileTmpPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            try {
                // Nouvelle connexion à la base de données
                $conn4 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');

                // Préparez la requête d'insertion
                $insertQuery = $conn4->prepare("INSERT INTO `consommation_annuelle` (ID_Fournisseur, ID_Client, Consommation, Annee, Date_Saisie) VALUES (?, ?, ?, ?, ?)");

                // Parcourez chaque ligne du fichier
                foreach ($lines as $line) {
                    // Divisez la ligne en éléments en utilisant une virgule comme délimiteur
                    $data = explode(",", $line);

                    // Assurez-vous que la ligne contient suffisamment d'éléments
                    if (count($data) == 4) {
                        // Exécutez la requête d'insertion avec les données de la ligne
                        $insertQuery->execute([$userId, $data[0], $data[1], $data[2], $data[3]]);
                    }
                }

                // Fermez la connexion à la base de données
                $conn4 = null;

                // Définissez un message de succès
                $_SESSION['success_message'] = "Le contenu du fichier texte a été importé avec succès dans la table ci-dessous.";

                // Redirigez l'utilisateur vers la page actuelle pour éviter le renvoi du formulaire par actualisation
                header("Location: {$_SERVER['REQUEST_URI']}");
                exit();
            } catch (PDOException $e) {
                die('Error:' . $e->getMessage());
            }
        } else {
            // Affichez un message d'erreur si le fichier n'a pas été téléchargé correctement
            $_SESSION['failure_message'] = "Erreur lors du téléchargement du fichier.";
        }
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
    <title>Consommations annuelles</title>
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
            <h5><b>CONSOMMATIONS ANNUELLES</b></h5>
        </div>
        <br>
        <form action="afficherconsoman.php" method="post" enctype="multipart/form-data">
            <h5>Veuillez importer le fichier texte de la consommation annuelle de l'agent:</h5>
            <br>
            <label for="consom"></label>
            <input type="file" name="consom" id="consom" accept=".txt, .doc, .docx, .pdf" required>
            <br><br>
            <button type="submit" class="add">IMPORTER FICHIER</button>
            <br><br>
        </form>
    </center>
    <div class="mtop"></div>
    <center>
        <?php

            try {
                // Nouvelle connexion à la base de données
                $conn4 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                $connn4 = $conn4->prepare("SELECT * FROM `consommation_annuelle`");
                $connn4->execute();
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>' . 'ID' . '</th>';
                    echo '<th>' . 'ID Client' . '</th>';
                    echo '<th>' . 'Annee' . '</th>';
                    echo '<th>' . 'Consommation client' . '</th>';
                    echo '<th>' . 'Consommation agent' . '</th>';
                    echo '<th>' . 'Différence tolérée' . '</th>';
                    echo '<th>' . 'Difference' . '</th>';
                    echo '</tr>';

                    while ($consoman = $connn4->fetch(PDO::FETCH_ASSOC)){
                        $consomCl = 0;
                        
                        echo '<tr>';
                        echo '<td>' . $consoman['ID_Consom_An'] . '</td>';
                        echo '<td>' . $consoman['ID_Client'] . '</td>';
                        echo '<td>' . $consoman['Annee'] . '</td>';

                        $annee = $consoman['Annee'];
                        $idClient = $consoman['ID_Client'];

                        $connn5 = $conn4->prepare("SELECT SUM(`consom_mensuelle`) as `somme` FROM `consommation_mensuelle` WHERE annee = :annee AND ID_Client = :idClient");
                        $connn5->bindParam(':annee', $annee);
                        $connn5->bindParam(':idClient', $idClient);

                        if ($connn5->execute()) {
                            // Utilisez fetch pour récupérer le résultat
                            $result = $connn5->fetch(PDO::FETCH_ASSOC);

                            // Vérifiez si le résultat est valide
                            if ($result !== false) {
                                echo '<td>' . $result['somme'] . '</td>';
                            } 
                        } 

                        echo '<td>' . $consoman['Consommation'] . '</td>';
                        
                        $tolerance = 'non'; // Par défaut, la tolérance est non

                        // Calcul de la différence
                        $difference = $result['somme'] - $consoman['Consommation'];

                        // Vérification de la tolérance
                        if (abs($difference) <= 50) {
                            $tolerance = 'oui';
                        }

                        // Affichage des résultats
                        echo '<td>' . $tolerance . '</td>';
                        echo '<td>' . $difference . '</td>';
                        
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
