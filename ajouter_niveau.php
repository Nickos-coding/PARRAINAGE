<?php
// Inclure le fichier de connexion
require_once 'connexion.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le champ 'nom_niveau' est défini et non vide
    if (isset($_POST['nom_niveau']) && !empty(trim($_POST['nom_niveau']))) {
        // Sécuriser les données
        $nom_niveau = trim($_POST['nom_niveau']);

        try {
            // Préparer la requête d'insertion
            $query = $pdo->prepare("INSERT INTO niveaux (nom_niveau) VALUES (:nom_niveau)");
            $query->bindParam(':nom_niveau', $nom_niveau, PDO::PARAM_STR);

            // Exécuter la requête
            if ($query->execute()) {
                // Redirection avec un message de succès
                header("Location: page_admin.php?success=Niveau ajouté avec succès");
                exit();
            } else {
                echo "Erreur lors de l'ajout du niveau.";
            }
        } catch (PDOException $e) {
            // Gérer les erreurs PDO
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Message d'erreur si le champ est vide
        echo "Veuillez entrer un nom de niveau.";
    }
}
?>
