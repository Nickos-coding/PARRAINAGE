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
            $query = "INSERT INTO etudiants (matricule, nom, prenom, telephone, id_filiere, id_niveau) 
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
                echo "L'étudiant a été ajouté avec succès !";
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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Étudiant</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/page_admin.css">
</head>
<body>
    <header>
        <!-- Logo -->
        <div class="logo">
            <img src="image/sp2a.png" alt="Logo">
        </div>
        <nav class="nav-links">
            <ul>
                <li><a href="page_admin.php" class="menu-link">Retour à l'accueil</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Ajouter un Étudiant</h2>
        <form method="POST" action="ajouter_etudiants.php">
            <label for="matricule">Matricule :</label>
            <input type="text" id="matricule" name="matricule" placeholder="Entrer le matricule" required><br><br>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Entrer le nom" required><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrer le prénom" required><br><br>

            <label for="telephone">Numéro de téléphone :</label>
            <input type="tel" id="telephone" name="telephone" pattern="\d{10}" title="Veuillez entrer 10 chiffres uniquement" maxlength="10" placeholder="Exemple : 0123456789" required><br><br>

            <label for="filiere">Filière :</label>
            <select id="filiere" name="filiere" required>
                <option value="">Choisir une filière</option>
                <?php
                // Sélectionner les filières dans la base de données
                $filieres = $pdo->query("SELECT * FROM filieres")->fetchAll();
                foreach ($filieres as $filiere) {
                    echo "<option value='{$filiere['idfil']}'>{$filiere['nom_filiere']}</option>";
                }
                ?>
            </select><br><br>

            <label for="niveau">Niveau :</label>
            <select id="niveau" name="niveau" required>
                <option value="">Choisir un niveau</option>
                <?php
                // Sélectionner les niveaux dans la base de données
                $niveaux = $pdo->query("SELECT * FROM niveaux")->fetchAll();
                foreach ($niveaux as $niveau) {
                    echo "<option value='{$niveau['idniv']}'>{$niveau['nom_niveau']}</option>";
                }
                ?>
            </select><br><br>

            <button type="submit" name="ajouter_etudiant">Ajouter l'étudiant</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 SYGES PROPUS - Tous droits réservés</p>
    </footer>
</body>
</html>
