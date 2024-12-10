function validerContact() {
  var contact = document.getElementById("contact").value;
  var regex = /^\d{10}$/; // Permet uniquement 10 chiffres

  if (!regex.test(contact)) {
    alert("Le contact doit être composé de 10 chiffres.");
    return false;
  }
  return true;
}
