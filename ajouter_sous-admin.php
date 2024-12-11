<?php
// Inclure le fichier de connexion
require_once 'connexion.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le champ 'identifiant' est défini et non vide
    if (isset($_POST['identifiant']) && !empty(trim($_POST['identifiant']))) {
        // Sécuriser les données
        $identifiant = trim($_POST['identifiant']);

        try {
            // Préparer la requête d'insertion
            $query = $pdo->prepare("INSERT INTO utilisateurs (identifiant) VALUES (:identifiant)");
            $query->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);

            // Exécuter la requête
            if ($query->execute()) {
                // Redirection avec un message de succès
                header("Location: page_admin.php?success=Identifiant ajouté avec succès");
                exit();
            } else {
                echo "Erreur lors de l'ajout de l'identifiant.";
            }
        } catch (PDOException $e) {
            // Gérer les erreurs PDO
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Message d'erreur si le champ est vide
        echo "Veuillez entrer l'identifiant.";
    }
}
?>
