<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Destruction de la session
        session_destroy();
    
        // Redirection vers la page de connexion
        header('Location: ../login.php');
        exit();
    }