<?php
// Fichier : process_rencontre.php

// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'parrainage_db';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $destinataire = $conn->real_escape_string($_POST['destinataire']);
    $details = $conn->real_escape_string($_POST['details']);

    // Vérification des champs
    if (!empty($destinataire) && !empty($details)) {
        // Insérer les données dans la table des rencontres
        $sql = "INSERT INTO rencontres (destinataire, details, date_creation) VALUES ('$destinataire', '$details', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "Rencontre enregistrée avec succès.";
        } else {
            echo "Erreur : " . $conn->error;
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

$conn->close();
?>
