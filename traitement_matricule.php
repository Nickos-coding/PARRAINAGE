<?php
session_start();
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// Vérifier si la connexion à la base de données a été établie
if (!isset($conn) || $conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération du matricule saisi par l'utilisateur
    $matricule = $_POST['matricule'] ?? '';

    if (!empty($matricule)) {
        // Échapper le matricule pour éviter les injections SQL
        $matricule = $conn->real_escape_string($matricule);

        // Vérification dans la table des étudiants
        $sqlEtudiant = "SELECT * FROM etudiants WHERE matricule = ?";
        $stmtEtudiant = $conn->prepare($sqlEtudiant);
        $stmtEtudiant->bind_param("s", $matricule);
        $stmtEtudiant->execute();
        $resultEtudiant = $stmtEtudiant->get_result();

        if ($resultEtudiant->num_rows > 0) {
            // Si le matricule est trouvé dans la table des étudiants
            header('Location: formulaire_email_mdp.php?matricule=' . urlencode($matricule));
            exit;
        }

        // Si le matricule n'est pas trouvé, vérifier dans la table utilisateurs
        $sqlUtilisateur = "SELECT * FROM utilisateurs WHERE identifiant = ?";
        $stmtUtilisateur = $conn->prepare($sqlUtilisateur);
        $stmtUtilisateur->bind_param("s", $matricule);
        $stmtUtilisateur->execute();
        $resultUtilisateur = $stmtUtilisateur->get_result();

        if ($resultUtilisateur->num_rows > 0) {
            // Si le matricule est trouvé dans la table des utilisateurs
            header('Location: formulaire_email_mdp.php?matricule=' . urlencode($matricule));
            exit;
        }

        // Matricule introuvable dans les deux tables
        echo "<p style='color: red;'>Matricule introuvable dans les bases de données.</p>";
    } else {
        echo "<p style='color: red;'>Veuillez saisir un matricule.</p>";
    }
}
?>
