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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style1.css" />
    <link rel="stylesheet" href="../assets/css/login.css" />
    <title>Ajouter consommation</title>
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
        <center>
            <br><br>
            <h5><b>AJOUTER CONSOMMATION</b></h5>
            <br>
            <div class="form">
                <form action="ajouterconsom_client.php" method="post" enctype="multipart/form-data">
                    <label for="consom_mensuelle">Consommation (En kwh):</label>
                    <br>
                    <input type="text" name="consom_mensuelle" id="consom_mensuelle" class="form-field" required>
                    <br><br>
                    <label for="mois">Mois:</label>
                    <br>
                    <input type="text" name="mois" id="mois" class="form-field" required>
                    <br><br>
                    <label for="annee">Année:</label>
                    <br>
                    <input type="text" name="annee" id="annee" class="form-field" required>
                    <br><br>
                    <label for="photo_compteur">Photo du compteur:</label>
                    <br>
                    <input type="file" name="photo_compteur" id="photo_compteur" class="form-field" accept="image/*" required>
                    <br>
                    <div class="mtop"></div>
                    <button type="submit" id="submit"><b>AJOUTER CONSOMMATION</b></button>
                    <br><br>
                </form>
            </div>
        </center>

        <div class="mtop"></div>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $consom_mensuelle = $_POST['consom_mensuelle'];
            $mois = $_POST['mois'];
            $annee = $_POST['annee'];

            $target_dir = "../uploads/";
            $photo = $_FILES['photo_compteur']['name'];
            $target_file = $target_dir . basename($photo);

            // Assurez-vous que le dossier d'upload existe
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            move_uploaded_file($_FILES['photo_compteur']['tmp_name'], $target_file);
            $photo_link = "../uploads/" . $photo; // Mettez le chemin correct ici

            try {
                // Nouvelle connexion à la base de données

                $conn6 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                $connn6 = $conn6->prepare("SELECT * FROM `consommation_mensuelle` WHERE mois = :mois AND annee = :annee AND ID_Client = :ID_Client");
                $connn6->bindParam(':mois', $mois);
                $connn6->bindParam(':annee', $annee);
                $connn6->bindParam(':ID_Client', $ID_Client);
                $connn6->execute();

                $direct6 = $connn6->fetch();

                if ($direct6) {

                    //pour reclamer que le client a déjà saisi la consommation dans un mois et une année précises

                    $_SESSION['failure_message'] = "Consommation dans ce mois et année est déjà saisie !";

                    header('Location: afficherconsom_client.php');

                    exit();
                } else {

                    if($consom_mensuelle < 0){

                        // pour ajouter la consommation qui n'existe pas déjà dans un mois et une année précises
                        $conn5 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                        $stmt = $conn5->prepare("INSERT INTO `consommation_mensuelle` (mois, annee, photo_compteur, consom_mensuelle, statut, etat_consom, date_saisie, ID_Client, ID_Fournisseur) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)");

                        $stmt->execute([$mois, $annee, $photo_link, $consom_mensuelle, 'non paye', 'non valide', $ID_Client, $ID_Fournisseur]);

                        $_SESSION['warning_message'] = "Consommation ajoutée mais non encore validée (Consommation négatif)";

                        header('Location: afficherconsom_client.php');

                        exit();

                    }else if($consom_mensuelle > 0){

                        // Si le mois est 1, ajuster l'année et le mois précédent
                        if ($mois == 1) {
                            $mois_precedent = 12;
                            $annee_precedente = $annee - 1;
                        } else {
                            $mois_precedent = $mois - 1;
                            $annee_precedente = $annee;
                        }

                        $conn = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Interroger la base de données pour obtenir la consommation du mois précédent
                        $sql = "SELECT consom_mensuelle FROM consommation_mensuelle WHERE mois = ? AND annee = ? AND ID_Client = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$mois_precedent, $annee_precedente, $ID_Client]);

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row) {
                            $consommation_mois_precedent = $row['consom_mensuelle'];

                            // Comparer les deux valeurs
                            if ($consom_mensuelle > $consommation_mois_precedent) {
                                // La consommation est supérieure, effectuer l'insertion dans la base de données
                                $sql_insert = "INSERT INTO consommation_mensuelle (mois, annee, photo_compteur, consom_mensuelle, statut, etat_consom, date_saisie, ID_Client, ID_Fournisseur) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
                                $stmt_insert = $conn->prepare($sql_insert);
                                $stmt_insert->execute([$mois, $annee, $photo_link, $consom_mensuelle, 'non paye', 'valide', $ID_Client, $ID_Fournisseur]);

                                $_SESSION['success_message'] = "Consommation enregistrée avec succès !";
                                
                                header('Location: afficherconsom_client.php');

                                exit();
                            } else if ($consom_mensuelle < $consommation_mois_precedent) {

                                $sql_insert1 = "INSERT INTO consommation_mensuelle (mois, annee, photo_compteur, consom_mensuelle, statut, etat_consom, date_saisie, ID_Client, ID_Fournisseur) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
                                $stmt_insert1 = $conn->prepare($sql_insert1);
                                $stmt_insert1->execute([$mois, $annee, $photo_link, $consom_mensuelle, 'non paye', 'non valide', $ID_Client, $ID_Fournisseur]);

                                $_SESSION['warning_message'] = "Consommation ajoutée mais non encore validée (Consommation inférueure à celle insérée le mois avant)";
                                
                                header('Location: afficherconsom_client.php');

                                exit();
                            }
                        } else {
                            
                            $sql_insert2 = "INSERT INTO consommation_mensuelle (mois, annee, photo_compteur, consom_mensuelle, statut, etat_consom, date_saisie, ID_Client, ID_Fournisseur) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
                            $stmt_insert2 = $conn->prepare($sql_insert2);
                            $stmt_insert2->execute([$mois, $annee, $photo_link, $consom_mensuelle, 'non paye', 'valide', $ID_Client, $ID_Fournisseur]);

                            $_SESSION['success_message'] = "Consommation enregistrée avec succès !";
                            
                            header('Location: afficherconsom_client.php');

                            exit();
                        }
                    }
                }
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
