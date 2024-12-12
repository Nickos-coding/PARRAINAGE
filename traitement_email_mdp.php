<?php
session_start();
// Connexion à la base de données
require_once 'connexion.php'; // Assurez-vous que $conn (MySQLi) est défini dans ce fichier

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $matricule = $_POST['matricule'] ?? '';
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $contact = $_POST['contact'] ?? '';

    if (!empty($matricule) && !empty($email) && !empty($mot_de_passe) && !empty($contact)) {
        // Hachage du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Commencer une transaction MySQLi
        $conn->begin_transaction();

        try {
            // Mise à jour des informations dans la table `etudiants`
            $sqlEtudiant = "UPDATE etudiants SET email = ?, mot_de_passe = ?, contact = ? WHERE matricule = ?";
            $stmtEtudiant = $conn->prepare($sqlEtudiant);
            $stmtEtudiant->bind_param("ssss", $email, $mot_de_passe_hash, $contact, $matricule);

            // Exécuter la mise à jour
            $stmtEtudiant->execute();

            // Vérifier si une ligne a été mise à jour
            if ($stmtEtudiant->affected_rows === 0) {
                // Si aucune ligne n'a été mise à jour, vérifier dans `utilisateurs`
                $sqlUtilisateur = "SELECT * FROM utilisateurs WHERE identifiant = ?";
                $stmtUtilisateur = $conn->prepare($sqlUtilisateur);
                $stmtUtilisateur->bind_param("s", $matricule);
                $stmtUtilisateur->execute();
                $resultUtilisateur = $stmtUtilisateur->get_result();

                if ($resultUtilisateur->num_rows > 0) {
                    // Mise à jour des informations dans la table `utilisateurs`
                    $sqlUpdateUtilisateur = "UPDATE utilisateurs SET email = ?, mot_de_passe = ?, contact = ? WHERE identifiant = ?";
                    $stmtUpdateUtilisateur = $conn->prepare($sqlUpdateUtilisateur);
                    $stmtUpdateUtilisateur->bind_param("ssss", $email, $mot_de_passe_hash, $contact, $matricule);
                    $stmtUpdateUtilisateur->execute();

                    if ($stmtUpdateUtilisateur->affected_rows === 0) {
                        throw new Exception("Impossible de mettre à jour les informations dans la table `utilisateurs`.");
                    }
                } else {
                    throw new Exception("Matricule introuvable dans les tables `etudiants` et `utilisateurs`.");
                }
            }

            // Valider la transaction
            $conn->commit();

            // Redirection vers la page de connexion
            header('Location: formulaire_connexion.php');
            exit;
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            $conn->rollback();
            echo "<p style='color: red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Veuillez remplir tous les champs.</p>";
    }
}
?>
