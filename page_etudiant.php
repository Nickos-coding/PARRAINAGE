<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Étudiant</title>
    <!-- Fichier CSS pour le style -->
    <link rel="stylesheet" href="./css/page_etudiant.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <!-- Logo du site -->
            <img src="logo.png" alt="Logo du site">
        </div>
        <nav>
            <ul>
                <!-- Liens de navigation -->
                <li><a href="#notifications">Notifications</a></li>
                <li>
                    <a href="#">Rencontres</a>
                    <!-- Sous-menu pour les options liées aux rencontres -->
                    <ul class="submenu">
                        <li><a href="#remplir-formulaire">Remplir un formulaire</a></li>
                        <li><a href="#rencontres-passees">Rencontres passées</a></li>
                        <li><a href="#demandes">Demandes en attente</a></li>
                    </ul>
                </li>
                <li><a href="#activites">Activités</a></li>
                <li><a href="#logout">Déconnexion</a></li>
            </ul>
        </nav>
        <div class="avatar">
            <!-- Avatar ou photo de l'étudiant -->
            <img src="avatar.png" alt="Avatar étudiant">
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Notifications Section -->
        <section id="notifications">
            <h2>Notifications</h2>
            <!-- Une notification avec des actions disponibles -->
            <div class="notification">
                <p>Nouvelle demande de rencontre de [Nom].</p>
                <button>Accepter</button>
                <button>Refuser</button>
            </div>
        </section>

        <!-- Rencontres Section -->
        <section id="rencontres">
            <h2>Rencontres</h2>
            <!-- Formulaire pour créer une nouvelle rencontre -->
            <div id="remplir-formulaire">
                <h3>Remplir un formulaire</h3>
                <form action="process_rencontre.php" method="POST">
                    <!-- Champ pour indiquer le destinataire -->
                    <label for="destinataire">Destinataire :</label>
                    <input type="text" id="destinataire" name="destinataire" required>

                    <!-- Champ pour ajouter des détails sur la rencontre -->
                    <label for="details">Détails :</label>
                    <textarea id="details" name="details" required></textarea>

                    <button type="submit">Envoyer</button>
                </form>
            </div>

            <!-- Liste des rencontres passées -->
            <div id="rencontres-passees">
                <h3>Rencontres passées</h3>
                <ul>
                    <li>Rencontre avec [Nom] le [Date] à [Lieu]</li>
                </ul>
            </div>

            <!-- Liste des demandes en attente -->
            <div id="demandes">
                <h3>Demandes en attente</h3>
                <ul>
                    <li>Demande de [Nom] - En attente</li>
                </ul>
            </div>
        </section>

        <!-- Activités Section -->
        <section id="activites">
            <h2>Activités</h2>
            <!-- Formulaire pour enregistrer une activité -->
            <form action="process_activite.php" method="POST">
                <label for="activite">Activité :</label>
                <textarea id="activite" name="activite" required></textarea>

                <button type="submit">Enregistrer</button>
            </form>
        </section>
    </main>

    <!-- Fichier JavaScript pour les interactions -->
    <script src="./js/page_etudiant.js"></script>
</body>
</html>
