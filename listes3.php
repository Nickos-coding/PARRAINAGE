<?php
// Connexion à la base de données
require_once 'connexion.php';

// Récupérer les critères de recherche
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : 3;'';
$niveau = isset($_GET['niveau']) ? $_GET['niveau'] : '';

// Construire la requête SQL avec filtres
$query = "SELECT etudiants.*, filieres.nom_filiere, niveaux.nom_niveau
          FROM etudiants
          LEFT JOIN filieres ON etudiants.filiere_id = filieres.idfil
          LEFT JOIN niveaux ON etudiants.niveau_id = niveaux.idniv
          WHERE 1"; // Le "WHERE 1" permet de simplifier l'ajout des conditions suivantes

if ($filiere) {
    $query .= " AND etudiants.filiere_id = $filiere"; // Utilisation de 'filiere_id'
}
if ($niveau) {
    $query .= " AND etudiants.niveau_id = $niveau"; // Utilisation de 'niveau_id'
}

// Exécuter la requête
$students = $pdo->query($query)->fetchAll();

$queryNiveaux = "SELECT * FROM niveaux";
$niveaux = $pdo->query($queryNiveaux)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="css/listes.css">
</head>
<body>
    
    <!-- Formulaire de filtrage -->
    <main>
        <!-- Lien pour aller directement à la fin de la page -->
        <a href="#end" class="scroll-to-end">⬅</a><h1>Liste des étudiants</h1>

        
        

        <form action="listes3.php" method="GET" class="form-container">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher par nom ou prénom" value="">
            
            
            <select name="niveau">
                <option value="">-- Choisir un niveau --</option>
                <?php foreach ($niveaux as $niveauOption): ?>
                    <option value="<?php echo $niveauOption['idniv']; ?>" <?php echo ($niveau == $niveauOption['idniv']) ? 'selected' : ''; ?>>
                        <?php echo $niveauOption['nom_niveau']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Filtrer</button>
        </form>

        <!-- Tableau des étudiants -->
        <table id="studentsTable">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Filière</th>
                    <th>Niveau</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['matricule']); ?></td>
                            <td><?php echo htmlspecialchars($student['nom']); ?></td>
                            <td><?php echo htmlspecialchars($student['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($student['nom_filiere']); ?></td>
                            <td><?php echo htmlspecialchars($student['nom_niveau']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucun étudiant trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Bouton retour à la page admin -->
        <div class="admin-back" id="end">
            <a href="page_adminANG.php" class="btn-back">Retour au tableau de bord</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Votre site de gestion des étudiants</p>
    </footer>

    <script src="js/listes.js"></script>
</body>
</html>
