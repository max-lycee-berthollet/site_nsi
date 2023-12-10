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
    // Add actions on button click
    alert('Let the journey begin!');
  });
};
