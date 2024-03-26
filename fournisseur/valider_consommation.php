<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['ID_Fournisseur'])) {
    header('Location: login.php'); // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    exit();
}

try {
    // Nouvelle connexion à la base de données
    $conn = new PDO('mysql:host=localhost;port=3308;dbname=electricabillhub;charset=utf8mb4;', 'root', '');

    // Récupérez l'ID_Consommation à partir de la requête GET
    $ID_Consommation = $_GET['id'];

    // Mettez à jour la valeur de etat_consom à "valide"
    $updateQuery = $conn->prepare("UPDATE `consommation_mensuelle` SET statut = 'paye', etat_consom = 'valide' WHERE ID_Consommation = :ID_Consommation");
    $updateQuery->bindParam(':ID_Consommation', $ID_Consommation, PDO::PARAM_INT);
    $updateQuery->execute();

    // Redirigez l'utilisateur vers la page précédente avec un message de succès
    $_SESSION['success_message'] = 'La consommation a été validée avec succès.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} catch (PDOException $e) {
    $_SESSION['failure_message'] = 'Erreur lors de la validation de la consommation: ' . $e->getMessage();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
