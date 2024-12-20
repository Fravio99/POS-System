// Get popup elements
const aboutLink = document.getElementById('about-link');
const loginLink = document.getElementById('login-link');
const aboutPopup = document.getElementById('about-popup');
const loginPopup = document.getElementById('login-popup');
const closeAboutPopup = document.getElementById('close-about-popup');
const closeLoginPopup = document.getElementById('close-login-popup');

// Open "About Us" popup
aboutLink.addEventListener('click', (event) => {
  event.preventDefault();
  aboutPopup.style.display = 'flex';
});

// Open "Login" popup
loginLink.addEventListener('click', (event) => {
  event.preventDefault();
  loginPopup.style.display = 'flex';
});

// Close "About Us" popup
closeAboutPopup.addEventListener('click', () => {
  aboutPopup.style.display = 'none';
});

// Close "Login" popup
closeLoginPopup.addEventListener('click', () => {
  loginPopup.style.display = 'none';
});

// Close popup when clicking outside the popup content
window.addEventListener('click', (event) => {
  if (event.target === aboutPopup) {
    aboutPopup.style.display = 'none';
  } else if (event.target === loginPopup) {
    loginPopup.style.display = 'none';
  }
});

// Obtenir les éléments des sections
const loginSection = document.getElementById('login-section');
const signupSection = document.getElementById('signup-section');

// Obtenir les liens pour basculer entre les sections
const showSignupLink = document.getElementById('show-signup');
const showLoginLink = document.getElementById('show-login');

// Afficher la section d'inscription et masquer la section de connexion
showSignupLink.addEventListener('click', (event) => {
  event.preventDefault();
  loginSection.style.display = 'none';
  signupSection.style.display = 'flex';
});

// Afficher la section de connexion et masquer la section d'inscription
showLoginLink.addEventListener('click', (event) => {
  event.preventDefault();
  signupSection.style.display = 'none';
  loginSection.style.display = 'flex';
});
