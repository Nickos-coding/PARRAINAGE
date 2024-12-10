// Récupérer tous les liens du menu
const menuLinks = document.querySelectorAll(".menu-link");

// Fonction pour gérer l'affichage des sections
function showSection(event) {
  event.preventDefault();

  // Récupérer la section à afficher
  const sectionId = event.target.dataset.section;

  // Vérifier que l'élément cible existe
  if (!sectionId) return;

  // Masquer toutes les sections
  document.querySelectorAll(".content-section").forEach((section) => {
    section.classList.add("hidden");
  });

  // Supprimer la classe 'active' de tous les liens
  menuLinks.forEach((link) => link.classList.remove("active"));

  // Afficher la section sélectionnée
  const targetSection = document.getElementById(sectionId);
  if (targetSection) {
    targetSection.classList.remove("hidden");
  }

  // Ajouter la classe 'active' au lien cliqué
  event.target.classList.add("active");
}

// Ajouter un gestionnaire d'événements à chaque lien
menuLinks.forEach((link) => {
  link.addEventListener("click", showSection);
});