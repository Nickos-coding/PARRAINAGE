<?php
// Inclure le fichier de connexion
require_once 'connexion.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le champ 'nom_filiere' est défini et non vide
    if (isset($_POST['nom_filiere']) && !empty(trim($_POST['nom_filiere']))) {
        // Sécuriser les données
        $nom_filiere = trim($_POST['nom_filiere']);

        try {
            // Préparer la requête d'insertion
            $query = $pdo->prepare("INSERT INTO filieres (nom_filiere) VALUES (:nom_filiere)");
            $query->bindParam(':nom_filiere', $nom_filiere, PDO::PARAM_STR);

            // Exécuter la requête
            if ($query->execute()) {
                // Redirection avec un message de succès
                header("Location: page_admin.php?success=Filière ajoutée avec succès");
                exit();
            } else {
                echo "Erreur lors de l'ajout de la filière.";
            }
        } catch (PDOException $e) {
            // Gérer les erreurs PDO
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Message d'erreur si le champ est vide
        echo "Veuillez entrer un nom de filière.";
    }
}
?>
