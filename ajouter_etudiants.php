<?php
// Inclusion de la connexion à la base de données
require_once 'connexion.php';

// Vérifier si le formulaire a été soumis
if (isset($_POST['ajouter_etudiant'])) {
    // Récupération des valeurs du formulaire
    $matricule = htmlspecialchars($_POST['matricule']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $filiere = intval($_POST['filiere']);
    $niveau = intval($_POST['niveau']);

    // Validation des champs
    if (!empty($matricule) && !empty($nom) && !empty($prenom) && !empty($telephone) && !empty($filiere) && !empty($niveau)) {
        try {
            // Préparation de la requête d'insertion
            $query = "INSERT INTO etudiants (matricule, nom, prenom, contact, filiere_id, niveau_id) 
                      VALUES (:matricule, :nom, :prenom, :telephone, :filiere, :niveau)";
            $stmt = $pdo->prepare($query);

            // Liaison des paramètres
            $stmt->bindParam(':matricule', $matricule);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':filiere', $filiere);
            $stmt->bindParam(':niveau', $niveau);

            // Exécution de la requête
            if ($stmt->execute()) {
                exit();
            } else {
                echo "Une erreur s'est produite lors de l'ajout de l'étudiant.";
            }
        } catch (PDOException $e) {
            // Gestion des erreurs de base de données
            echo "Erreur de connexion ou d'exécution : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>
