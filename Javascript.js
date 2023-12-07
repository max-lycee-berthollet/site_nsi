document.addEventListener('DOMContentLoaded', function() {
  // Récupération de l'élément texte d'accueil
  const texteAccueil = document.getElementById('texteAccueil');

  // Fonction pour animer l'apparition du texte
  function animerTexte() {
    texteAccueil.style.opacity = 1; // Affichage du texte
  }

  // Lancer l'animation après un délai de 1 seconde
  setTimeout(animerTexte, 100);
