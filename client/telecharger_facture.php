<?php

    session_start();

    // Récupérer les informations de la session
    $ID_Consommation = $_POST['ID_Consommation'];
    $mois = $_POST['mois'];
    $annee = $_POST['annee'];
    $photo_compteur = $_POST['photo_compteur'];
    $consom_mensuelle = $_POST['consom_mensuelle'];
    $cm5 = $consom_mensuelle;
    $statut = $_POST['statut'];
    $date_saisie = $_POST['date_saisie'];
    $ID_Client = $_POST['ID_Client'];
    $ID_Fournisseur = $_POST['ID_Fournisseur'];

    require('tcpdf.php');

    // Créer une instance de la classe TCPDF
    $pdf = new TCPDF();

    // Ajouter une page au PDF
    $pdf->AddPage();

    $html = '<div style="background-color:#219499; height: 75px;"></div>';

    // Ajouter le logo dans la facture en premier
    $logoPath = '../assets/images/electrica.png';
    $pdf->Image($logoPath, 75, 20, 60, 38, 'PNG');

    // Construire le contenu HTML pour la facture

    $html .= '<br><br><br><br><br><br><br>';
    $html .= '<h1 style="text-align:center; font-size:20px; color:#219499;">Facture</h1>';
    $html .= '<br><p style="text-align:center; font-size:14px; font-weight:bold;">VOICI LES DETAILS DE VOTRE FACTURE:</p>';
    $html .= '<br><br>';
    $html .= '<body style = "background-color: whitesmoke;">';

    $html .= '<table border = "1" style="width: 100%; border-collapse: collapse;">';
    
    $html .= '<tr>';
    $html .= '<th style="width: 50%; font-weight:bold; height:30px;">NO.DE CONSOMMATION:</th>';
    $html .= '<td style="width: 50%;">' . $ID_Consommation . '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<th style="width: 50%; font-weight:bold; height:30px;">MOIS:</th>';
    $html .= '<td style="width: 50%;">' . $mois . '</td>';

    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<th style="width: 50%; font-weight:bold; height:30px;">ANNEE:</th>';
    $html .= '<td style="width: 50%;">' . $annee . '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<th style="width: 50%; font-weight:bold; height:30px;">CONSOMMATION MENSUELLE:</th>';
    $html .= '<td style="width: 50%;">' . $consom_mensuelle . '</td>';
    $html .= '</tr>';
    
    if($cm5>=0 && $cm5<=100){
        $cm5_1 = $cm5 * 0.8;
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">PRIX HT:</th>';
        $html .= '<td style="width: 50%;">' . $cm5_1 . ' MAD' . '</td>';
        $html .= '</tr>';
        $cm5_11 = $cm5_1+$cm5_1*0.14;
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">PRIX TTC:</th>';
        $html .= '<td style="width: 50%;">' . $cm5_11. ' MAD' . '</td>';
        $html .= '</tr>';
    }
    else if($cm5>=101 && $cm5<=200){
        $cm5_2 = $cm5 * 0.9;
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">PRIX HT:</th>';
        $html .= '<td style="width: 50%;">' . $cm5_2. ' MAD' . '</td>';
        $html .= '</tr>';
        $cm5_22 = $cm5_2+$cm5_2*0.14;
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">PRIX TTC:</th>';
        $html .= '<td style="width: 50%;">' . $cm5_22. ' MAD' . '</td>';
        $html .= '</tr>';
    }
    else if($cm5>=201){
        $cm5_3 = $cm5 * 1.0;
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">PRIX HT:</th>';
        $html .= '<td style="width: 50%;">' . $cm5_3. ' MAD' . '</td>';
        $html .= '</tr>';
        $cm5_33 = $cm5_3+$cm5_3*0.14;
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">PRIX TTC:</th>';
        $html .= '<td style="width: 50%;">' . $cm5_33. ' MAD' . '</td>';
        $html .= '</tr>';
    }

    if($statut == 'non paye'){

        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">STATUT:</th>';
        $html .= '<td style="width: 50%;">' . $statut . '</td>';
        $html .= '</tr>';
    
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">APROPOS DE PAIEMENT:</th>';
        $html .= '<td style="width: 50%;"><b style="color:red;">Vous devez payer votre facture! </b></td>';
        $html .= '</tr>';

    }
    else if($statut == 'paye'){

        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">STATUT:</th>';
        $html .= '<td style="width: 50%;">' . $statut . '</td>';
        $html .= '</tr>';
    
        $html .= '<tr>';
        $html .= '<th style="width: 50%; font-weight:bold; height:30px;">APROPOS DE PAIEMENT:</th>';
        $html .= '<td style="width: 50%;"><b style="color:green;">Vous avez deja paye votre facture! </b></td>';
        $html .= '</tr>';
    
    }

    $html .= '<tr>';
    $html .= '<th style="width: 50%; font-weight:bold; height:30px;">DATE DE SAISIE:</th>';
    $html .= '<td style="width: 50%;">' . $date_saisie . '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<th style="width: 50%; font-weight:bold; height:30px;">NO.DE CLIENT:</th>';
    $html .= '<td style="width: 50%;">' . $ID_Client . '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<th style="width: 50%; font-weight:bold; height:160px;">PHOTO DU COMPTEUR:</th>';
    $html .= '</tr>';

    $html .= '</table>';
    $html .= '<br>';
    $html .= '<div style="background-color:#219499; height: 75px;"></div>';

    $imagePath = $photo_compteur;

    // Obtenez les informations sur le chemin du fichier
    $pathInfo = pathinfo($imagePath);

    // Obtenez l'extension du fichier
    $extension = strtolower($pathInfo['extension']);

    // Vérifiez l'extension du fichier et prenez des décisions en conséquence
    if ($extension == 'jpg' || $extension == 'jpeg') {
        $pdf->Image($imagePath, 125, 200, 50, 50, 'JPEG');
    } elseif ($extension == 'png') {
        $pdf->Image($imagePath, 125, 200, 50, 50, 'PNG');
    }

    $html .= '</body>';

    // Ajouter le code HTML au PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Sauvegarder le PDF ou le renvoyer au navigateur
    $pdf->Output('Facture.pdf', 'D');

?>
