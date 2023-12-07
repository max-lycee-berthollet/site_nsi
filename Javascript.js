document.addEventListener('DOMContentLoaded', function() {
  // Récupération de l'élément texte d'accueil
  const texteAccueil = document.getElementById('texteAccueil');

  // Fonction pour animer l'apparition du texte
  function animerTexte() {
    texteAccueil.style.opacity = 1; // Affichage du texte
  }

  // Lancer l'animation après un délai de 1 seconde
  setTimeout(animerTexte, 100);
  document.addEventListener('DOMContentLoaded', function() {
  const texte = "Pour commencer creer un compte en allant sur la page connection puis vous pourrez poster en ligne...";
  const texteAnimation = document.getElementById('texteAnimation');

  function animerTexte2(texte, index) {
    texteAnimation.textContent += texte.charAt(index);
    index++;

    if (index < texte.length) {
      setTimeout(function() {
        animerTexte2(texte, index);
      }, 50); // Délai entre l'affichage de chaque lettre (100 millisecondes)
    }
  }

  // Lancer l'animation
  animerTexte2(texte, 0);
});
});
