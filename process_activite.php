<?php
// Fichier : process_activite.php

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
    $activite = $conn->real_escape_string($_POST['activite']);

    // Vérification des champs
    if (!empty($activite)) {
        // Insérer les données dans la table des activités
        $sql = "INSERT INTO activites (description, date_creation) VALUES ('$activite', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "Activité enregistrée avec succès.";
        } else {
            echo "Erreur : " . $conn->error;
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

$conn->close();
?>
