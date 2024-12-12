<?php
// Connexion à la base de données
include 'connexion.php';

// Récupérer les filières et les niveaux
$filiere_query = $pdo->query("SELECT * FROM filieres where idfil = 2"); // Récupérer toutes les filières
$filieres = $filiere_query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les niveaux
$niveau_query = $pdo->query("SELECT * FROM niveaux"); // Récupérer tous les niveaux
$niveaux = $niveau_query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Parrainage</title>
    <link rel="stylesheet" href="css/formulaire_parrainage.css"> <!-- Lien vers le fichier CSS spécifique -->
</head>
<body>

    <div class="container">
        <h1>Formulaire de Parrainage</h1>

        <form action="attribution_parrainageSEG.php" method="POST">
            <label for="filiere">Filière</label>
            <select name="filiere_parrain" id="filiere" required>
                <?php foreach ($filieres as $filiere) { ?>
                    <option value="<?= $filiere['idfil'] ?>"><?= $filiere['nom_filiere'] ?></option>
                <?php } ?>
            </select>

            <label for="niveau_parrain">Niveau du Parrain</label>
            <select name="niveau_parrain" id="niveau_parrain" required>
                <option value="">Sélectionnez le niveau du parrain</option>
                <?php foreach ($niveaux as $niveau) { ?>
                    <option value="<?= $niveau['idniv'] ?>"><?= $niveau['nom_niveau'] ?></option>
                <?php } ?>
            </select>

            <label for="niveau_filleul">Niveau du Filleul</label>
            <select name="niveau_filleul" id="niveau_filleul" required>
                <option value="">Sélectionnez le niveau du filleul</option>
                <?php foreach ($niveaux as $niveau) { ?>
                    <option value="<?= $niveau['idniv'] ?>"><?= $niveau['nom_niveau'] ?></option>
                <?php } ?>
            </select>

            <button type="submit">Attribuer Parrainage</button>
        </form>
    </div>

</body>
</html>
