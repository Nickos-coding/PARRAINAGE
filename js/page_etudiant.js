// JavaScript pour la page Étudiant

// Gestion des notifications (exemple pour accepter/refuser une demande)
document.querySelectorAll(".notification button").forEach((button) => {
  button.addEventListener("click", (e) => {
    const action = e.target.textContent.trim();
    const notification = e.target.parentElement;

    if (action === "Accepter") {
      alert("Vous avez accepté la demande.");
    } else if (action === "Refuser") {
      alert("Vous avez refusé la demande.");
    }

    // Supprime la notification après l'action
    notification.remove();
  });
});

// Exemple de gestion dynamique pour les sous-menus
document.querySelectorAll("nav ul li").forEach((menuItem) => {
  menuItem.addEventListener("mouseover", () => {
    const submenu = menuItem.querySelector(".submenu");
    if (submenu) {
      submenu.style.display = "block";
    }
  });

  menuItem.addEventListener("mouseout", () => {
    const submenu = menuItem.querySelector(".submenu");
    if (submenu) {
      submenu.style.display = "none";
    }
  });
});

// Placeholder pour des fonctionnalités supplémentaires comme la validation des formulaires
const rencontreForm = document.querySelector("#remplir-formulaire form");
if (rencontreForm) {
  rencontreForm.addEventListener("submit", (e) => {
    e.preventDefault(); // Empêche l'envoi réel pour tester

    const destinataire = document.querySelector("#destinataire").value;
    const details = document.querySelector("#details").value;

    if (destinataire && details) {
      alert("Formulaire soumis avec succès !");
    } else {
      alert("Veuillez remplir tous les champs avant de soumettre.");
    }
  });
}
