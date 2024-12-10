// Fonction pour gérer l'ouverture et la fermeture du menu hamburger
const hamburgerMenu = document.getElementById("hamburger-menu");
const navLinks = document.querySelector("header nav");

hamburgerMenu.addEventListener("click", () => {
  navLinks.classList.toggle("active"); // Toggle pour afficher/cacher le menu
});

// Fonction pour afficher le contenu correspondant au lien cliqué
function showContent(section) {
  // Cacher toutes les sections
  const sections = document.querySelectorAll(".content-section");
  sections.forEach((sec) => (sec.style.display = "none"));

  // Afficher la section correspondante si elle existe
  const sectionToShow = document.getElementById(section);
  if (sectionToShow) {
    sectionToShow.style.display = "block";
  }
}

// Fonction pour récupérer la valeur d'un cookie par son nom
function getCookie(name) {
  const value = document.cookie.match("(^|;)\\s*" + name + "\\s*=\\s*([^;]+)");
  return value ? value.pop() : "";
}

// Vérification de la présence du cookie 'premiere_connexion_complete'
if (!getCookie("premiere_connexion_complete")) {
  // Si le cookie n'existe pas, l'étudiant doit compléter le formulaire de première connexion
  document.getElementById("login-btn").href = "premco.html";
} else {
  // Si le cookie existe, l'étudiant est redirigé vers la page de connexion classique
  document.getElementById("login-btn").href = "formulaire_connexion.php"; // Remplace par ton formulaire de connexion
}
