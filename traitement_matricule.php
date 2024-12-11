<?php
session_start();
// Connexion à la base de données
require('connexion.php');  // Remplace par ton fichier de connexion à la DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération du matricule saisi par l'utilisateur
    $matricule = $_POST['matricule'];

    try {
        // Vérification dans la table des étudiants
        $sqlEtudiant = "SELECT * FROM etudiants WHERE matricule = :matricule";
        $stmtEtudiant = $pdo->prepare($sqlEtudiant);
        $stmtEtudiant->bindParam(':matricule', $matricule);
        $stmtEtudiant->execute();

        $etudiant = $stmtEtudiant->fetch();

        if ($etudiant) {
            // Si le matricule est trouvé dans la table des étudiants
            header('Location: formulaire_email_mdp.php?matricule=' . $matricule);
            exit;
        } else {
            // Si le matricule n'est pas trouvé, vérifier dans la table utilisateurs
            $sqlUtilisateur = "SELECT * FROM utilisateurs WHERE identifiant = :matricule";
            $stmtUtilisateur = $pdo->prepare($sqlUtilisateur);
            $stmtUtilisateur->bindParam(':matricule', $matricule);
            $stmtUtilisateur->execute();

            $utilisateur = $stmtUtilisateur->fetch();

            if ($utilisateur) {
                // Si le matricule est trouvé dans la table des utilisateur
                header('Location: formulaire_email_mdp.php?matricule=' . $matricule);
                exit;
            } else {
                // Si le matricule est introuvable dans les deux tables
                echo "Matricule introuvable dans les bases de données.";
            }
        }
    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur de base de données : " . $e->getMessage();
    }
}
?>
