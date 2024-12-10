<?php
session_start();
// Connexion à la base de données
require('connexion.php');  // Remplace par ton fichier de connexion à la DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération du matricule
    $matricule = $_POST['matricule'];

    // Vérifier si le matricule existe dans la base de données
    $sql = "SELECT * FROM etudiants WHERE matricule = :matricule";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricule', $matricule);
    $stmt->execute();

    $etudiant = $stmt->fetch();

    if ($etudiant) {
        // Si le matricule existe, rediriger vers le formulaire pour entrer l'email et le mot de passe
        header('Location: formulaire_email_mdp.php?matricule=' . $matricule);  // Passer le matricule via l'URL
        exit;
    } else {
        // Si le matricule n'existe pas, afficher un message d'erreur
        echo "Matricule non trouvé. Veuillez vérifier et réessayer.";
    }
}
?>
