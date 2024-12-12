<?php
// Connexion à la base de données
require_once 'connexion.php';

// Vérifier si un filtre de filière est passé en paramètre, sinon récupérer toutes les filières
$filiere_id = isset($_GET['filiere_id']) ? $_GET['filiere_id'] : 1;

// Requête pour récupérer les parrains et filleuls avec leur filière et niveau
$sql = "
    SELECT 
        p.idpar AS parrainage_id,
        etu_parrain.nom AS parrain_nom,
        etu_parrain.prenom AS parrain_prenom,
        etu_filleul.nom AS filleul_nom,
        etu_filleul.prenom AS filleul_prenom,
        f.nom_filiere,
        n1.nom_niveau AS niveau_parrain,
        n2.nom_niveau AS niveau_filleul
    FROM parrainages p
    JOIN etudiants etu_parrain ON etu_parrain.idetu = p.parrain_id
    JOIN etudiants etu_filleul ON etu_filleul.idetu = p.filleul_id
    JOIN filieres f ON f.idfil = etu_parrain.filiere_id
    JOIN niveaux n1 ON n1.idniv = etu_parrain.niveau_id
    JOIN niveaux n2 ON n2.idniv = etu_filleul.niveau_id
    WHERE (:filiere_id IS NULL OR f.idfil = :filiere_id)
    ORDER BY f.nom_filiere, n1.nom_niveau, etu_parrain.nom, etu_filleul.nom;
";

// Préparer la requête SQL
$stmt = $pdo->prepare($sql);

// Lier le paramètre `filiere_id` si nécessaire
$stmt->bindParam(':filiere_id', $filiere_id, PDO::PARAM_INT);

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$parrainages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les Parrainages</title>
    <link rel="stylesheet" href="css/voir_parrainages.css">
</head>
<body>

    <!-- Filtrage par filière -->
    <div class="filter">
        <form method="GET" action="voir_parrainageIGL.php">
            <label for="filiere_id">Sélectionner une filière : </label>
            <select name="filiere_id" id="filiere_id">
                <option value="">Toutes les filières</option>
                <?php
                // Récupérer les filières pour le menu déroulant
                $filiere_stmt = $pdo->query("SELECT idfil, nom_filiere FROM filieres");
                while ($filiere = $filiere_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = $filiere['idfil'] == $filiere_id ? 'selected' : '';
                    echo "<option value=\"{$filiere['idfil']}\" $selected>{$filiere['nom_filiere']}</option>";
                }
                ?>
            </select>
            <button type="submit">Filtrer</button>
        </form>
    </div>

    <!-- Champ de recherche -->
    <div class="search-bar">
        <label for="search">Rechercher : </label>
        <input type="text" id="search" oninput="searchTable()" placeholder="Nom ou prénom...">
    </div>

    <h1>Liste des Parrainages</h1>

    <!-- Tableau des parrainages -->
    <table>
        <thead>
            <tr>
                <th>Nom du Parrain</th>
                <th>Prénom du Parrain</th>
                <th>Nom du Filleul</th>
                <th>Prénom du Filleul</th>
                <th>Niveau du Parrain</th>
                <th>Niveau du Filleul</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($parrainages) > 0): ?>
                <?php foreach ($parrainages as $parrainage): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($parrainage['parrain_nom']); ?></td>
                        <td><?php echo htmlspecialchars($parrainage['parrain_prenom']); ?></td>
                        <td><?php echo htmlspecialchars($parrainage['filleul_nom']); ?></td>
                        <td><?php echo htmlspecialchars($parrainage['filleul_prenom']); ?></td>
                        <td><?php echo htmlspecialchars($parrainage['niveau_parrain']); ?></td>
                        <td><?php echo htmlspecialchars($parrainage['niveau_filleul']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun parrainage trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="admin-back">
        <a href="page_adminIGL.php" class="btn-back">Retour au tableau de bord</a>
    </div>

<script src="js/voir_parrainage.js"></script>
</body>
</html>
