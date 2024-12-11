<?php
session_start();
// Connexion à la base de données
require('connexion.php');  // Remplace par ton fichier de connexion à la DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $matricule = $_POST['matricule'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $contact = $_POST['contact'];  // Récupération du contact

    // Hachage du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        // Commencer une transaction pour garantir la cohérence
        $pdo->beginTransaction();

        // Mise à jour des informations dans la table `etudiants`
        $sqlEtudiant = "UPDATE etudiants SET email = :email, mot_de_passe = :mot_de_passe, contact = :contact WHERE matricule = :matricule";
        $stmtEtudiant = $pdo->prepare($sqlEtudiant);
        $stmtEtudiant->bindParam(':email', $email);
        $stmtEtudiant->bindParam(':mot_de_passe', $mot_de_passe_hash);
        $stmtEtudiant->bindParam(':contact', $contact);
        $stmtEtudiant->bindParam(':matricule', $matricule);

        // Exécuter la mise à jour
        $stmtEtudiant->execute();

        // Vérifier si une ligne a été mise à jour
        if ($stmtEtudiant->rowCount() === 0) {
            // Si aucune ligne n'a été mise à jour, vérifier dans `utilisateurs`
            $sqlUtilisateur = "SELECT * FROM utilisateurs WHERE identifiant = :matricule";
            $stmtUtilisateur = $pdo->prepare($sqlUtilisateur);
            $stmtUtilisateur->bindParam(':matricule', $matricule);
            $stmtUtilisateur->execute();

            $utilisateur = $stmtUtilisateur->fetch();

            if ($utilisateur) {
                // Si le matricule est trouvé dans la table `utilisateurs`, insérer les informations
                $sqlInsertUtilisateur = "UPDATE utilisateurs SET email = :email, mot_de_passe = :mot_de_passe, contact = :contact WHERE identifiant = :matricule";
                $stmtInsertUtilisateur = $pdo->prepare($sqlInsertUtilisateur);
                $stmtInsertUtilisateur->bindParam(':email', $email);
                $stmtInsertUtilisateur->bindParam(':mot_de_passe', $mot_de_passe_hash);
                $stmtInsertUtilisateur->bindParam(':contact', $contact);
                $stmtInsertUtilisateur->bindParam(':matricule', $matricule);
                $stmtInsertUtilisateur->execute();
            } else {
                // Si le matricule n'est trouvé nulle part
                throw new Exception("Matricule introuvable dans les tables `etudiants` et `utilisateurs`.");
            }
        }

        // Validation de la transaction
        $pdo->commit();

        // Redirection vers la page de connexion
        header('Location: formulaire_connexion.php');
        exit;

    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        echo "Erreur : " . $e->getMessage();
    }
}
?>

