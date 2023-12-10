window.onload = function() {
  const title = document.querySelector('h1');
  const text = document.querySelector('p');
  const button = document.getElementById('btn');

  setTimeout(() => {
    title.style.opacity = '1';
    title.style.transform = 'translateY(0)';
  }, 500);

  setTimeout(() => {
    text.style.opacity = '1';
    text.style.transform = 'translateY(0)';
  }, 800);

  setTimeout(() => {
    button.style.opacity = '1';
    button.style.transform = 'translateY(0)';
  }, 1100);

  button.addEventListener('click', () => {
  title.style.transition = 'transform 1s';
  text.style.transition = 'transform 1s';
  button.style.transition = 'transform 1s';

  title.style.transform = 'translateY(-100vh)';
  text.style.transform = 'translateY(-100vh)';
  button.style.transform = 'translateY(-100vh)';

  setTimeout(() => {
    // Changer l'URL pour rediriger vers le site donné (met le lien vers notre site)
    window.location.href = 'https://www.google.com/';
  }, 1000); // Délai pour l'animation avant la redirection, ici 1000ms (1 seconde)
});;
};
