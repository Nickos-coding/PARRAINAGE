<?php
// Connexion à la base de données
include 'connexion.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $filiere_parrain = $_POST['filiere_parrain'];
    $niveau_parrain = $_POST['niveau_parrain'];
    $niveau_filleul = $_POST['niveau_filleul'];

    // Mettre à jour les étudiants pour leur attribuer les rôles de parrain et de filleul
    $stmt = $pdo->prepare("UPDATE etudiants SET type_parrainage = 'parrain' WHERE filiere_id = ? AND niveau_id = ?");
    $stmt->execute([$filiere_parrain, $niveau_parrain]);

    $stmt = $pdo->prepare("UPDATE etudiants SET type_parrainage = 'filleul' WHERE filiere_id = ? AND niveau_id = ?");
    $stmt->execute([$filiere_parrain, $niveau_filleul]);

    // Récupérer les parrains et les filleuls
    $parrains = $pdo->query("SELECT * FROM etudiants WHERE type_parrainage = 'parrain' AND filiere_id = {$filiere_parrain} AND niveau_id = {$niveau_parrain}")->fetchAll(PDO::FETCH_ASSOC);
    $filleuls = $pdo->query("SELECT * FROM etudiants WHERE type_parrainage = 'filleul' AND filiere_id = {$filiere_parrain} AND niveau_id = {$niveau_filleul}")->fetchAll(PDO::FETCH_ASSOC);

    if (empty($parrains) || empty($filleuls)) {
        die("Aucun parrain ou filleul disponible pour l'attribution.");
    }

    // Mélanger les listes
    shuffle($parrains);
    shuffle($filleuls);

    // Initialisation des relations
    $relations = [];
    $parrains_pour_second_tour = [];

    // Attribution des parrains et des filleuls
    while (!empty($filleuls)) {
        foreach ($parrains as $parrain) {
            if (empty($filleuls)) break;

            $filleul = array_shift($filleuls);
            $relations[] = [
                'parrain_id' => $parrain['idetu'],
                'filleul_id' => $filleul['idetu']
            ];

            $parrains_pour_second_tour[] = $parrain;
        }

        if (!empty($filleuls)) {
            shuffle($parrains_pour_second_tour);
            $parrains = $parrains_pour_second_tour;
            $parrains_pour_second_tour = [];
        }
    }

    $stmt = $pdo->prepare("INSERT INTO parrainages (parrain_id, filleul_id) VALUES (:parrain_id, :filleul_id)");
    foreach ($relations as $relation) {
        $stmt->execute([
            ':parrain_id' => $relation['parrain_id'],
            ':filleul_id' => $relation['filleul_id']
        ]);
    }

    $pdo->query("UPDATE etudiants SET type_parrainage = NULL");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du Parrainage</title>
    <link rel="stylesheet" href="css/parrainage.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>

    <div class="container">
        <h1>Attribution des Parrains et Filleuls</h1>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
            <p class="success-message">Les relations de parrainage ont été attribuées avec succès !</p>
            
            <!-- Formulaire de recherche -->
            <div class="search-container">
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher un étudiant...">
            </div>
            
            <!-- Tableau des Parrains et Filleuls -->
            <table id="parrainageTable" border="1">
                <thead>
                    <tr>
                        <th>Parrain</th>
                        <th>Filleuls</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Regrouper les filleuls par parrain
                    $parrains_filleuls = [];
                    foreach ($relations as $relation) {
                        $parrain = $pdo->query("SELECT * FROM etudiants WHERE idetu = {$relation['parrain_id']}")->fetch(PDO::FETCH_ASSOC);
                        $filleul = $pdo->query("SELECT * FROM etudiants WHERE idetu = {$relation['filleul_id']}")->fetch(PDO::FETCH_ASSOC);
                        
                        if (!isset($parrains_filleuls[$parrain['idetu']])) {
                            $parrains_filleuls[$parrain['idetu']] = [
                                'parrain' => $parrain['nom'] . ' ' . $parrain['prenom'],
                                'filleuls' => []
                            ];
                        }

                        $parrains_filleuls[$parrain['idetu']]['filleuls'][] = $filleul['nom'] . ' ' . $filleul['prenom'];
                    }

                    foreach ($parrains_filleuls as $parrain_data) {
                        echo "<tr><td>{$parrain_data['parrain']}</td><td><ul>";
                        foreach ($parrain_data['filleuls'] as $filleul) {
                            echo "<li>- $filleul</li>";
                        }
                        echo "</ul></td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Boutons -->
            <div class="button-container">
                <button onclick="window.print()">Imprimer</button>
                <button onclick="validerParrainage()">Valider</button>
            </div>
        <?php } ?>
    </div>
    <!-- Bouton de retour à la page d'administration -->
        <div class="return-container">
            <a href="page_adminCOM.php" class="return-link">Revenir à la page d'administration</a>
        </div>

<script src="js/attribution.js"></script>
</body>
</html>
