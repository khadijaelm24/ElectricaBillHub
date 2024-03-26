<?php

    session_start();
    
    $userId = $_SESSION['ID_Fournisseur'];
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
    <title>Tableau de bord - Fournisseur</title>
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
      <center><h3>Bonjour Fournisseur, <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?></h3></center>
      <div class="mtop"></div>
      <div class="mtop"></div>

      <div class="row">
        <div class="col-lg-6">
            <center>
                <button type="button" class="main"><a href="afficherclient_fournisseur.php" class="main">AJOUTER OU MODIFIER LES INFOS CLIENTS</a></button>
                <br><br>
                <button type="button" class="main"><a href="afficherconsommen_fournisseur.php" class="main">GERER LES CONSOMMATIONS NON VALIDES</a></button>
                <br><br>
                <button type="button" class="main"><a href="afficherconsoman.php" class="main">GERER LES CONSOMMATIONS ANNUELLES</a></button>
                <br><br>
                <button type="button" class="main"><a href="afficherreclamation_fournisseur.php" class="main">TRAITER LES RECLAMATIONS</a></button>
            </center>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <center>
                        <div id="statclients">
                            <?php
                                $conn = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');
                                $connn = $conn->prepare("SELECT COUNT(*) as count FROM `client` WHERE ID_Fournisseur = :userId");
                                $connn->bindParam(':userId', $userId, PDO::PARAM_INT);
                                $connn->execute();
                                $result = $connn->fetch(PDO::FETCH_ASSOC);
                                $countValue = $result['count'];
                                
                                echo "<br><br><h5><b class=\"bold\">" . $countValue . "</b><br> CLIENTS </h5>";
                            
                            ?>
                        </div>
                    </center>
                </div>
                <div class="col-lg-6">
                <center>
                    <div id="statclients">
                    <?php
                    // Generate select options for months (1 to 12)
                    $months = range(1, 12);

                    // Generate select options for years (2021 to 2023)
                    $years = range(2022, 2024);

                    // Initialize variables to store selected values
                    $selectedMonth = isset($_POST['selectedMonth']) ? $_POST['selectedMonth'] : null;
                    $selectedYear = isset($_POST['selectedYear']) ? $_POST['selectedYear'] : null;

                    // Initialize variable to store total consumption
                    $totalConsumption = null;

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Get user-selected month and year
                        $selectedMonth = $_POST['selectedMonth'];
                        $selectedYear = $_POST['selectedYear'];

                        // Prepare the SQL query (same as before)
                        $sql = "SELECT SUM(consom_mensuelle) as totalConsumption 
                                FROM consommation_mensuelle 
                                WHERE mois = :month AND annee = :year AND ID_Fournisseur = :userId";

                        // Prepare the statement (same as before)
                        $stmt = $conn->prepare($sql);

                        // Bind parameters (same as before)
                        $stmt->bindParam(':month', $selectedMonth, PDO::PARAM_INT);
                        $stmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
                        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

                        // Execute the query (same as before)
                        $stmt->execute();

                        // Fetch the result (same as before)
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Get the total consumption value (same as before)
                        $totalConsumption = $result['totalConsumption'];
                    }
                    ?>

                    <form id="monthlyConsumptionForm" method="POST" action="dashboard_fournisseur.php">
                        <label for="month"></label>
                        <select name="selectedMonth" id="month">
                            <?php
                            foreach ($months as $month) {
                                echo "<option value=\"$month\" " . ($selectedMonth == $month ? 'selected' : '') . ">$month</option>";
                            }
                            ?>
                        </select>

                        <label for="year"></label>
                        <select name="selectedYear" id="year">
                            <?php
                            foreach ($years as $year) {
                                echo "<option value=\"$year\" " . ($selectedYear == $year ? 'selected' : '') . ">$year</option>";
                            }
                            ?>
                        </select>

                        <!-- Hidden submit button -->
                        <input type="submit" style="display: none;" id="hiddenSubmitButton">
                    </form>

                    <!-- Display the total consumption -->
                    <?php
                    if ($totalConsumption !== null) {
                        echo "<br><h5><b class=\"bold\">" . $totalConsumption . " MAD </b><br> CONSOMMATIONS MENSUELLES </h5>";
                    }
                    else if($totalConsumption == null){
                        echo "<br><h5><b class=\"bold\">" . 0 . " MAD </b><br> CONSOMMATIONS MENSUELLES </h5>";
                    }
                    ?>

                    <!-- JavaScript to trigger form submission on change -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var form = document.getElementById("monthlyConsumptionForm");
                            var hiddenSubmitButton = document.getElementById("hiddenSubmitButton");

                            form.addEventListener("change", function () {
                                // Trigger form submission when the user selects a month and year
                                hiddenSubmitButton.click();
                            });
                        });
                    </script>
                    </div>
                    </center>
                </div>
            </div>
            <div class="mtop"></div>
            <div class="row">
                <div class="col-lg-6">
                    <center>
                        <div id="statclients">
                        <?php
                            $connn3 = $conn->prepare("SELECT SUM(`consom_mensuelle`) as somme FROM `consommation_mensuelle` WHERE statut = 'non paye' AND ID_Fournisseur = :userId");
                            $connn3->bindParam(':userId', $userId, PDO::PARAM_INT);
                            $connn3->execute();
                            $result = $connn3->fetch(PDO::FETCH_ASSOC);
                            $countValue3 = $result['somme'];
                            
                            echo "<br><br><h5><b class=\"bold\">" . $countValue3 . " MAD </b><br> FACTURES NON PAYES </h5>";
                        ?>
                        </div>
                    </center>
                </div>
                <div class="col-lg-6">
                    <center>
                        <div id="statclients">
                        <?php
                            $connn2 = $conn->prepare("SELECT COUNT(*) as count2 FROM `reclamation` WHERE statut = 'En cours' AND ID_Fournisseur = :userId");
                            $connn2->bindParam(':userId', $userId, PDO::PARAM_INT);
                            $connn2->execute();
                            $result = $connn2->fetch(PDO::FETCH_ASSOC);
                            $countValue2 = $result['count2'];
                            
                            echo "<br><br><h5><b class=\"bold\">" . $countValue2 . "</b><br> RECLAMATIONS NON TRAITES </h5>";
                        
                        ?>
                        </div>
                    </center>
                </div>
            </div>
        </div>
      </div>

    <div class="mtop"></div>
      <div class="mtop"></div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
