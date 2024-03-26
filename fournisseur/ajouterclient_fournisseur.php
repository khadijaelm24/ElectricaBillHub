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
    <title>Ajouter client</title>
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
            <h5><b>AJOUTER CLIENT</b></h5>
            <br>
            <div class="form">
            <form action="ajouterclient_fournisseur.php" method="post" enctype="multipart/form-data">
            <label for="nom">Nom:</label>
            <br>
                    <input type="text" name="nom" id="nom" required>
                    <br>
                    <label for="prenom">Prenom:</label>
                     <br>
                    <input type="text" name="prenom" id="prenom" required>
                    <br>
                    <label for="email">Email:</label>
                    <br>
                    <input type="email" name="email" id="email" required>
                    <br>
                    <label for="pwd">Mot de passe:</label>
                    <br>
                    <input type="password" name="pwd" id="pwd" required>
                    <br>
                    <label for="adresse">Adresse:</label>
                    <br>
                    <input type="text" name="adresse" id="adresse" required>
                    <br><br>
                    <button type="submit" class="add">AJOUTER CLIENT</button>
            <br><br>
        </form>
        </div>
      </center>
      <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        // Hasher le pwd
        
        $pwd = password_hash($pwd, PASSWORD_BCRYPT);

        $adresse = $_POST['adresse'];

        try {
            // Nouvelle connexion à la base de données

            $conn6 = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
            $connn6 = $conn6->prepare("SELECT * FROM `client` WHERE nom = :nom AND prenom = :prenom AND email = :email");
            $connn6->bindParam(':nom', $nom);
            $connn6->bindParam(':prenom', $prenom);
            $connn6->bindParam(':email', $email);
            $connn6->execute();

            $direct6 = $connn6->fetch();

            if($direct6){
                
                //pour reclamer que le client a deja saisi la consommation dans un mois et annee precises
                
                $_SESSION['failure_message'] = "Ce client existe déjà!";

                header('Location: afficherclient_fournisseur.php');

                exit();
            }
            else{
                
                $stmt = $conn6->prepare("INSERT INTO `login` (email, pwd, user_type) VALUES (?, ?, ?)");
                $stmt->execute([$email, $pwd, 'client']);

                $stmt2 =$conn6->prepare("SELECT * FROM `login` WHERE email = :email"); 
                $stmt2->bindParam(':email', $email);
                $stmt2->execute();

                $direct2 = $stmt2->fetch();

                if($direct2){
                    $ID_Login = $direct2['ID_Login'];
                
                    $stmt3 = $conn6->prepare("INSERT INTO `client` (email, pwd, nom, prenom, adresse, ID_Login, ID_Fournisseur) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt3->execute([$email, $pwd, $nom, $prenom, $adresse, $ID_Login, $ID_Fournisseur]);

                    $_SESSION['success_message'] = "Client ajouté(e) avec succès!";

                    header('Location: afficherclient_fournisseur.php');

                    exit();

                }

            }

        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    ?>
    <br><br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
