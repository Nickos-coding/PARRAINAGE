
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Étudiant</title>
    <link rel="stylesheet" href="css/page_etudiant.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <div class="logo">UIYA SYSTEM</div>
            <div class="profile-circle">
                <img src="uploads/<?= htmlspecialchars($etudiant['photo_profil']); ?>" alt="Photo de Profil">
            </div>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main>
        <section class="welcome-section">
            <h1>Bienvenue, <?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']); ?> !</h1>
            <p>Découvrez vos informations personnelles, vos parrains ou filleuls, et bien plus encore.</p>
        </section>

        <section class="infos-section">
            <h2>Vos Informations</h2>
            <ul>
                <li><strong>Identifiant :</strong> <?= htmlspecialchars($etudiant['id']); ?></li>
                <li><strong>Email :</strong> <?= htmlspecialchars($etudiant['email']); ?></li>
                <li><strong>Contact :</strong> <?= htmlspecialchars($etudiant['contact']); ?></li>
                <li><strong>Filière :</strong> <?= htmlspecialchars($etudiant['filiere']); ?></li>
                <li><strong>Niveau :</strong> <?= htmlspecialchars($etudiant['niveau']); ?></li>
            </ul>
            <a href="modifier_infos.php" class="btn-modifier">Modifier Mes Informations</a>
        </section>

        <section class="parrainage-section">
            <h2>Votre Parrainage</h2>
            <p>Consultez vos parrains ou filleuls ci-dessous.</p>
            <ul>
                <!-- Exemple dynamique -->
                <li><strong>Parrain :</strong> Nom et Prénom du Parrain</li>
                <li><strong>Filleul :</strong> Nom et Prénom du Filleul</li>
            </ul>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 UIYA System - Tous droits réservés.</p>
    </footer>

    <!-- Script JS -->
    <script src="js/page_etudiant.js"></script>
</body>
</html>
