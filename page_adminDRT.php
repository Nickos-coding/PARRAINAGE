<?php
session_start();

include 'connexion.php'; // Inclusion du fichier de connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: formulaire_connexion.php'); // Rediriger vers la page de connexion si non connecté
    exit();
}

$email = $_SESSION['email'];

// Préparer une requête pour vérifier si l'email existe dans la table `users` avec PDO
try {
    $stmt = $pdo->prepare("SELECT email FROM utilisateurs WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        // Si l'email n'existe pas dans la table, rediriger vers la page d'accueil
        header('Location: index.php');
        exit();
    }

    // Si l'email est valide, l'accès est autorisé
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message générique et loguer l'erreur
    error_log("Erreur de requête : " . $e->getMessage());
    die("Une erreur est survenue. Veuillez réessayer plus tard.");
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SYGES PROPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/page_admin.css">
</head>
<body>
    
    <header>
        <!-- Logo -->
        <div class="logo">
            <img src="./image/UIYA.png" alt=""> <!-- Remplacement du logo par le texte -->
        </div>

        <!-- Navigation -->
        <nav class="nav-links">
            <ul>
                <li><a href="#" class="menu-link active" data-section="accueil">Accueil</a></li>
                <li class="dropdown">
                    <a href="#">Ajouter</a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="menu-link" data-section="form-etudiant">Étudiant</a></li>
                    </ul>
                </li>
                <li><a href="listes1.php">Listes</a></li>
                <li class="dropdown">
                    <a href="#">Parrainage</a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="menu-link" data-section="voir-parrainages">Voir les parrainages</a></li>
                        <li><a href="formulaire_parrainageDRT.php">Créer une liste de parrainage</a></li>
                    </ul>
                </li>
                <li><a href="#">Statistiques</a></li> <!-- Menu Activités -->
            </ul>
        </nav>

        

        <!-- Bouton de déconnexion -->
        <div class="logout">
            <a href="deconnexion.php" class="logout-btn">Déconnexion</a>
        </div>

        
    </header>

    <main>
        <!-- Section Accueil -->
        <div id="accueil" class="content-section">
           
        </div>

        <!-- Formulaire Étudiant -->
        <div id="form-etudiant" class="content-section hidden">
            <h2>Ajouter un Étudiant</h2>
            <form method="POST" action="ajouter_etudiants.php">
                <!-- Champ pour le matricule -->
                <label for="matricule">Matricule :</label>
                <input type="text" id="matricule" name="matricule" placeholder="Entrer le matricule" required><br><br>

                <!-- Champ pour le nom -->
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Entrer le nom" required><br><br>

                <!-- Champ pour le prénom -->
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="Entrer le prénom" required><br><br>

                <!-- Champ pour le numéro de téléphone -->
                <label for="telephone">Numéro de téléphone :</label>
                <input type="tel" id="telephone" name="telephone" pattern="\d{10}" 
                    title="Veuillez entrer 10 chiffres uniquement" maxlength="10" 
                    placeholder="Exemple : 0123456789" required><br><br>

                <!-- Sélection dynamique de la filière -->
                <label for="filiere">Filière :</label>
                <select id="filiere" name="filiere" required>
                    <?php
                    require_once 'connexion.php';
                    $filieres = $pdo->query("SELECT * FROM filieres where idfil = 5")->fetchAll();
                    foreach ($filieres as $filiere) {
                        echo "<option value='{$filiere['idfil']}'>{$filiere['nom_filiere']}</option>";
                    }
                    ?>
                </select><br><br>

                <!-- Sélection dynamique du niveau -->
                <label for="niveau">Niveau :</label>
                <select id="niveau" name="niveau" required>
                    <option value="">Choisir un niveau</option>
                    <?php
                    $niveaux = $pdo->query("SELECT * FROM niveaux")->fetchAll();
                    foreach ($niveaux as $niveau) {
                        echo "<option value='{$niveau['idniv']}'>{$niveau['nom_niveau']}</option>";
                    }
                    ?>
                </select><br><br>

                <!-- Bouton d'ajout -->
                <button type="submit" name="ajouter_etudiant" onclick="valider()">Ajouter l'étudiant</button>
            </form>
        </div>

        <!-- Voir les parrainages -->
        <div id="voir-parrainages" class="content-section hidden">
            <h2>Liste des Parrainages</h2>
            <form method="GET" action="voir_parrainages.php">
                <label for="filiere-select">Filière :</label>
                <select id="filiere-select" name="filiere" required>
                    <?php
                    require_once 'connexion.php';
                    $filieres = $pdo->query("SELECT * FROM filieres where idfil = 5")->fetchAll();
                    foreach ($filieres as $filiere) {
                        echo "<option value='{$filiere['idfil']}'>{$filiere['nom_filiere']}</option>";
                    }
                    ?>
                </select>
                <button type="submit">Afficher</button>
            </form>

            <div id="result-parrainages">
                <!-- Les résultats des parrainages s'afficheront ici -->
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 SYGES PROPUS - Tous droits réservés</p>
    </footer>

    <script src="js/page_admin.js"></script> <!-- Lien vers le fichier JavaScript -->
</body>
</html>
